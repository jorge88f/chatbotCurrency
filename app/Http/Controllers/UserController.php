<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function create()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

     /**
     * Loguin the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \string
     */
    public function login($request){
    try{
            $order = explode(" ", $_POST['text']);
            $credentials = ['email'=>$order[1],'password'=>$order[2]];
            if (\Auth::attempt($credentials)) {
                $accountController = app('App\Http\Controllers\AccountController');
                $user = $accountController->findEmail($order[1]);
                $request->session()->put('user',$user);
                return('Now you are logged');
            }else{
                return 'The provided credentials do not match our records.';
            }

        }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return 'please login again, sorry.';
        }
        
        
    }
    /**
     * Logout the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function logout($request){
       try{
            \Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return 'See you soon!';
       }catch(\Exception $e){
            \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
            return 'please logout again, sorry.';
       }
        
    }

}
