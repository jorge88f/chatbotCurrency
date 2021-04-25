<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;



use App\Models\Message;

class GlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->convert();
        return $_POST['text'];
        //
    }

    public function convert(){
        // $endpoint = 'convert';
        // $access_key = 'da17fea796f12498084b1ed04a27b81c';

        // $from = 'USD';
        // $to = 'EUR';
        // $amount = 10;

        // // initialize CURL:
        // $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // get the JSON data:
        // $json = curl_exec($ch);
        // curl_close($ch);
        // \Log::info($json);
        // // Decode JSON response:
        // $conversionResult = json_decode($json, true);

        // // access the conversion result
        // $return = $conversionResult['result'];
        // return $return;


        // $endpoint = 'latest';
        // $access_key = 'da17fea796f12498084b1ed04a27b81c';

        // // Initialize CURL:
        // $ch = curl_init('http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // Store the data:
        // $json = curl_exec($ch);
        // curl_close($ch);
        // \Log::info($json);
        // // Decode JSON response:
        // $exchangeRates = json_decode($json, true);

        // // Access the exchange rate values, e.g. GBP:
        // return $exchangeRates['rates']['GBP'];




        $api_key = "TEqtHP43gXSi5bnMyJeLQnsjBSXBf4";
	
	    $currency1 = 'USD';
	    $currency2 = 'EUR';
        
	    $currency1 = 'EURss';
	    $currency2 = 'GBP';
        
	    $url = "https://www.amdoren.com/api/currency.php?api_key=$api_key&from=$currency1&to=$currency2";
        
	    $ch = curl_init();  
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $json_string = curl_exec($ch);
        \Log::info($json_string);
	    $parsed_json = json_decode($json_string);

        $error = $parsed_json->error;
        if($error == 0){
            $return = $parsed_json->error_message;
        }else{
            $return = $parsed_json->amount; 
        }
	   

        return $return;

    }

    public function test(){
      
    
     return 'listo';
    }

}