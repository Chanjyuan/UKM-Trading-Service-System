<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;

class ChangePasswordController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['auth', 'verified']);
  }
    
      /**
       * Get the Profile view for changing the password.
       */
       public function changePasswordForm()
       {
         return view('changepassword');
       }
       /**
        * Change the password for the Authenticated user.
        */
        public function changePassword(Request $request)
        {
          //Check if the Current Password matches with what is in the database.
          if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return back()->with('error', 'Your current password does not match with what you provided');
          }
          // Compare the Current Password and New Password using[strcmp function]
          if(strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            return back()->with('error', 'Your current password cannot be same with the new password');
          }
          //Validate the Password.
          $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|confirmed'
          ]);
          // Save the New Password.
          $user = Auth::user();
          $user->password = bcrypt($request->get('new_password'));
          $user->save();
          return back()->with('success', 'Password changed successfully');
        }
}