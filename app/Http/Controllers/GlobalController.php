<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;



class GlobalController extends Controller
{
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
                return  $this->login($order,$request);
                break;
            case '#logout':
                return  $this->logout($request);
                break;    
            case '#exchange':
                return $this->exchange($order, $request);
                break;
            case '#deposit':
                return $this->deposit($order, $request);
                break;
            case '#withdraw':
                return 'llega al metodo de logueo';
                break;
            case '#balance':
                return $this->balance($request);
                break;
            case '#signup':
                return 'llega al metodo de logueo';
                break;
            default :
                return 'invalid order';
                break;
        }
    }

    public function login($order,$request){
        $credentials = ['email'=>$order[1],'password'=>$order[2]];
        if (\Auth::attempt($credentials)) {
            $accountController = app('App\Http\Controllers\AccountController');
            $user = $accountController->findEmail($order[1]);
            $request->session()->put('user',$user);
            return('Now you are logged');
        }else{
            return 'The provided credentials do not match our records.';
        }
    }

    public function logout($request){
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return 'See you soon!';
    }

    public function exchange($order,$request){
        //TODO Finish insetion transaction
        //    #exchange 30 USD EUR
        $info = array();
        $info['amount'] = $order[1];
        $info['from'] = $order[2];
        $info['to'] = $order[3];
        return  $this->convert($info);
    }

    public function deposit($order,$request){
        // #deposit 30 USD
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
                    return $accountController->edit($account);
                break;
                }
            }
                return $accountController->create($request->session()->get('user'),$order);        
    }
    public function balance($request){
        // #balance
        if($request->session()->get('user')>0){
            $accountController = app('App\Http\Controllers\AccountController');
            $accounts = $accountController->findByUser($request->session()->get('user'));
            $msg = '';
            foreach($accounts as $account){
                $msg = $msg.'account: '.$account->id.'  currency:'.$account->name.'  amount:'.$account->amount;
            }
            return $msg;
        }else{
            $return = "you must login to perform this action";
        }  
        return $return;
    }

    /**
     * Convert the amount of money into other currency
     *
     * @return string 
     */
    public function convert($info){
        $api_key = "TEqtHP43gXSi5bnMyJeLQnsjBSXBf4";

	    $from = $info['from'];
	    $to = $info['to'];

	    $url = "https://www.amdoren.com/api/currency.php?api_key=$api_key&from=$from&to=$to";
        
	    $ch = curl_init();  
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $json_string = curl_exec($ch);
        \Log::info($json_string);
	    $parsed_json = json_decode($json_string);

        $error = $parsed_json->error;
        if($error != 0){
            $return = $parsed_json->error_message;
        }else{
            //TODO
            // verify logued
            // insert amount

            $return = $parsed_json->amount; 
            $return *= $info['amount'];
        }
        return $return;

    }

    public function test(){
        $info = array();

        $info['amount'] = 30;
        $info['from'] = 'USD';
        $info['to'] = 'EUR';
        return  $this->convert($info);
    //  return 'listo';
    }

}