<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view ('index');
    }

    public function confirm(ContactRequest $request){
        $contact = $request->only([
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'select',
            'detail'
        ]);
        return view('confirm',compact('contact'));
    }

    public function store(ContactRequest $request){
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'select',
            'detail'
        ]);
        Contact::create($contact);
        return view('thanks');
    }

    public function back(Request $request){
    // 入力データを old() にセットして index.blade.php に戻す
    return redirect('/')->withInput($request->all());
    }

    public function login(LoginRequest $request){
        
    }

    public function admin(Request $request){
    $filters = $request->only(['keyword','gender','content','date']);

    $contacts = Contact::with('category')
        ->filter($filters)           // ← モデル側のスコープ
        ->orderByDesc('created_at')
        ->paginate(7)
        ->withQueryString();

    return view('admin', compact('contacts'));
    }
}
