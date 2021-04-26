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
                return 'llega al metodo de logueo';
                break;
            case '#deposit':
                return 'llega al metodo de logueo';
                break;
            case '#withdraw':
                return 'llega al metodo de logueo';
                break;
            case '#balance':
                return 'llega al metodo de logueo';
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
            $request->session()->regenerate();
            \Log::info(json_encode($request->session()->all()));
            return('Now you are logged');
        }else{
            return 'The provided credentials do not match our records.';
        }
    }

    public function logout(Request $request){
        \Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return 'See you soon!';
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