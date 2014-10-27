<?php
App::uses('AppModel', 'Model');
/**
 * Foto Model
 *
 * @property Galeria $Galeria
 */
class Foto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed


	public $validate = array(
		'galeria_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'notEmpty' => array(
				'rule' => 'requiredFile',
				'message' => 'Arquivo obrigatório.',
				'on' => 'create'
			),
			'validUpload' => array (
				'rule' => array('validateUploadedFile'),
				'message' => 'Arquivo inválido.'
			),
			'validExtension' => array (
				'rule' => array('validateFileExtension', array('jpg', 'jpeg', 'png', 'gif')),
				'message' => 'Somente extensões: jpg, png ou gif.'
			),
			'maxFileSize' => array(
				'rule' => array('maxFileSize', 2097152),
				'message' => 'Tamanho máximo de 2MB.'
			)
		)
	);

	public $actsAs = array(
	  'CakeAttachment.Upload' => array(
		'image' => array(
			'uniqidAsFilenames' => true,
		  	'dir' => "{IMAGES}fotos/",
				'thumbsizes' => array(
					'thumb' => array('width' => 500, 'height' => 500, 'name' =>  'thumb.{$file}.{$ext}', 'proportional' => false),
				)
			)
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Galeria' => array(
			'className' => 'Galeria',
			'foreignKey' => 'galeria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function afterFind($results, $primary = false) {
		foreach ($results as $key => &$value) {
			if (isset($value['Foto']['image'])) {
				$value['Foto']['thumb_uri'] = $this->base . '/img/fotos/thumb.' . $value['Foto']['image'];
			}
		}
		return $results;
	}
}
