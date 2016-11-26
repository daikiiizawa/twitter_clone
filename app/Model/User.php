<?php

App::uses(
    'BlowfishPasswordHasher',
    'Controller/Component/Auth',
    'CakeEmail',
    'Network/Email'
    );

class User extends AppModel {
    // 使用するビヘイビアの宣言
    public $actsAs = [
        // UploadプラグインのUploadBehaviorという意味
        'Upload.Upload' => [
            // photoというカラムに Uploadビヘイビアを使ってファイル名を登録する
            'photo' => [
                // デフォルトのカラム名 dir を photo_dir に変更
                'fields' => ['dir' => 'photo_dir'],
                'deleteOnUpdate' => true,
            ]
        ],
    ];

    public $hasMany = [
        'Favorite' => [
            'className' => 'Favorite',
            'dependent' => true
        ],
        'Tweet' => [
            'className' => 'Tweet',
            'dependent' => true // User が削除されたら Tweet も再帰的に削除する
        ]
    ];

    public $validate = [
        'name' => [
            'required' => [
                'rule' => ['minLength', 8],
                'message' => 'ユーザーネームは8文字以上で入力して下さい。'
            ],
            'nameExists' => [
                'rule' => ['isUnique', 'name'],
                'message' => '既にそのユーザーネームは使われています。'
            ],
        ],
        'email' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'メールアドレスを入力してください。'
            ],
            'validEmail' => [
                'rule' => 'email',
                'message' => '正しいメールアドレスを入力してください。'
            ],
            'emailExists' => [
                'rule' => ['isUnique', 'email'],
                'message' => '入力されたメールアドレスは既に登録されています。'
            ],
        ],
        'body' => [
            'required' => [
                'rule' => ['between', 2, 140],
                'message' => 'プロフィールは2文字以上110字以下で入力してください。'
            ],
        ],
        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワードを入力してください。'
            ],
            // バリデーションにメソッドを指定
            'match' => [
                'rule' => 'passwordConfirm',
                'message' => 'パスワードが一致していません。'
            ],
        ],
        'password_confirm' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワード(確認)を入力してください。'
            ],
        ],
        'password_current' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '現在のパスワードが入力されていません。',
            ],
            'match' => [
                'rule' => 'checkCurrentPassword',
                'message' => '現在のパスワードが間違っています。'
            ]
        ],
        'role' => [
            'valid' => [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            ]
        ],

        // 画像ファイルアップロードのバリデーション追加
        'photo' => [
            'UnderPhpSizeLimit' => [
                'allowEmpty' => true,
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'アップロード可能なファイルサイズを超えています。'
            ],
            'BelowMaxSize' => [
                'rule' => ['isBelowMaxSize', 5242880],
                'message' => 'アップロード可能なファイルサイズを超えています。'
            ],
            'CompletedUpload' => [
                'rule' => 'isCompletedUpload',
                'message' => 'ファイルが正常にアップロードされませんでした。'
            ],
            'ValidMimeType' => [
                'rule' => ['isValidMimeType', ['image/jpeg', 'image/png', 'image/gif'], false],
                'message' => 'プロフィール画像はjpg/gif/png形式でアップロードしてください。'
            ],
            'ValidExtension' => [
                'rule' => ['isValidExtension', ['jpeg', 'jpg', 'png', 'gif'], false],
                'message' => 'プロフィール画像はjpg/gif/png形式でアップロードしてください。'
            ],
            'size' => [
                'maxFileSize' => [
                    'rule' => ['fileSize', '<=', '500KB'],  // 500K以下
                    'message' => ['プロフィール画像のサイズは500KB以下にしてください。']
                ],
            ],
        ]
    ];

    // カスタムバリデーションメソッド
    public function passwordConfirm($check) {
        // $check は ['password' => '入力された値']
        if ($check['password'] === $this->data['User']['password_confirm']) {
            return true;
        }
        return false;
    }

    public function checkCurrentPassword($check) {
        // 入力されたパスワード
        $password = array_values($check)[0];
        // 入力された id に対応するユーザーを取得
        $user = $this->findById($this->data['User']['id']);
        // 入力されたパスワード と ユーザーのパスワードが一致するかをチェック
        $passwordHasher = new BlowfishPasswordHasher();

        if ($passwordHasher->check($password, $user['User']['password'])) {
            return true;
        }
        return false;
    }

    public function beforeSave($options = []) {
        // パスワードをハッシュ化
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();

            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
        return true;
    }

    public function updateLastLogin($id) {
        $this->id = $id;
        $data = array(
                'last_login' => date('Y-m-d H:i:s'),
                'modified' => false
                );
        return $this->save($data);
    }
}