<?php

class TweetsController extends AppController {
    public $uses = ['Tweet', 'User', 'Favorite'];
    public $name = 'Tweets';

    public $components = [
        'Paginator' => [
            'limit' => 10,
            'order' => ['created' => 'desc'],
        ],
    ];

    public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('view', 'edit', 'delete', 'reply'))) {
            $tweetId = (int) $this->request->params['pass'][0];
            if ($this->Tweet->isOwnedBy($tweetId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function index() {
        // 全データを渡す
        $tweets = $this->Paginator->paginate('Tweet');

        $this->set('tweets', $tweets);
        $this->set('id', null);

        // 投稿機能
        if ($this->request->is('post')) {
            $this->add();
        }
    }

    // indexアクション内で実行
    private function add(){
        $userId = $this->Auth->user('id');
        $this->Tweet->create();
        $this->request->data['Tweet']['user_id'] = $userId;

        if ($this->Tweet->save($this->request->data)) {
            return $this->redirect(['action' => 'index']);
        } else {
            $this->render('index');
        }
    }

    public function find() {
        if ($this->request->data) {
            $search = $this->request->data['Tweet']['search'];
            $conditions = array('Tweet.content LIKE' => "%{$search}%");
            $tweets = $this->paginate('Tweet', $conditions);

        } else {
            $tweets = $this->paginate('Tweet');
        }
        $this->set('tweets', $tweets);
    }

    public function view($id = null) {
        if (!$this->Tweet->exists($id)) {
            throw new NotFoundException('ツイートがみつかりません');
        }

        $tweet  = $this->Tweet->findById($id);
        $tweets = $this->Tweet->find('all');

        // ビューに値を渡す
        $this->set('tweet', $tweet);

        // ビューに全てのツイートを渡す
        $this->set('tweets', $tweets);
        $this->set('id', $id);

        // 返信機能
        if ($this->request->is('post')) {
            $this->reply($id);
        }
    }

    // viewアクション内で実行
    private function reply($id) {
        $userId = $this->Auth->user('id');
        $this->Tweet->create();
        $this->request->data['Tweet']['user_id'] = $userId;

        if ($this->Tweet->save($this->request->data)) {
            return $this->redirect([
                'action' => 'view', $id
            ]);
        }
    }

    public function edit($id = null) {
        if (!$this->Tweet->exists($id)) {
            throw new NotFoundException('投稿がみつかりません');
        }

        if ($this->request->is(['post', 'put'])) {
            if ($this->Tweet->save($this->request->data)) {
                return $this->redirect(['action' => 'view',$id]);
            }
        } else {
            $this->request->data = $this->Tweet->findById($id);
        }
        $this->set('id', null);
    }

    public function delete($id = null) {
        if (!$this->Tweet->exists($id)) {
            throw new NotFoundException('投稿がみつかりません');
        }

        $this->request->allowMethod('post', 'delete');
        $this->Tweet->delete($id);

        return $this->redirect(['action' => 'index']);
    }

    // ユーザープロフィールページ
    public function account() {
        $conditions = ['Tweet.user_id' => $this->Auth->user('id')];
        $tweets = $this->paginate($conditions);
        // $tweets = $this->paginate();
        // ビューに全てのツイートを渡す
        $this->set('tweets', $tweets);
    }
}
