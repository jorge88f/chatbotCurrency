<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExternalWsController extends Controller
{
    private $api_key = "GntH9uizLhUAhETaDjVrd2KXQS7Vfq";
    /**
     * Convert the amount of money into other currency
     *
     * @return string 
     */
    public function convert($info){
        // $api_key = "TEqtHP43gXSi5bnMyJeLQnsjBSXBf4";

	    $from = $info['from'];
	    $to = $info['to'];
        $key=$this->api_key;
	    $url = "https://www.amdoren.com/api/currency.php?api_key=$key&from=$from&to=$to";
        
	    $ch = curl_init();  
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $json_string = curl_exec($ch);
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


    /**
     * Convert the amount of money into other currency
     *
     * @return string 
     */
    public function velidateCurrency($currency){


	    $from = 'USD';
        $to = $currency;
        $key=$this->api_key;
	    $url = "https://www.amdoren.com/api/currency.php?api_key=$key&from=$from&to=$to";
        $result = $this->consumeWS($url);
	
        $error = $result->error;
        if($error == 0){
            return  true;
        }
        return false;
    }

    public function consumeWS($url){
        $ch = curl_init();  
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $json_string = curl_exec($ch);
        $parsed_json = json_decode($json_string);
        return $parsed_json;
    }






}
