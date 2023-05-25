<?php

namespace App\Services;

use App\Services\iNewsletter;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements iNewsletter
{
    // Newsletter's dependency
    // laravel checks all the dependencies recursively..
    public function __construct(protected ApiClient $client /*, protected String $foo*/)
    {
        //
    }
    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers'); //??= assign this value if it is null

        return $this->client->lists->addListMember($list, [
            'email_address' => $email,
            'status' => "subscribed"
        ]);
    }
}
