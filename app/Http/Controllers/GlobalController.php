<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;



class GlobalController extends Controller
{
    // public $api_key = "GntH9uizLhUAhETaDjVrd2KXQS7Vfq";
    // $api_key = "TEqtHP43gXSi5bnMyJeLQnsjBSXBf4";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($_POST['text'])){
            return $this->analize($_POST['text'],$request);
        }else{
            return 'Please try again';
        }
    }

    /**
     * Funtion to analize how to proceed
     *
     * @return string 
     */
    public function analize($message,$request){
        if(str_contains($message,'#')){
            return $this->execute($message,$request);
        }else{
            return MessageController::findText($message);
        }
    }
    /**
     * Funtion to execute orders from the chatbot interface
     *
     * @return string 
     */
    public function execute($message,$request){
        $order = explode(" ", $message);
        switch ($order[0]){
            case '#login':
                return  $this->login($request);
                break;
            case '#logout':
                return  $this->logout($request);
                break;    
            case '#exchange':
                return $this->exchange($request);
                break;
            case '#deposit':
                return $this->deposit($order, $request);
                break;
            case '#withdraw':
                return $this->withdraw($order, $request);
                break;
            case '#balance':
                return $this->balance($request);
                break;
            case '#signup':
                return $this->signup($request);
                break;
            default :
                return 'Invalid order, type info for more information';
                break;
        }
    }

    public function signup($request){
        $userController = app('App\Http\Controllers\UserController');
        $response = $userController->create($request);
        return $response;
    }

    public function login($request){
        $userController = app('App\Http\Controllers\UserController');
        $response = $userController->login($request);
        return $response;
    }

    public function logout($request){
        $userController = app('App\Http\Controllers\UserController');
        $response = $userController->logout($request);
        return $response;
    }

    public function exchange($request){
        //TODO Finish insetion transaction
        //    #exchange 30 USD EUR
        try{
            if($request->session()->get('user')>0){
                $accountController = app('App\Http\Controllers\AccountController');
                $accounts = $accountController->findByUser($request->session()->get('user'));
            }else{
                return "you must login to perform this action";
            }
            $order = explode(" ", $_POST['text']);
            $info = array();
            $info['amount'] = $order[1];
            $info['from'] = $order[2];
            $info['to'] = $order[3];
            $wsController = app('App\Http\Controllers\ExternalWsController');
            $response = $wsController->convert($info);
            $transactionController = app('App\Http\Controllers\TransactionController');
            $transactionController->create($request);
            return $response;
        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return "can´t perform action";
        }
       
    }

    public function deposit($order,$request){

        // #deposit 30 USD
        // TODO validate against ws not only to db
        try{
            if($request->session()->get('user')>0){
                $accountController = app('App\Http\Controllers\AccountController');
                $accounts = $accountController->findByUser($request->session()->get('user'));
            }else{
                return "you must login to perform this action";
            }
                $inserted = false;
                foreach($accounts as $account){
                    if($account->name == $order[2]){
                        $account->amount += $order[1];
                        $response = $accountController->edit($account);
                        $inserted = true;
                    break;
                    }
                }
                $transactionController = app('App\Http\Controllers\TransactionController');
                    $transactionController->create($request);
                if(!$inserted){
                    $response = $accountController->create($request->session()->get('user'),$order);  
                }
                return $response;
            
        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return 'there was an error, try again please';
        }  
    }

    public function balance($request){
        // #balance
        if($request->session()->get('user')>0){
            $accountController = app('App\Http\Controllers\AccountController');
            $accounts = $accountController->findByUser($request->session()->get('user'));
            $msg = '';
            foreach($accounts as $account){
                $msg = $msg.'--Account Number: '.$account->id.'  currency:'.$account->name.'  amount:'.$account->amount;
            }
        }else{
            $msg = "you must login to perform this action";
        }  
        return $msg;
    }

    public function withdraw($order,$request){
        // #withdraw 30 USD
        try{
            if($request->session()->get('user')>0){
                $accountController = app('App\Http\Controllers\AccountController');
                $accounts = $accountController->findByUser($request->session()->get('user'));
            }else{
                return "you must login to perform this action";
            }
                $inserted = false;
                foreach($accounts as $account){
                    if($account->name == $order[2]){
                        $account->amount -= $order[1];
                        if($account->amount <0){
                            return "That is to much for your account";
                        }
                        $response = $accountController->edit($account);
                        $transactionController = app('App\Http\Controllers\TransactionController');
                        $transactionController->create($request);
                        return $response;
                        break;
                    }
                }
            $response =  "You don´t have an account with this currency";  
            return $response;
        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return 'There was an error, try again please';
        }  
    }

    public function test(){
        $userController = app('App\Http\Controllers\ExternalWsController');
        $response = $userController->velidateCurrency('EUR');
        return $response;
    //  return 'listo';
    }

}