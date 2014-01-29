<?php
App::uses('ComponentCollection', 'Controller');
App::uses('EmailComponent', 'Controller/Component');

class PostShell extends AppShell {

	public $uses = array('Post');
	public $components = array('Email');

	public function startup() {
	}

	public function main() {
		$this->out('Hello cake.');
		$post = $this->Post->findOne(@$this->args[0]);
		print_r($post);
		$email = new EmailComponent(new ComponentCollection());
		$email->send($post['Post']);
	}
}
