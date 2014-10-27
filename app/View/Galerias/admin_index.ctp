<section class="content-header">
	<h1>
		Galerias
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#" class="active">Galerias</a></li>
	</ol>
</section>
<section class="content mailbox">
	<div class="galerias">
		<div class="box">
		    <div class="box-header">
		        <div class="box-tools">
	                <div class="input-group">
					<?php echo $this->Html->link('Nova', array('action' => 'add'), array('class' => 'btn btn-sm btn-primary')); ?>
	                    <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
	                    <div class="input-group-btn">
	                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
	                    </div>
	                </div>
	            </div>
		    </div><!-- /.box-header -->
		    <div class="box-body no-padding">
		        <table class="table table-striped">
		            <thead>
			            <tr>
			                <th style="width: 10px">Capa</th>
			                <th><?php echo $this->Paginator->sort('title', 'Título'); ?></th>
			                <th style="width: 60px">Data</th>
			            </tr>
			        </thead>
					<tbody>
				<?php foreach ($galerias as $galeria): ?>
					<tr>
						<td><?php echo $this->Html->image('fotos/thumb.' . $galeria['Galeria']['capa'], array('class' => 'img-responsive')); ?></td>
						<td>
							<?php echo $galeria['Galeria']['title'] ?>
						</td>
						<td>
							<div class="pull-right action-buttons">
								<a href="<?php echo $this->Html->url(array('controller' => 'galerias', 'action' => 'edit', $galeria['Galeria']['id'])); ?>" class="pencil"><span class="glyphicon glyphicon-pencil"></span></a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
			echo $this->Paginator->numbers(
				array(
					'before' => '<ul class="pagination">',
					'first' => 2,
					'last' => 2,
					'separator' => '',
					'currentTag' => 'a',
					'currentClass' => 'active',
					'tag' => 'li',
					'after' => '</div>'
				)
			);
		?>
	</div>
</section>