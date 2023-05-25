<?php

namespace App\Services;

interface iNewsletter {
    public function subscribe(string $email, string $list = null);
}