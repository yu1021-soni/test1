<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view ('index');
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only(['last_name','first_name']);
        return view('confirm',compact('contact'));
    }

    public function store(ContactRequest $request){
        $contact = $request->only(['last_name','first_name']);
        Contact::create($contact);
        return view('thanks');
    }
}
