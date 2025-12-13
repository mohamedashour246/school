<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   // use AuthenticatesUsers;

    use AuthTrait;

    public function loginForm($type)
    {
        return view('auth.login',compact('type'));
    }

    public function login()
    {
        return view('pages.login');
    }

    public function postLogin(Request $request)
    {
         $validator = Validator::make($request->all(),[

             'email' => 'required|email',
             'password' => 'required',
         ],
         [
             'email.required'  => 'من فضلك قم بادخال البريد الالكترونى',
             'email.email'  => 'من فضلك قم بادخال بريد الكترونى صالح',
             'password.required'  => 'من فضلك قم بادخال كلمة المرور',
         ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

      //  $user = User::where('email',$request->email)->get();
        $credentials = $request->only('email', 'password');
        if(Auth::guard($this->checkGuard($request))->attempt($credentials))
        {
            return $this->redirect($request);
        }

        else {
            return redirect()->back()->with('fail','عفوا البيانات غير صحيحة');
        }
    }

    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
