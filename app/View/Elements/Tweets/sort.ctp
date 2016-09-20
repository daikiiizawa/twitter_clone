<ul class="pull-right">
    <li class="btn btn-default">
        <?php echo $this->paginator->sort('created','投稿順で並べ替え');?>
    </li>
    <li class="btn btn-default">
        <?php echo $this->paginator->sort('user_id','投稿者で並べ替え');?>
    </li>
</ul>