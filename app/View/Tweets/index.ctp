<div class="container">
<div class="col-md-12">

    <!-- 新規投稿フォーム -->
    <?php if ($currentUser) :?>
        <?= $this->element('Tweets/form', [
                'actionLabel' => 'index',
                'submitLabel' => '投稿'
                ]); ?>
    <?php endif ;?>

    <!-- ソート機能 -->
    <div class="col-xs-12" style="margin-top: 10px;">
        <?= $this->element('Tweets/sort'); ?>
    </div>

    <!-- 検索機能 -->
    <?= $this->element('Tweets/search'); ?>

    <!-- 投稿一覧表示 -->
    <?= $this->element('Tweets/list'); ?>

</div>

<!-- ページネーション -->
<div class="text-center" style="margin-bottom: 40px;">
    <?= $this->paginator->prev('<< 前へ'); ?>&nbsp;
    | <?= $this->paginator->numbers(); ?>&nbsp;|
    <?= $this->paginator->next('次へ >>'); ?>
</div>

</div>