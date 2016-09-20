<div class="col-md-12">

<?= $this->Flash->render('auth'); ?>
<h2 class="text-center">ログイン</h2>

<?= $this->Flash->render('auth'); ?>
<?= $this->Form->create('User', [
            'novalidate' => true,
            'class' => 'well form-horizontal',
            ]); ?>

<?= $this->Form->input('email', [
            'label' => 'メールアドレス',
            'class' => 'form-control'
            ]); ?>

<?= $this->Form->input('password', [
            'label' => 'パスワード',
            'class' => 'form-control'
            ]); ?>

<?= $this->Form->end([
            'label' => 'ログイン',
            'class' => 'btn btn-primary btn-lg center-block',
            'style' => 'margin-top: 20px;'
            ]); ?>

</div>
