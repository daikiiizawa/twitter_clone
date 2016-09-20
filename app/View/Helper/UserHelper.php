<?php

class UserHelper extends AppHelper {

    public $helpers = ['Html'];

    public function photoImage($user, $options = []) {

        $photoDir = Configure::read('Photo.dir');
        $defaultPhoto = Configure::read('Photo.default');

        if (empty($user['User']['photo'])) {
            $path = $defaultPhoto;
        } else {
            $path = $photoDir . $user['User']['photo_dir'] . '/' . $user['User']['photo'];
        }

        return $this->Html->image($path, $options);
    }

}

