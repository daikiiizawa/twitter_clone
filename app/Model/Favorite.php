<?php

class Favorite extends AppModel {

    public $belongsTo = [
        'User'  => ['className' => 'User'],
        'Tweet' => ['className' => 'Tweet']
    ];

    public $validate = [
        'user_name' => [
            'rule' => ['checkUnique', ['tweet_id', 'user_id'], false],
            'message' => '既にお気に入りに登録しています'
        ],
        'user_id' => [
            'rule' => ['notBlank'],
            'message' => 'お気に入りに登録できません'
        ],
    ];

    public function checkUnique($ignoredData, $fields, $or = true) {
        return $this->isUnique($fields, $or);
    }
}