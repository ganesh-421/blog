<?php

namespace App\Services;

use App\Services\iNewsletter;
use MailchimpMarketing\ApiClient;

class ConvertKitNewsletter implements iNewsletter
{
    public function subscribe(string $email, string $list = null)
    {
        //subscribe the user with convertkit specific api request
    }
    
}