<?php
return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.googlemail.com',
        'username' => 'smokecastaneda@gmail.com',
        'password' => 'jacastaneda2015Gmail',
        'port' => '465',
        'encryption' => 'ssl',
    ],
];