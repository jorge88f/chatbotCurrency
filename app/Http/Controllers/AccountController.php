<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId, $order)
    {
        try{
            $currencyController = app('App\Http\Controllers\CurrencyController');
            $currency = $currencyController->findByName($order[2]);
            $account = new Account; 
            $account->amount =$order[1];
            $account->user_id = $userId;
            $account->currency_id = $currency->id;
            $account->save();
            return 'Account Created with amount: '.$order[1].$order[2];
        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return 'Sorry there was a problem, try later';
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $email
     * @return \Illuminate\Http\Response
     */
    public function findEmail($email)
    {
        try{
            $user = User::where('email','like','%'.$email.'%')->firstOrFail();
            return $user->id;
        }catch(\Exception $e){
            return false;
        }
        
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $user
     * @return \Illuminate\Http\Response
     */
    public function findByUser($user)
    {
        try{
            $accounts = Account::where('user_id','=',$user)->join('currencies','currencies.id','=','accounts.currency_id')->get();
            return $accounts;
        }catch(\Exception $e){
            \Log::info($e->getMessage().$e->getFile().$e->getLine());
            return "there are no accounts to show";
        }
        
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $account->save();
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
