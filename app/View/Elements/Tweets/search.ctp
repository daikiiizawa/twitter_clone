<div class="form-group col-xs-12">
    <?= $this->Form->create(
        NULL, [
        'novalidate' => true,
        'url' => [
        'action' => 'find'
        ]]); ?>

    <?= $this->Form->input(
        'search', [
        'label' => '投稿を検索',
        'class' => 'form-control'
        ]); ?>

    <div class="pull-right">
        <?= $this->Form->end([
            'label'=>'検索',
            'class' => 'btn btn-large btn-default'
            ]); ?>
    </div>
</div>