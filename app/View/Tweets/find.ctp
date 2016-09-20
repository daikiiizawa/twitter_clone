<div class="container">
<div class="col-xs-12">

    <!-- ソート機能 -->
    <?= $this->element('Tweets/sort'); ?>

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