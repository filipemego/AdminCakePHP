<div class="form-box" id="login-box">
	<div class="header"><?php echo Configure::read('Admin.name'); ?></div>
	<div class="body bg-gray">
		<?php echo $this->Session->flash(); ?>
		<?php 
		echo $this->Form->create(
			'User',
			array(
				'type' => 'file',
				'inputDefaults' => array(
					'class' => 'form-control',
					'div' => array(
						'class' => 'form-group'
					)
				)
			)
		);
		echo $this->Form->input('username', array('label' => 'Usuário'));
		echo $this->Form->input('password', array('label' => 'Senha'));
		?>
		<?php echo $this->Form->submit('Entrar', array('type' => 'submit', 'class' => 'btn bg-olive btn-block')) ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="text-center">Em caso de dúvidas entre em contato <br> (11) 3807-1262 | contato@dainterage.com.br</div>