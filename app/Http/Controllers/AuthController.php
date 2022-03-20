<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Signin;
use Session;
use Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Validation\ValidationException;

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
        //$this->checkTooManyFailedAttempts();

        $credentials = $request->only('azon', 'password');
        if (RateLimiter::tooManyAttempts('login', 3)) {
            $seconds = RateLimiter::availableIn('login');
            return  redirect()->back()->withErrors(['loginlimit'=>'Too many login attempts!'.$seconds.' s left to try again!']);
        }
        
        if(Auth::attempt($credentials))
        {
            RateLimiter::clear('login');          
            return redirect('/');
            //RateLimiter::clear($this->throttleKey());  
        }
        else{
            //RateLimiter::hit($this->throttleKey(), $seconds = 60);
            RateLimiter::hit('login', $seconds = 60);
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

    // public function checkTooManyFailedAttempts()
    // {
    //     if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
    //         return;
    //     }

    //     throw new Exception('Too many login attempts!');
    // }
    public function checkTooManyFailedAttempts()
    {
        if (RateLimiter::tooManyAttempts('login', 3)) {
            return 'Too many login attempts!';
        }
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
            //session()->put('errors',['oldpwd'=>'A jelszó nem egyezzik!']);
            throw ValidationException::withMessages(['oldpwd'=>'A jelszó nem egyezzik!']);      
            //return redirect()->back()->withErrors(['oldpwd'=>'A jelszó nem egyezzik!']);
            //return redirect()->back();
            //return redirect()->back()->with('error','A jelszó nem egyezzik!');
        }

        if (Hash::check($request->newpwd, $userPassword)) {
            //return redirect()->back()->withErrors(['newpwd'=>'Az új jelszó nem lehet ugyanaz mint a régi jelszó!']);
            //return redirect()->back()->with('error','Az új jelszó nem lehet ugyanaz mint a régi jelszó!');
            throw ValidationException::withMessages(['newpwd'=>'Az új jelszó nem lehet ugyanaz mint a régi jelszó!']);
        }

        if(!strcmp($request->newpwd,$request->confirmpwd)==0){
            //return redirect()->back()->withErrors(['currentpwd'=>'A megadott jelszó nem egyezik meg az új jelszóval!']);
            throw ValidationException::withMessages(['confirmpwd'=>'A megadott jelszó nem egyezik meg az új jelszóval!']);
        }



        $user->password = Hash::make($request->newpwd);
        $user->timestamps = false;
        $user->save();
        //session()->forget('errors');
        return redirect()->back();
    }

    public function error(Request $request){
        //$error=Session::get('oldpwd');
        //$error = $request->session()->all();
        $error = session('errors');
        return $error;
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
