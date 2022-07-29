<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserContactRequest;
use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function updateProfile()
    {
        return view('User.updateProfile');
    }
    public function checkemail($email)
    {
        $em = auth()->user()->where('email', $email)->first();
        if ($em) {
            return 1;
        } else {
            return 0;
        }
    }
    public function saveProfile(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'birthday' => 'date',
        ]);
        auth()->user()->profile()->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
        ]);
        toastr()->success('Profile has been updated successfully');
        return redirect()->back();
    }
    public function saveProfileContact(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $chk = User::whereNotIn('id', [auth()->user()->id])->where('email', $request->email)->first();
        if ($chk) {
            return redirect()->back()->with('error', 'This email already exists!');
        } else {
            auth()->user()->update([
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            toastr()->success('Contact information has been updated successfully!');
            return redirect()->back();
        }
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => ['required'],
            'password' =>  'required|string|min:8',
        ]);
        $chk =  Hash::check($request->oldpassword, auth()->user()->password);
        if ($chk == true) {
            if ($request->password == $request->confirmapassword) {
                auth()->user()->update([
                    'password' => Hash::make($request->password),
                ]);
                toastr()->success('Password has been changed successfully!');
                return redirect()->back();
            } else {
                toastr()->success('Comfirm Password does not match !');
                return redirect()->back();
            }
        } else {
            toastr()->success('Current Password does not match !');
            return redirect()->back();
        }
    }
}
