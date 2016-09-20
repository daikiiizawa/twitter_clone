<div class="container">
<div class="col-xs-12">

<!-- プロフィール表示 -->
<table>
    <tr>
        <td>
        <?php if ($currentUser['photo']) :?>
            <?= $this->Html->image("/files/user/photo" . "/" . $currentUser["photo_dir"] . "/" . $currentUser["photo"] ,['style' => 'width: 200px']);?>
        <?php else :?>
            <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 200px']);?>
        <?php endif ;?>
        </td>

        <td style="padding-left: 20px; margin-top: 0px;">
            <h4>
                <?= '@' . h($currentUser['name']) ;?>&nbsp;
                <span class="text-danger">
                最終ログイン日: <?= $this->Time->format($currentUser['last_login'], '%Y-%m-%d %H:%M:%S') ;?>
                </span>
            </h4>
            <p>プロフィール</p>
            <p><?= h($currentUser['body']) ;?></p>
        </td>
    </tr>
</table>

<!-- ツイート一覧表示 -->
<table class="col-xs-12">
    <div class="list-group">
        <?php foreach ($tweets as $tweet) : ?>
        <!-- ログインユーザーに絞る -->
        <?php if ($tweet['User']['id'] == $currentUser['id']) :?>
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
                </ul>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</table>

</div>
<!-- ページネーション -->
<div class="text-center" style="margin-bottom: 40px;">
    <?= $this->paginator->prev('<< 前へ'); ?>&nbsp;
    | <?= $this->paginator->numbers(); ?>&nbsp;|
    <?= $this->paginator->next('次へ >>'); ?>
</div>

</div>