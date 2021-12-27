<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Signin;
use Session;
//use Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function index()
    {
        
        return view('login');
    }

    public function all(){
        $logins=Signin::with('user')->get();
        return $logins;
    }

    public function authenticate(Request $request){
        //HASH-ELT JELSZÓ
        // $request->validate([
        //     'azon' => 'required',
        //     'password' => 'required',
        // ]);
        // $credentials = $request->only('azon', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect('dashboard');
        //     //return redirect()->intended('index');
        //                 //->withSuccess('Logged-in');
        // }
        // //return redirect("user.php")->withSuccess('Credentials are wrong.');
        // $attempt=Auth::attempt($credentials);
        // return dd($attempt);
        $user = Signin::where([
            'azon' => $request->azon, 
            'password' => $request->password
        ])->first();
        
        if($user)
        {
            Auth::login($user);
            //return redirect('index.php');/*->intended('index');*/
            return response(['url' => url('/index.php')]);
        }
        return response(['url' => url('/login')]);
        
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
