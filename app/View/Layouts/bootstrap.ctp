<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo __('CakePHP: the rapid development php framework:'); ?>
      <?php echo $title_for_layout; ?></title>

    <!-- Bootstrap -->
    <?php echo $this->Html->css('cake.app.css'); ?>
    <?php echo $this -> Html -> css('bootstrap.min'); ?>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Le styles -->
    <style>
      /* something style */
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
        	<div class="navbar-header">
        		<a class="navbar-brand" href="/elites-test/twitter_clone/"><b>Twitter</b></a>
        	</div>

		    <ul class="nav navbar-nav navbar-right">
		    <?php if ($currentUser) : ?>
		        <li>
                    <?= $this->Html->link(
                        '@' . h($currentUser['name']),
                        ['controller' => 'tweets', 'action' => 'account']
                    ); ?>
		        </li>

		        <li>
		            <?= $this->Html->link(
		                '設定変更',
		                ['controller' => 'users', 'action' => 'edit']
		            ); ?>
		        </li>

		        <li>
		            <?= $this->Html->link(
		                'ログアウト',
		                ['controller' => 'users', 'action' => 'logout']
		            ); ?>
		        </li>

		    <?php else : ?>
		        <li>
		            <?= $this->Html->link(
		                '新規会員登録',
		                ['controller' => 'users', 'action' => 'add']
		            ); ?>
		        </li>
		        <li>
		            <?= $this->Html->link(
		                'ログイン',
		                ['controller' => 'users', 'action' => 'login']
		            ); ?>
		        </li>
		    <?php endif; ?>
		    </ul>
    		<div style="height: 1px;" aria-expanded="false" id="navbar" class="navbar-collapse collapse"></div>
		</div>

    </nav>

	<div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>

	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>

</body>
</html>
