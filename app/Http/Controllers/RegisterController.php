<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
       return view('pages.register');
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ],
        [
            'name.required'  => 'من فضلك قم بادخال الاسم',
            'email.required'  => 'من فضلك قم بادخال البريد الالكترونى',
            'email.email'  => 'من فضلك قم بادخال بريد الكترونى صالح',
            'password.required'  => 'من فضلك قم بادخال كلمة المرور',
            'password_confirmation.required'  => 'من فضلك قم بادخال تأكيد كلمة المرور',
            'password_confirmation.same'  => 'كلمتى المرور غير متطابقتان',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/Grades');

    }

    public function login()
    {
        return view('pages.login');
    }

    public function logout()
    {
        return view('pages.login');
    }
}

