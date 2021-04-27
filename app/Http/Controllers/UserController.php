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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        // #signup jorge@flores.com 123456 30 USD
        $order = explode(" ", $_POST['text']);
        try{
            $exist = User::where('email','=',$order[1])->firstOrFail();
            return "this email has been taken";
        }catch(\Exception $e){
            try{
                $currencyController = app('App\Http\Controllers\CurrencyController');
                $currency = $currencyController->findByName($order[4]);
                if($currency){
                    \DB::beginTransaction();
                    $user = new User;
                    $user->name=$order[1];
                    $user->email=strtolower($order[1]);
                    $user->password=bcrypt($order[2]);
                    $user->currency_id=$currency->id;
                    $user->save();
                    $data = array();
                    $data[1]= $order[3];
                    $data[2]= $order[4];
                    $accountController = app('App\Http\Controllers\AccountController');
                    $response = $accountController->create($user->id,$data);
                    \DB::commit();
                    return $response;
                }else{
                    \DB::rollback();
                    return "That currency it´s not available";
                }
            }catch(\Exception $e){
                \Log::info(' File: '. $e->getFile() . ' Line: '.$e->getLine(). ' Message: '.$e->getMessage());
                return "Sorry, There was an error";
            }
        }

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
