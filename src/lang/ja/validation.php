<?php

return [
    'required' => ':attributeは必須です。',
    'string'   => ':attributeは文字列で入力してください。',
    'email'    => ':attributeは正しいメールアドレスの形式で入力してください。',
    'image'    => ':attributeには画像ファイルを選択してください。',
    'uploaded' => ':attributeのアップロードに失敗しました。',

    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
        'file'   => ':attributeは:maxKB以下のファイルを選択してください。',
    ],

    'attributes' => [
        'title'    => 'タイトル',
        'body'     => '詳細',
        'image'    => '画像',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
    ],
];