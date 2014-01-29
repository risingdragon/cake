<?php
class Post extends AppModel {
	public $useDbConfig = 'mongo';

	public $validate = array(
		'email' => array(
			array(
				'rule' => 'notempty',
				'message' => '入力してください'
			),
			array(
				'rule' => 'email',
				'message' => 'メールアドレス形式で入力してください'
			)
		),
		'send_date' => array(
			array(
				'rule' => 'notempty',
				'message' => '入力してください'
			),
			array(
				'rule' => array('date', 'ymd'),
				'message' => 'YYY-MM-DD形式で入力してください'
			)
		),
		'send_time' => array(
			array(
				'rule' => 'notempty',
				'message' => '入力してください'
			),
			array(
				'rule' => array('custom', '/^[0-2][0-3][0-5][0-9]$/'),
				'message' => 'HHMM形式(24時間表記)で入力してください'
			)
		),
		'title' => array(
			array(
				'rule' => 'notempty',
				'message' => '入力してください'
			)
		),
		'body' => array(
			array(
				'rule' => array('minLength', '5'),
				'message' => '5文字以上で入力してください'
			)
		)
	);

	public function findOne($email = null)
	{
		$conditions = array();

		if (strlen($email)) {
			$conditions['email'] = $email;
		}

		return $this->find('first', array(
			'conditions' => $conditions,
			'order' => array('modified' => 'DESC')
		));
	}
}
