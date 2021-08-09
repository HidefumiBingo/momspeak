<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

class ContactsController extends Controller
{
    //
    
    public function store(Request $request) {
        //バリデーション
        $request->validate([
            'content' => 'required|max:255',    
        ]);
        
        $contact = new Contact;
        $contact->user_id = \Auth::id();
        $contact->content = $request->content;
        $contact->save();
        
        return back();
    }

}
