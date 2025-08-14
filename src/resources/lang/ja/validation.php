<?php

return [
    'name' => ':attribute を入力してください。',
    'required' => ':attribute を入力してください。',
    'email'    => ':attribute は「ユーザ名＠ドメイン」形式で入力してください。',

    'attributes' => [
        'name' => 'お名前',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
    ],

    'custom' => [
        'name' => [
            'required' => 'お名前を入力してください',
        ],
        'email' => [
            'required' => 'メールアドレスを入力してください',
            'email'    => 'メールアドレスは「ユーザ名＠ドメイン」形式で入力してください',
        ],
        'password' => [
            'required' => 'パスワードを入力してください',
        ],
    ],
];
