<?php

return [
    'secret_key_reset_password' => env('ADMIN_SECRET_KEY_RESET_PASSWORD', \Illuminate\Support\Str::random(30)),
    'admin_mail' => env('ADMIN_MAIL'),
];
