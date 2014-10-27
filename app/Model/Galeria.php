<?php
App::uses('AppModel', 'Model');
/**
 * Galeria Model
 *
 * @property Foto $Foto
 */
class Galeria extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'galeria_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Foto.id DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
