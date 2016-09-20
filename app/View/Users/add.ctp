<div class="col-md-12">
      <h2 class="text-center">新規登録</h2>

      <!-- <form class="form-horizontal"> -->

      <?= $this->Form->create('User', [
                  'type'  => 'file',
                  'novalidate' => true,
                  'class' => 'well form-horizontal',
                  ]); ?>

      <?= $this->Form->input('name', [
                  'label' => 'ユーザーネーム',
                  'type'  => 'name',
                  'class' => 'form-control'
                  ]); ?>

      <?= $this->Form->input('email', [
                  'label' => 'メールアドレス',
                  'type'  => 'email',
                  'class' => 'form-control'
                  ]); ?>

      <?= $this->Form->input('password', [
                  'label' => 'パスワード',
                  'type'  => 'password',
                  'class' => 'form-control'
                  ]); ?>

      <?= $this->Form->input('password_confirm', [
                  'label' => 'パスワード(確認)',
                  'type'  => 'password',
                  'class' => 'form-control'
                  ]); ?>

      <?= $this->Form->input('role', [
                  'type'    => 'hidden',
                  'default' => 'author'
                  // 'options' => [
                  //       'admin' => 'Admin', 'author' => 'Author'
                  //       ]
                  ]); ?>

      <?= $this->Form->input('photo', [
                  'type'  => 'file',
                  'label' => 'プロフィール画像',
                  'class' => null
                  ]); ?>

      <?= $this->Form->input('photo_dir', [
                  'type' => 'hidden'
                  ]); ?>


      <?= $this->Form->input('body', [
                  'label' => 'プロフィール',
                  'type'  => 'body',
                  'class' => 'form-control',
                  'rows'  => "4"
                  ]); ?>

      <?= $this->Form->end([
                  'label' => '登録する',
                  'class' => 'btn btn-primary btn-lg center-block',
                  'style' => 'margin-top: 20px;'
                  ]); ?>
</div>