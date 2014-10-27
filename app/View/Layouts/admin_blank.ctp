<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
        <title>AdmInterage</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<?php
			echo $this->Html->css('admin/css/bootstrap.min');
			echo $this->Html->css('admin/css/font-awesome.min');
			echo $this->Html->css('admin/css/ionicons.min');
			echo $this->Html->css('admin/css/daterangepicker/daterangepicker-bs3');
			echo $this->Html->css('admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min');
			echo $this->Html->css('admin/css/AdminLTE.css');

			echo $this->Html->meta('icon');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
		
		<?php echo $this->fetch('content'); ?>

		<?php

			echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js');
			echo $this->Html->script('admin/AdminLTE/main.js');
			echo $this->Html->script('admin/jquery-ui-1.10.3.min');
			echo $this->Html->script('admin/bootstrap.min');
			echo $this->Html->script('admin/plugins/daterangepicker/daterangepicker');
			echo $this->Html->script('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min');
			echo $this->Html->script('admin/plugins/iCheck/icheck.min');
			echo $this->Html->script('admin/AdminLTE/app.js');
			echo $this->Html->script('admin/AdminLTE/dashboard.js');

			echo $this->fetch('script');
		?>
    </body>
</html>