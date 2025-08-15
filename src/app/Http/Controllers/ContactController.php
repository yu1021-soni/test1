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
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ]);
        Contact::create($contact);
        return view('thanks');
    }

    public function back(Request $request){
    // 入力データを old() にセットして index.blade.php に戻す
    return redirect('/')->withInput($request->all());
    }

    public function admin(Request $request){
    $filters = $request->only(['keyword','gender','content','date']);

    $contacts = Contact::with('category')
        ->filter($filters)
        ->orderByDesc('created_at')
        ->paginate(7)
        ->withQueryString();
    
    // ① ?modal=ID を拾う
    $openId = (int) $request->input('modal');

    // ② その1件だけ取得（なければ null）
    $openContact = $openId ? Contact::with('category')->find($openId) : null;

    // ③ “今のページに見えている行”以外のIDだったら開かない（任意のガード）
    if ($openContact && !$contacts->getCollection()->contains('id', $openId)) {
        $openContact = null;
    }

    return view('admin', compact('contacts','openContact'));
    }


    public function destroy(Contact $contact){
    $contact->delete();
    return redirect('admin');
    }
}
