<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    //
    function Index(){
        $message = Session::get('message');
        $contacts = Contact::all();
        return View('contactinfo' , ['contacts' => $contacts , 'message' => $message]);
    }
    function Add(Request $request){
        if($this->validator($request->email , $request->phonenumber)){
            return redirect('/')->with(['message' => 'error in email or phone']);
        }else {
            Contact::create(['FirstName' => $request->firstname, 'LastName' => $request->lastname, 'Email' => $request->email, 'PhoneNumber' => $request->phonenumber]);
            return redirect('/');
        }
    }
    function Delete(Request $request){
        $contact=Contact::find($request->id);
        $contact->delete();
        return redirect('/');
    }
    function Edit(Request $request){
        if($this->validator($request->email , $request->phonenumber)){
            return redirect('/')->with(['message' => 'error in email or phone']);
        }else {
            $this->validator($request->email, $request->phonenumber);
            $contact = Contact::find($request->id);
            $contact->FirstName = $request->firstname;
            $contact->LastName = $request->lastname;
            $contact->Email = $request->email;
            $contact->PhoneNumber = $request->phonenumber;
            $contact->save();

            return redirect('/');
        }
    }
    function validator($email , $phone){
        $validator = Validator::make(['email' => $email , 'phone'=>$phone], [
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return true;
        }

    }
}
