<?php
App::uses('AppController', 'Controller');
/**
 * Galerias Controller
 *
 * @property Galeria $Galeria
 * @property PaginatorComponent $Paginator
 */
class GaleriasController extends AppController {

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
		$this->Galeria->recursive = 0;
		$this->set('galerias', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Galeria->exists($id)) {
			throw new NotFoundException(__('Invalid galeria'));
		}
		$options = array('conditions' => array('Galeria.' . $this->Galeria->primaryKey => $id));
		$this->set('galeria', $this->Galeria->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Galeria->create();
			if ($this->Galeria->save($this->request->data)) {
				$this->Session->setFlash('Galeria criada com sucesso. Insira suas fotos.');
				return $this->redirect(array('action' => 'edit', $this->Galeria->id));
			} else {
				$this->Session->setFlash('Erro ao criar galeria. Verifique os erros e tente novamente.');
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
		if (!$this->Galeria->exists($id)) {
			throw new NotFoundException(__('Invalid galeria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Galeria->save($this->request->data)) {
				$this->Session->setFlash(__('The galeria has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The galeria could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Galeria.' . $this->Galeria->primaryKey => $id));
			$this->request->data = $this->Galeria->find('first', $options);
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
		$this->Galeria->id = $id;
		if (!$this->Galeria->exists()) {
			throw new NotFoundException(__('Invalid galeria'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Galeria->delete()) {
			$this->Session->setFlash(__('The galeria has been deleted.'));
		} else {
			$this->Session->setFlash(__('The galeria could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
