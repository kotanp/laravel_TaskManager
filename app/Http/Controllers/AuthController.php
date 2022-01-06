<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Signin;
use Session;
use Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Exception;

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
        $this->checkTooManyFailedAttempts();

        $credentials = $request->only('azon', 'password');
        
        if(Auth::attempt($credentials))
        {          
            return redirect('/');
            RateLimiter::clear($this->throttleKey());
        }
        else{
            RateLimiter::hit($this->throttleKey(), $seconds = 60);
        }
        return redirect('/login');

        
        // $user = Signin::where([
        //     'azon' => $request->azon, 
        //     'password' => $request->password
        // ])->first();
        //Auth::login($user);
        //input type=button + ajax-os kéréshez kell
        //return response(['url' => url('/index.php')]);
        //return response(['url' => url('/login')]);
        
    }

    public function throttleKey()
    {
        return Str::lower(request('azon')) . '|' . request()->ip();
    }

    public function checkTooManyFailedAttempts()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        throw new Exception('Too many login attempts!');
    }

    public function changePassword(Request $request)
    {       
        $user = Auth::user();
        
        $userPassword = $user->password;
        
        // $request->validate([
        //     'oldpwd' => 'required',
        //     'newpwd' => 'same:confirmpwd|min:6',
        //     'confirmpwd' => 'required',
        // ]);
        
        if (!Hash::check($request->oldpwd, $userPassword)) {
            //return redirect('/');
            return redirect()->back()->withErrors(['oldpwd'=>'A jelszó nem egyezzik!']);
            //return redirect()->back()->with('error','A jelszó nem egyezzik!');
        }

        if (Hash::check($request->newpwd, $userPassword)) {
            return redirect()->back()->withErrors(['newpwd'=>'Az új jelszó nem lehet ugyanaz mint a régi jelszó!']);
            //return redirect()->back()->with('error','Az új jelszó nem lehet ugyanaz mint a régi jelszó!');
        }

        if(!strcmp($request->newpwd,$request->confirmpwd)==0){
            return redirect()->back()->withErrors(['currentpwd'=>'A megadott jelszó nem egyezik meg az új jelszóval!']);
        }



        $user->password = Hash::make($request->newpwd);
        $user->timestamps = false;
        $user->save();

        return redirect()->back();
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
