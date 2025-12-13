<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

      public function getProfileData()
      {
          $information = Teacher::findOrFail(auth()->user()->id);

          return view('pages.Teachers.dashboard.profile',compact('information'));
      }

      public function updateData(Request $request , $id)
      {
          $information = Teacher::findOrFail($id);

          if(!empty($request->password))
          {
              $information->name = $request->name;
              $information->password  = bcrypt($request->password);
              $information->save();
          }

          else {
              $information->name = $request->name;
              $information->save();
          }

          return redirect()->back()->with('success',trans('messages.update'));
      }
}
