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
	<div class="galerias form">
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
			<div class="col-xs-12 col-sm-8">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header">
								<?php echo $this->Form->input('Galeria.id'); ?>
								<h3 class="box-title">Galeria</h3>
							</div>
							<div class="box-body">
								<?php echo $this->Form->input('Galeria.title', array('label' => 'Título da Galeria')); ?>
								<?php echo $this->Form->input('Galeria.body', array('label' => 'Descrição')); ?>
								<?php //echo $this->Form->input('Galeria.capa', array('label' => 'Foto de Capa', 'type' => 'file')); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12 box-wrapper">						
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Fotos</h3>
								<div class="box-tools pull-right">
		                            <div class="btn-group" data-toggle="btn-toggle">
										<a href="#" class="btn btn-success btn-xs galeria-foto-novo">Nova Foto</a>
										<a href="#" class="btn btn-danger btn-xs galeria-foto-delete-selected">Excluir Selecionados</a>
		                            </div>
		                        </div>
							</div>
							<div class="box-body">
								<div class="row fotos-thumb-caption">
									<?php echo $this->Form->input('Foto.image', array('type' => 'file', 'multiple' => true, 'label' => false, 'div' => false, 'class' => array('hide'))); ?>
									<?php foreach ($this->request->data['Foto'] as $key => $foto) { ?>
										<div class="col-xs-12 col-md-3 galeria-foto-div">
											<div href="#" class="thumbnail" data-foto-id="<?php echo $foto['id'] ?>">
												<a href="#" class="galeria-foto">
													<?php echo $this->Html->image('fotos/thumb.' . $foto['image'], array('class' => 'img-responsive')); ?>
												</a>
												<div class="caption">
													<?php echo $this->Form->input('Foto.title', array('label' => false, 'div' => false, 'placeholder' => 'Legenda:', 'default' => $foto['title'])); ?>
													<div class="btn-group" data-toggle="buttons">
														<label class="btn btn-xs btn-primary">
															<input class="galeria-foto-advanced-edit" type="checkbox" data-toggle="tooltip" data-title="Edição Avançada"> Editar
														</label>
													</div>
													<a href="#" class="btn btn-xs btn-danger galeria-foto-delete">Excluir</a>
													<a href="#" class="btn btn-xs btn-success galeria-foto-save">Salvar</a>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Informações</h3>
					</div>
					<div class="box-body">
						<strong>Criado em:</strong> <?php echo date('d/m/Y à\s H:i', strtotime($this->request->data['Galeria']['created'])); ?>
						<?php if ($this->request->data['Galeria']['created'] != $this->request->data['Galeria']['modified']) { ?>
							<strong>Última modificação:</strong> <?php echo date('d/m/Y à\s H:i', strtotime($this->request->data['Galeria']['modified'])); ?>
						<?php } ?>
					</div>
					<div class="box-footer clearfix">
						<?php echo $this->Form->postLink('Excluir', array('action' => 'delete', $this->request->data['Galeria']['id']), array('class' => 'text-danger', 'style' => 'line-height:34px;'), 'Deseja realmente excluir este item? Essa ação é IRREVERSÍVEL e também excluirá todas as fotos.'); ?>
						<div class="btn-group pull-right" data-toggle="btn-toggle">
							<?php echo $this->Form->submit('Salvar', array('class' => 'btn btn-success', 'div' => false)) ?>
							<?php echo $this->Html->link('Descartar Alterações', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
</section>

<script>
<?php $this->Html->script('admin/vendor/FileAPI/FileAPI.min', array('inline' => false)); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(function() {
    var TA = {
        fotos: {
            index: 0,
            files: []
        }
    };

    $('.galeria-foto-delete-selected').click(function(e) {
    	e.preventDefault();
    	var checkeds = [];
    	$('.galeria-foto-check-delete:checked').each(function(index, el) {
    		checkeds.push($(this).parent().parent().parent().parent().attr('data-foto-id'));
    	});

		if (confirm('Gostaria de excluir os itens? Essa ação é IRREVERSÍVEL.')) {
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller' => 'fotos', 'action' => 'delete')); ?>/id:' + checkeds.join('/id:') + '/',
				type: 'DELETE',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					if (data.status === true) {
						$('.thumbnail.checked').parent().fadeOut(function(){ $(this).remove()});
					} else {
						console.log(data, textStatus, jqXHR);
					}
				}, error: function(data, textStatus, jqXHR) {
					console.log(data, textStatus, jqXHR);
					alert('Erro ao excluir foto. Tente novamente.');
				}, always: function() {
					$this.parent().parent().find('.overlay').delay(3000).fadeOut(function()	{$(this).remove()});
				}
			});
		}
    });

    $('.galeria-foto-check-delete').change(function(e) {
	    $(this).parent().parent().parent().parent().addClass('checked');
    });

    $('.galeria-foto-novo').click(function(e) {
        e.preventDefault();
        $('#FotoImage').trigger('click');
    });

	FileAPI.event.on($('#FotoImage')[0], 'change', function(evt) {
		var files = FileAPI.getFiles(evt); // Retrieve file list
		var fotoKey = $('.thumbnail.galeria-foto.opened').data('foto-key');
		FileAPI.filterFiles(files, function(file, info /**Object*/ ) {
			if (/^image/.test(file.type)) {
				return info.width >= 320 && info.height >= 240;
			}
			return false;
		}, function(files, rejected) {
			if (files.length) {
				FileAPI.each(files, function(file) {
					if (file.size < 3000000) {
						FileAPI.Image(file).preview(500).get(function(err, img) {

							if (typeof fotoKey !== 'undefined') {
								TA.fotos.files[fotoKey] = file;
								$('.thumbnail.galeria-foto[data-foto-key="' + fotoKey + '"]').prepend(img);
							} else {
								TA.fotos.files.push(file);
								var thumbnail = $($('#thumbnail-tmpl').html());
								thumbnail
									.children('.thumbnail')
									.attr("data-foto-uid", FileAPI.uid(file))
									.attr("data-foto-key", TA.fotos.index++)
									.prepend($(img).addClass('img-responsive').wrap('<a href="#" class="galeria-foto"></a>'));
								thumbnail.find('.caption').addClass('hide');
								thumbnail.appendTo('.fotos-thumb-caption');
								console.log($('[data-foto-uid="'+ FileAPI.uid(file) +'"]'));
							}
						});
					} else {
						alert('Arquivo maior que 3 MB.');
					}
				});
				// Uploading Files
				Pace.track(function(){
					FileAPI.upload({
						url: "<?php echo $this->Html->url(array('controller' => 'fotos', 'action' => 'add', 'ext' => 'json')); ?>",
						data: {
							"data[Foto][galeria_id]": $('#GaleriaId').val()
						},
						files: {
							"data[Foto][image]": files
						},
						fileupload: function(file, xhr, options) {
							$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
								.find('.progress')
								.removeClass('hide')
								.fadeIn();
						},
						fileprogress: function(evt, file) {
							var progress = parseInt(Math.ceil(evt.loaded/evt.total * 100));
							$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
								.find('.progress-bar')
								.css('width', progress + '%')
								.text(progress + '%');
						},
						filecomplete: function(err, xhr, file) {
							console.log(xhr)
							if (xhr.status === 200) {
								var response = jQuery.parseJSON(xhr.responseText);
								var url = response.foto.Foto.thumb_uri;

								$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
									.find('.progress-bar')
									.addClass('progress-bar-success')
									.text('Enviado')
									.parent()
									.delay(5000)
									.fadeOut(function(){$(this).remove()});

								$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
									.find('.caption.hide')
									.removeClass('hide');

								$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
									.find('canvas')
									.replaceWith($('<a href="#" class="galeria-foto"></a>').html($('<img src="'+url+'">')[0]));

								$('[data-foto-uid="'+ FileAPI.uid(file) +'"]')
									.attr({
										'data-foto-id': response.foto.Foto.id,
										'data-foto-uid': ''
									});
							}
						}
					});
				});
			}
		});
		$(this).attr('multiple', true);
		$('.thumbnail.galeria-foto').removeClass('opened');
	});

	$(document).on('click', '.galeria-foto-save', function(e) {
		e.preventDefault();
		var fotoId = $(this).parent().parent().attr('data-foto-id'), $this = $(this);
		if (typeof fotoId !== 'undefined') {
			$(this).parent().parent().append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller' => 'fotos', 'action' => 'edit')); ?>/' + fotoId,
				type: 'PUT',
				data: {
					"data[Foto][id]": fotoId,
					"data[Foto][title]": $this.prev().prev().prev().val()
				},
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					$this.parent().parent().find('.overlay').html('<i class="fa fa-check"></i>').delay(5000).fadeOut(function(){$(this).remove()});
					console.log($this.parent().parent().find('.overlay'));
				}, error: function(data, textStatus, jqXHR) {
					console.log(data);
					alert('Erro ao editar foto. Tente novamente.');
				}, always: function() {
					$this.parent().parent().find('.overlay').delay(3000).fadeOut(function()	{$(this).remove()});
				}
			});
		}
	});

	$(document).on('click', '.galeria-foto-delete', function(e) {
		e.preventDefault();
		var fotoId = $(this).parent().parent().attr('data-foto-id'), $this = $(this);
		if (confirm('Gostaria de excluir o item? Essa ação é IRREVERSÍVEL.')) {
			$(this).parent().parent().append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller' => 'fotos', 'action' => 'delete')); ?>/' + fotoId,
				type: 'DELETE',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					if (data.status === true) {
						$this.parent().parent().parent().fadeOut(function(){ $(this).remove()});
					}
				}, error: function(data, textStatus, jqXHR) {
					console.log(data);
					alert('Erro ao excluir foto. Tente novamente.');
				}, always: function() {
					$this.parent().parent().find('.overlay').delay(3000).fadeOut(function()	{$(this).remove()});
				}
			});
		}
	});

	$(document).on('click', '.galeria-foto', function(e) {
		e.preventDefault();
		$(this).addClass('opened');
		$('#FotoImage').attr('multiple', false);
		$('#FotoImage').trigger('click');
	});


});
<?php $this->Html->scriptEnd(); ?>
</script>

<?php $this->Html->scriptStart(array('inline' => false, 'safe' => false, 'type' => 'text/template', 'id' => 'thumbnail-tmpl')); ?>
	<div class="col-xs-12 col-md-3 galeria-foto-div">
		<div href="#" class="thumbnail">
			<span class="progressbar">
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
						0%
					</div>
				</div>
			</span>
			<div class="caption">
				<?php echo $this->Form->input('Foto.title', array('label' => false, 'div' => false, 'placeholder' => 'Legenda:')); ?>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-xs btn-primary">
						<input class="galeria-foto-check-delete" type="checkbox"> Selecionar
					</label>
				</div>
				<a href="#" class="btn btn-xs btn-danger galeria-foto-delete">Excluir</a>
				<a href="#" class="btn btn-xs btn-success galeria-foto-save">Salvar</a>
			</div>
		</div>
	</div>
<?php $this->Html->scriptEnd(); ?>