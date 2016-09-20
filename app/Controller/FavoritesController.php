<?php

class FavoritesController extends AppController {
    public $uses = ['Favorite', 'Tweet'];

    public function add(){
        if ($this->request->is('post')) {
            $this->request->data['Favorite']['user_id'] = $this->Auth->user('id');
            if ($this->Favorite->save($this->request->data)) {
                $this->redirect(['controller'=>'tweets', 'action'=>'index']);
            } else {
                $this->redirect(['controller'=>'tweets', 'action'=>'index']);
            }
        }
    }
}