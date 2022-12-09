<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Register;
use App\Models\User;
use App\Models\Organizer;
use App\Models\VendingPoint;
use Illuminate\Support\Facades\Hash;
use Session;

class RegisterController extends Controller
{
    public function index(){
        $all_organizers = Organizer::all();
        $all_vending_points = VendingPoint::all();

        $user_session = Session::get('user_session');
        $user_id = $user_session->id;
        $organizer_id = $user_session->organizer_id;

        if ($organizer_id != NULL || $organizer_id != "") {
            $get_organizer = Organizer::where('id', $organizer_id)->get()[0];
            $organizer_name = $get_organizer->name;
        }
        else{
            $organizer_name = "";
        }
        return view('pages.register', compact('all_organizers', 'all_vending_points', 'organizer_name'));
    }

    public function register(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                // 'txt_lastname' => 'required|regex:/^[a-zA-Z-\s]+$/',
                'txt_username' => 'required|unique:tbl_users,username',
                'txt_contact' => 'required|numeric',
                'txt_password' => 'required',
                'txt_role' => 'required',
                ], [
                // 'txt_firstname.regex' => 'Firstname is must be in letters only',
                // 'txt_lastname.regex' => 'Lastname is must be in letters only',
                'txt_username.required' => 'Username is required',
                'txt_username.unique' => 'Username already exist',
                'txt_contact.required' => 'Phone number is required',
                'txt_contact.numeric' => 'Phone number must be in numbers only',
                'txt_password.required' => 'Password is required',
                'txt_role.required' => 'First Address Line is required',
            ]);

            $username = ucwords($request->get('txt_username'));
            $contact = $request->get('txt_contact');
            $password =  Hash::make($request->get('txt_password'));
            $role = ucwords($request->get('txt_role'));

            if ($request->get('txt_organizer') != "" || $request->get('txt_organizer') != NULL) {
                $organizer_id = $request->get('txt_organizer');
            }
            else {
                $organizer_id = NULL;
            }

            if ($request->get('txt_vendor') != "" || $request->get('txt_vendor') != NULL) {
                $vending_point_id = $request->get('txt_vendor');
            }
            else {
                $vending_point_id = NULL;
            }




            $add_user = new User();
            $add_user->username = $username;
            $add_user->contact = $contact;
            $add_user->password = $password;
            $add_user->role = $role;
            $add_user->organizer_id = $organizer_id;
            $add_user->vending_point_id = $vending_point_id;
            $add_user->save();

            Alert::toast('User registered successfully','success');
            return redirect()->back();
        }
        catch (exception $e) {
                echo 'Caught exception';
            }
    }
}
