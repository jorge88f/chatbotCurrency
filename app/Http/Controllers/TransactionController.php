<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function create($request)
    {
        try{
            $transaction = new Transaction;
            $transaction->user_id = $request->session()->get('user');
            $order = explode(" ", $_POST['text']);
            switch ($order[0]){
                case '#exchange':
                    #exchange 30 USD EUR
                    $transaction->transaction_type= 'exchange';
                    $transaction->currency_from= $order[2];
                    $transaction->currency_to= $order[3];
                    $transaction->amount_from= $order[1];
                    break;
                case '#deposit':
                    $transaction->transaction_type= 'deposit';
                    $transaction->currency_from= $order[2];
                    $transaction->currency_to= $order[2];
                    $transaction->amount_from= $order[1];
                    $transaction->amount_to= $order[1];
                    break;
                case '#withdraw':
                    $transaction->transaction_type= 'withdraw';
                    $transaction->currency_from= $order[2];
                    $transaction->currency_to= $order[2];
                    $transaction->amount_from= $order[1];
                    $transaction->amount_to= $order[1];
                    break;
                default :
                    return 'Invalid order, type info for more information';
                    break;
            }
            $transaction->save();
            return true;
        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return false;
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
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
