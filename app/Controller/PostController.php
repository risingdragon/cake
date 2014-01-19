<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class PostController extends AppController {
	public $layout = 'post';
	public $components = array('Paginator');

	private function _send($post) {
		$email = new CakeEmail('default');
		$email->template('post', 'post');
		$email->to($post['email']);
		$email->subject($post['title']);
		$email->viewVars($post);
		$email->send($post['body']);
	}

	public function index() {
		$this->Paginator->settings = array(
			'limit' => 5,
			'order' => array(
				'Post.created' => 'asc'
			)
		);
		$this->set(['posts' => $this->Paginator->paginate('Post')]);
	}

	public function view($id) {
		if (!$id) {
			throw new NotFoundException(__('不正なパラメータ'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('不正なパラメータ'));
		}
		$this->set('post', $post);
	}

	public function add() {
		if ($this->request->is('post')) {
			if ($this->Post->save($this->request->data)) {
				$this->_send($this->request->data['Post']);
				$this->Session->setFlash(__('追加保存しました'), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('エラーがあります'), 'error');
			}
		}
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('不正なパラメータ'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('不正なパラメータ'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Post->id = $id;
			if ($this->Post->save($this->request->data)) {
				$this->_send($this->request->data['Post']);
				$this->Session->setFlash(__('更新しました'), 'success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('更新に失敗しました'), 'error');
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}

		$this->render('form');
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('ID: %s を削除しました', h($id)), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
