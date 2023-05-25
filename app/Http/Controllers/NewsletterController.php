<?php

namespace App\Http\Controllers;

use App\Services\iNewsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /*
        This method was supposed to be invoked automatically
        i.e. without specifying its name in route.
        Accessing newsletter database directly from parameters::
        it is called automatic resolution. It does --> new Newsletter
        ((When there is no ctor dependency))....
        
        *Automatic resolution make instance of MailchimpNewsletter (specified in AppServiceProvider.php)

    */
    public function __invoke(iNewsletter $newsletter) 
    { 
        // ddd($newsletter);  
        request()->validate([
            'email' => 'required|email'
        ]);


        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => "Provided email couldn't be added to our newsletter list."
            ]);
        }
        return redirect("/")->with('success', "You subscribed our newsletter");
    }
}