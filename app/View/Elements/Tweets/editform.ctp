<div class="form-group">
    <?= $this->Form->create('Tweet', [
                'novalidate' => true,
                'url' => [
                    'action' => $actionLabel
                ]]); ?>

    <?= $this->Form->input('content', [
                'label' => false,
                'placeholder' => "(本文は140字以内で投稿)",
                'class' => 'form-control',
                'default' => $edittweet['Tweet']['content'],
                'rows' => "4"
                ]); ?>

    <?= $this->Form->hidden('id'); ?>

    <!-- 返信の時のみreplyのidを渡す -->
    <?php if (isset($id)) : ?>
        <?= $this->Form->hidden('Tweet.reply_tweet_id', [
                    'value' => $id
                    ]); ?>
    <?php endif;?>

    <div class='pull-right'>
        <?= $this->Form->end([
                'label' => $submitLabel,
                'class' => 'btn btn-large btn-primary'
                ]); ?>
    </div>
</div>