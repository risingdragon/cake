<?php
App::uses('AppController', 'Controller');

class PostController extends AppController {
	public $layout = 'default';
	public $components = array('Paginator', 'Email');

	public function index() {
		$this->Paginator->settings = array(
			'limit' => 5,
			'order' => array(
				'Post.created' => 'DESC'
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

	public static function _time($data)
	{
		return new MongoDate(strtotime(
			$data['send_date'] . ' ' .
			substr($data['send_time'], 0, 2) . ':' .
			substr($data['send_time'], 2, 2)
		));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Post']['reserv_time'] = self::_time(
				$this->request->data['Post']
			);
			if ($this->Post->save($this->request->data)) {
				$this->Email->send($this->request->data['Post']);
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
			$this->request->data['Post']['reserv_time'] = self::_time(
				$this->request->data['Post']
			);
			if ($this->Post->save($this->request->data)) {
				$this->Email->send($this->request->data['Post']);
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
