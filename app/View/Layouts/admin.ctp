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
			echo $this->Html->css('/js/admin/plugins/datepicker/css/datepicker3');
			echo $this->Html->css('admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min');
			echo $this->Html->css('admin/css/AdminLTE.css');

			echo $this->Html->script('https://code.jquery.com/jquery-2.1.1.min.js');
			echo $this->Html->script('admin/AdminLTE/main.js');
			echo $this->Html->script('admin/jquery-ui-1.10.3.min');
			echo $this->Html->script('admin/bootstrap.min');
			echo $this->Html->script('admin/plugins/daterangepicker/daterangepicker');
			echo $this->Html->script('admin/plugins/datepicker/js/bootstrap-datepicker');
			echo $this->Html->script('admin/plugins/datepicker/js/bootstrap-datepicker.pt-BR');
			echo $this->Html->script('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min');
			echo $this->Html->script('admin/plugins/iCheck/icheck.min');
			echo $this->Html->script('admin/AdminLTE/app.js');

			echo $this->fetch('script');

			echo $this->Html->meta('icon');

			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>

    </head>
    <body class="skin-blue">
		<header class="header">
            <a href="<?php echo $this->Html->url('/admin/'); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdmInterage
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <p class="navbar-text" style="color: #FFF;">(11) 3807-1262 | contato@dainterage.com.br</a></p>
                <span></span>
				<div class="navbar-right">
					<ul class="nav navbar-nav">
					<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="glyphicon glyphicon-user"></i>
								<span><?php echo AuthComponent::user('first_name'); ?> <?php echo @AuthComponent::user('last_name'); ?> <i class="caret"></i></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header bg-light-blue">
									<?php
									$foto = AuthComponent::user('foto');
									if (!empty($foto)) {
										echo $this->Html->image('membros/thumb.' . $foto, array('class' => 'img-circle'));
									} else {
										echo $this->Html->image('sem-foto.png', array('class' => 'img-circle'));
									}
									?>
									<p>
										<?php echo AuthComponent::user('first_name'); ?> <?php echo @AuthComponent::user('last_name'); ?>
									</p>
								</li>
								<!-- Menu Body -->
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<?php echo $this->Html->link('Perfil', array('controller' => 'users', 'action' => 'edit',  'prefix' => 'admin', 'admin' => true), array('class' => 'btn btn-default btn-flat')); ?>
									</div>
									<div class="pull-right">
										<?php echo $this->Html->link('Sair', array('controller' => 'users', 'action' => 'logout', 'prefix' => 'admin', 'admin'=> true), array('class' => 'btn btn-default btn-flat')); ?>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
							<?php
							$foto = AuthComponent::user('foto');
							if (!empty($foto)) {
								echo $this->Html->image('membros/thumb.' . $foto, array('class' => 'img-circle'));
							} else {
								echo $this->Html->image('sem-foto.png', array('class' => 'img-circle'));
							}
							?>
                        </div>
                        <div class="pull-left info">
                            <p>Olá, <?php echo AuthComponent::user('first_name'); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo $this->Html->url('/admin/'); ?>">
                                <i class="fa fa-home"></i> <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>">
                                <i class="fa fa-users"></i>
                                <span>Usuários</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'turmas', 'action' => 'index')); ?>">
                                <i class="fa fa-user"></i>
                                <span>Turmas</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'index')); ?>">
                                <i class="fa fa-cube"></i>
                                <span>Banner</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'rotinas', 'action' => 'index')); ?>">
                                <i class="fa fa-newspaper-o"></i>
                                <span>Rotina</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'calendarios', 'action' => 'index')); ?>">
                                <i class="fa fa-calendar"></i>
                                <span>Calendário</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'cardapios', 'action' => 'index')); ?>">
                                <i class="fa fa-cutlery"></i>
                                <span>Cardápio</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'comunicados', 'action' => 'index')); ?>">
                                <i class="fa fa-exclamation"></i>
                                <span>Comunicado</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'galerias', 'action' => 'index')); ?>">
                                <i class="fa fa-file-photo-o"></i>
                                <span>Galeria de Fotos</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'popups', 'action' => 'index')); ?>">
                                <i class="fa fa-square-o"></i>
                                <span>Popup da Home</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
				<?php echo $this->fetch('content'); ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>