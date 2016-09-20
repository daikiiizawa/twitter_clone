<div class="col-md-12">
<h2 class="text-center">設定変更</h2>

<!-- <form class="form-horizontal"> -->

<?= $this->Form->create('User', [
            'type' => 'file',
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

<?= $this->Form->input('password_current', [
            'label' => '現在のパスワード',
            'type'  => 'password',
            'class' => 'form-control'
            ]); ?>

<?= $this->Form->input('password', [
            'label' => '新パスワード',
            'type'  => 'password',
            'class' => 'form-control',
            ]); ?>

<?= $this->Form->input('password_confirm', [
            'label' => 'パスワード(確認)',
            'type'  => 'password',
            'class' => 'form-control'
            ]); ?>

<table>
<tr>
    <td>
        <?php if ($currentUser['photo']) :?>
            <?= $this->Html->image(
                "/files/user/photo" . "/" . $currentUser["photo_dir"] . "/" . $currentUser["photo"] ,[
                'style' => 'width: 150px; margin-top: 10px; margin-right: 10px;'
                ]);?>
        <?php else :?>
            <?= $this->Html->image(
                "/img/acountSample.png" ,[
                'style' => 'width: 150px; margin-top: 10px; margin-right: 10px;'
            ]);?>
        <?php endif ;?>
    </td>

    <td>
    <?= $this->Form->input('photo', [
              'type' => 'file',
              'label' => 'プロフィール画像',
              ]); ?>
    </td>
</tr>
</table>

<?= $this->Form->input('photo_dir', [
            'type' => 'hidden'
            ]); ?>


<?= $this->Form->input('body', [
            'label' => 'プロフィール',
            'type' => 'body',
            'class' => 'form-control',
            'rows' => "4"
            ]); ?>

<?= $this->Form->hidden('id') ?>

<?= $this->Form->end([
            'label' => '設定変更する',
            'class' => 'btn btn-primary btn-lg center-block',
            'style' => 'margin-top: 20px;'
            ]); ?>

</div>