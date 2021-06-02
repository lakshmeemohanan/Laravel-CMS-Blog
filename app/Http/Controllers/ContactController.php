<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return view('admin.contact-us', compact('contacts'));
    }
    public function show(){
        return view('contact'); 
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);
        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;

        $contact->save();
        Mail::send('mail-templates.contact-us',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'phone_number' => $request->get('phone_number'),
                'msg' => $request->get('message'),
            ), function($message) use ($request)
            {
                $message->from($request->email);
                $message->to('mohananlakshmee@gmail.com');
        });

        Session::flash('contact-submitted', ' Thank you for contacting us. We will get back to you soon.');
        return back();
    }
    public function destroy(Contact $contact){
        $contact->delete();
        Session::flash('contact-deleted', 'Record deleted successfully');
        return redirect()->route('admin.contact');
    }
}
