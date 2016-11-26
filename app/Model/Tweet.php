<?php

class Tweet extends AppModel {

    public $validate = [
        'content' => [
            'required' => [
                'rule' => ['between', 2, 140],
                'message' => '本文は2文字以上140字以下で入力してください。'
            ],
        ]
    ];

    public $belongsTo = [
        'User' => ['className' => 'User'],
    ];

    public $hasMany = [
        'Favorite' => [
            'className' => 'Favorite',
            'dependent' => true
        ],
    ];

    public function isOwnedBy($tweet, $user) {
        return $this->field('id', [
            'id' => $tweet,
            'user_id' => $user
            ]) !== false;
    }
}