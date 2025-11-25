<?php
return [
    'host' => 'smtp.gmail.com',
    'smtp_auth' => true,
    'username' => 'your-email@gmail.com',
    'password' => 'your-app-password',
    'encryption' => 'tls',
    'port' => 587,
    'from' => [
        'address' => 'your-email@gmail.com',
        'name' => 'Your Application'
    ],
    'is_html' => true,
    'charset' => 'UTF-8'
];