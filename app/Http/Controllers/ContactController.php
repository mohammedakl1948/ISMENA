<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;
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
    function sendEmail(){
        $data=[
            'form_name' =>' $request->form_name',
            'form_email' =>  '$request->form_email',
            'form_Phone' => '$request->form_Phone',
            'form_Subject' => '$request->form_Subject',
            'form_message' => '$request->form_message'
        ];
        Mail::send('emails.welcome', $data, function ($message) {
            $message->to('mohammedakl6671@gmail.com' , 'LGS')->subject('Feedback');
            $message->from('info@lgsolucion.com', 'LGS');

        });
        $message = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
        $status = "true";
        $status_array = array( 'message' => $message, 'status' => $status);
        return json_encode($status_array);
    }
}
