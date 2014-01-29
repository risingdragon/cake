<?php
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component {
	public function send($post) {
		$email = new CakeEmail('default');
		$email->template('default', 'default');
		$email->to($post['email']);
		$email->subject($post['title']);
		$email->viewVars($post);
		$email->send($post['body']);
	}
}
