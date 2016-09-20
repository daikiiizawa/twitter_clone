<div class="container">
<div class="col-xs-12">

<?php if ($currentUser['role'] == 'admin' || $currentUser['id'] == $tweet['User']['id']) :?>
<div class="pull-right">
    <?= $this->Html->link(
        '投稿の編集', [
            'action' => 'edit',
            $tweet['Tweet']['id'] ], [
                'class' => "btn btn-primary"
        ]); ?>

    <?= $this->Form->postLink(
        '投稿の削除', [
            'action' => 'delete',
            $tweet['Tweet']['id']
        ], [
            'confirm' => '本当に削除してよろしいですか？',
            'class' => "btn btn-danger"
        ]); ?>
</div>
<?php endif ;?>


<!-- ツイート詳細表示 -->
<table class="col-xs-12">
<div class="list-group">
    <tr class="list-group-item">
        <td style="width:10%;">
            <?= $this->User->photoImage($tweet, ['style' => 'width: 100px']); ?>
        </td>

        <td style="width:90%;">
            <ul style="list-style:none;">
                <li style="margin-left:-10px;">
                    <strong><u>@<?= h($tweet['User']['name']); ?></u></strong>
                    (<?= $this->Html->link(
                         $this->Time->format($tweet['Tweet']['created'], '%Y-%m-%d %H:%M:%S'),
                         ['action' => 'view', $tweet['Tweet']['id']]
                         ); ?>)
                </li>

                <li>
                    <h5><?= h($tweet['Tweet']['content']) ; ?></h5>
                </li>

                <?php if($currentUser) :?>
                <li style="margin-left:-10px;">
                    <div class="btn btn-link btn-xs">
                        <?= $this->Html->link(
                        '返信', [
                        'action' => 'view',
                        $tweet['Tweet']['id']]
                        ); ?>
                    </div>

                    <div class="btn-group">
                        <?= $this->Form->create('Favorite', ['controller' => 'favorites','url'=>['action'=>'add']]); ?>
                        <?= $this->Form->input('Favorite.user_id', ['type'=>'hidden', 'value'=>$tweet['User']['id']]); ?>
                        <?= $this->Form->input('Favorite.tweet_id', ['type'=>'hidden', 'value'=>$tweet['Tweet']['id']]); ?>
                        <?= $this->Form->input('Favorite.user_name', ['type'=>'hidden', 'value'=>$currentUser['name']]); ?>
                        <?= $this->Form->end(['label' => 'お気に入り','class' => "btn btn-link btn-xs"]); ?>
                    </div>

                    <!-- モーダル表示 -->
                    <a href="" data-toggle="modal" data-target="#modal-<?= $tweet['Tweet']['id'] ;?>">
                        (<?= count($tweet['Favorite']); ?>)
                    </a>

                    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                    <div class="modal fade" id="modal-<?= $tweet['Tweet']['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                        <h4 class="modal-title" id="myModalLabel">お気に入り一覧</h4>
                                </div>

                                <div class="modal-body">
                                    <!-- お気に入りしたユーザーを一覧で表示 -->
                                    <?php foreach ($tweet['Favorite'] as $tweet['Favorite']) :?>
                                        <strong class="list-group-item">
                                            <u>@<?= h($tweet['Favorite']['user_name']); ?></u>
                                        </strong>
                                    <?php endforeach ;?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- モーダル終わり -->
                </li>
                <?php endif ;?>
            </ul>
        </td>
    </tr>
</div>
</table>


<!-- 返信ツイート表示 -->
<?= $this->element('Tweets/replylist'); ?>

<!-- 返信フォーム -->
<?php if ($currentUser) :?>
<table class="col-xs-10 pull-right">
    <div class="list-group">
        <tr class="col-md-12 list-group-item">
            <td style="width:10%;">
                <?php if ($currentUser['photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $currentUser["photo_dir"] . "/" . $currentUser["photo"] ,['style' => 'width: 100px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 100px']);?>
                <?php endif ;?>
            </td>

            <td style="width:70%;">
                <?= $this->element('Tweets/form', [
                    'actionLabel' => 'view/'.$id,
                    'submitLabel' => '返信'
                ]); ?>
            </td>
        </tr>
    </div>
</table>
<?php endif ;?>


</div>
</div>