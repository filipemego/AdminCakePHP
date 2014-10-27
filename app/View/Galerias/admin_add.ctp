<section class="content-header">
	<h1>
		Galeria
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Galeria</a></li>
	</ol>
</section>
<section class="content">
	<div class="users form">
<?php
echo $this->Form->create(
	'Galeria',
	array(
		'type' => 'file',
		'inputDefaults' => array(
			'class' => 'form-control',
			'div' => array(
				'class' => 'form-group'
			)
		),
		'novalidate' => true
	)
);	
?>
	<fieldset>
		<div class="row box-group">
			<div class="col-xs-12 col-sm-12 box-wrapper">
				<div class="box box-primary clearfix">
					<div class="box-header">
						<h3 class="box-title">Galeria</h3>
					</div>
					<div class="box-body">
						<?php echo $this->Form->input('Galeria.title', array('label' => 'Título da Galeria')); ?>
						<?php echo $this->Form->input('Galeria.body', array('label' => 'Descrição')); ?>
						<?php //echo $this->Form->input('Galeria.capa', array('label' => 'Foto de Capa', 'type' => 'file')); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-success')); ?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</section>