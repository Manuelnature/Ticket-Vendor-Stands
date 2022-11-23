<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('pages.login');
    }

    public function login_user(Request $request){
        try {
            $request->validate([
                'txt_username' => 'required',
            ], [
                'txt_username.required' => 'Username is required',
            ]);

            $username = $request->get('txt_username');
            $password = $request->get('txt_password');

            if(!empty($password)){
                $login_data = User::where('username', '=', $username)->first();

                if($login_data){
                    if (Hash::check($password, $login_data->password)) {

                        //=== Setting up a session ==//
                        Session::put('user_session', $login_data);

                        Alert::toast('Log In Successfully','success');
                        $user_session = Session::get('user_session');

                        // dd($user_session->role);
                        if ($user_session->role == 'Organizer') {
                            return redirect('organizer');
                        }
                        elseif ($user_session->role == 'Vendor'){
                            return redirect('vendor_page');
                        }
                        else{
                            return back();
                        }
                    }
                    else{
                        Alert::toast('Password Incorrect','warning');
                        return back();
                    }
                }
                else {
                    Alert::toast('Username not found','warning');
                        return back();
                }
            }

        } catch (exception $e) {
            echo 'Caught exception';
        }

    }

    public function logout(Request $request){
        $request->session()->forget('user_session');

        return redirect('/');
    }
}
