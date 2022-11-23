<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Mail\Subscribe;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function subscribe(Request $request){
        // dd($request->all());
        try {
            $request->validate([
                'txt_name' => 'required',
                'txt_email' => 'required',
                'txt_phone_number' => 'required'
            ], [
                'txt_name.required' => 'Name is required',
                'txt_email.required' => 'Email is required',
                'txt_phone_number.required' => 'Phone Number is required',
            ]);

            $name = ucwords(trans($request->get('txt_name')));
            $email = $request->get('txt_email');
            $phone_number = $request->get('txt_phone_number');
            $terms = $request->get('terms');


            $add_subscribe = new Home();
            $add_subscribe->name = $name;
            $add_subscribe->email = $email;
            $add_subscribe->phone_number = $phone_number;
            $add_subscribe->save();


            $details = [
                'title'=>'Veetickets Promotion',
                'name'=> $name,
                'email'=> $email,
                'body'=>'Your data has been captured for Veetickets ongoing promotion.'
            ];

            Mail::to($email)->send(new Subscribe($details));

            // return redirect()->back();
            return redirect('https://veetickets.com');

        }
        catch (exception $e) {
            echo 'Caught exception';
        }
    }


}
