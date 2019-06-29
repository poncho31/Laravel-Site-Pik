<?php

namespace App\Http\Controllers;

use App\contact;
use Illuminate\Http\Request;
use App\Mail\contact as contactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function store(Request $request){
        $name =$request->post('name');
        $email =$request->post('email');
        $object =$request->post('object');
        $message =$request->post('message');

        // save mail in DB
        $contact = new contact();
        $contact->name = $name;
        $contact->email = $email;
        $contact->object = $object;
        $contact->message = $message;
        $contact->save();

        //Send mail
        Mail::to('pikpinchart@gmail.com')->send(new contactMail($contact));

        Session::flash('message', 'Mail send'); 
        Session::flash('alert-class', 'alert-success'); 
        return back();
    }

    public function mailReceive(){
        return view('contact.mailReceive');
    }
}
