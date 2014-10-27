<?php
App::uses('AppController', 'Controller');
/**
 * Fotos Controller
 *
 * @property Foto $Foto
 * @property PaginatorComponent $Paginator
 */
class FotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Foto->recursive = 0;
		$this->set('fotos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Foto->exists($id)) {
			throw new NotFoundException(__('Invalid foto'));
		}
		$options = array('conditions' => array('Foto.' . $this->Foto->primaryKey => $id));
		$this->set('foto', $this->Foto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Foto->create();
			if ($this->Foto->save($this->request->data)) {

				$this->set('foto', $this->Foto->read(null, $this->Foto->getLastInsertID()));
				$this->set('_serialize', array('foto'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Foto->exists($id)) {
			throw new NotFoundException('Foto inválida.');
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Foto->save($this->request->data)) {
				$this->set('foto', $this->Foto->read(null, $id));
				$this->set('_serialize', array('foto'));
			}
		} else {
			$options = array('conditions' => array('Foto.' . $this->Foto->primaryKey => $id));
			$this->request->data = $this->Foto->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->layout = 'ajax';
		$this->autoRender = false;
		if (!empty($this->request->params['named']['id']) && is_array($this->request->params['named']['id']) && count($this->request->params['named']['id']) > 1) {
			foreach ($this->request->params['named']['id'] as $key => $value) {
				$conditions['Foto.id'][] = $value;
			}
			if ($this->Foto->deleteAll($conditions)) {
	        	echo json_encode(array('status' => true));
	        } else {
	        	echo json_encode(array('status' => false));
	        }
		} else if (!empty($this->request->params['named']['id']) && is_string($this->request->params['named']['id'])) {
			if ($this->Foto->delete($this->request->params['named']['id'])) {
	        	echo json_encode(array('status' => true));
	        } else {
	        	echo json_encode(array('status' => false));
	        }
		} else {
			if ($this->Foto->delete($id)) {
	        	echo json_encode(array('status' => true));
	        } else {
	        	echo json_encode(array('status' => false));
	        }
		}
	}
}
