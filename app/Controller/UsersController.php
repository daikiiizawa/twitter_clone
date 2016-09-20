<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    public $uses = ['User', 'Tweet'];
    public $helpers = ['User'];

    public function beforeFilter() {
        parent::beforeFilter();
        // ユーザー自身による登録とログアウトを許可する
        $this->Auth->allow('add', 'logout', 'edit');
    }

    public function add() {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                // サンクスメール送信設定済(app/Config/email.php設定変更後有効にする)
                // $this->thanks();
                return $this->redirect(['action' => 'login']);
            }
        }
    }

    public function thanks() {
        $email = new CakeEmail('gmail');
        $email->from('twitter@mail.com');
        $email->to($this->request->data['User']['email']);

        //HTMLorテキストメール
        $email->emailFormat('text');
        //テンプレート
        $email->template('thanks');
        //テンプレートへ渡す変数。[変数名=>値]
        $email->viewVars([
          'name' => $this->request->data['User']['name'],
          'email' => $this->request->data['User']['email'],
        ]);

        $email->subject('ご登録ありがとうございます。');
        $email->send();
    }

    public function login() {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->User->id = $this->Auth->user('id');
                $this->User->saveField('last_login', date('Y-m-d H:i:s'));
                $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('メールアドレスかパスワードが違います');
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function edit() {
        if ($this->request->is(['post', 'put'])) {

            if ($this->User->save($this->request->data)) {

                // Authコンポーネントのログインセッション情報をリフレッシュする
                $user = $this->User->find('first', [
                        'fields' => ['id', 'email', 'name', 'photo', 'photo_dir', 'body', 'role'],
                        'conditions' => ['id' => $this->Auth->user('id')]
                    ]);
                $this->Auth->login($user['User']);

                return $this->redirect($this->Auth->redirectUrl());
            }
        } else {
            $this->request->data = ['User' => [
                'id' => $this->Auth->user('id'),
                'name' => $this->Auth->user('name'),
                'email' => $this->Auth->user('email'),
                'photo_dir' => $this->Auth->user('photo_dir'),
                'photo' => $this->Auth->user('photo'),
                'body' => $this->Auth->user('body'),
                'role' => $this->Auth->user('role'),
                ]];
        }
    }
}