<?php
/**
	CakePHP Feedback Plugin

	Copyright (C) 2012-3827 dr. Hannibal Lecter / lecterror
	<http://lecterror.com/>

	Multi-licensed under:
		MPL <http://www.mozilla.org/MPL/MPL-1.1.html>
		LGPL <http://www.gnu.org/licenses/lgpl.html>
		GPL <http://www.gnu.org/licenses/gpl.html>
*/

App::uses('FeedbackAppModel', 'Feedback.Model');

/**
 * Comment Model
 *
 * @property Foreign $Foreign
 * @property User $User
 */
class Post extends FeedbackAppModel
{
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array
		(
			'foreign_model' => array
			(
				'notempty' => array
				(
					'rule' => array('notempty'),
					'allowEmpty' => false,
					'required' => true,
				),
			),
			'foreign_id' => array
			(
				'notempty' => array
				(
					'rule' => array('notempty'),
					'allowEmpty' => false,
					'required' => true,
				),
			),
			'name' => array
			(
				'notempty' => array
				(
					'rule' => array('notempty'),
					'message' => 'Name cannot be empty',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'email' => array
			(
				'notempty' => array
				(
					'rule' => array('notempty'),
					'message' => 'E-mail address cannot be empty',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'email' => array
				(
					'rule' => array('email'),
					'message' => 'E-mail address is not valid',
				)
			),
			
			'reply' => array
			(
				'notempty' => array
				(
					'rule' => array('notempty'),
					'message' => 'Comment cannot be empty',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array
		(
			'User' => array
			(
				'className' => 'User',
				'foreignKey' => 'user_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);

	public $actsAs = array
		(
			'Feedback.Polymorphic' => array
			(
				'modelField'	=> 'foreign_model',
				'foreignKey'	=> 'foreign_id'
			),
			'Feedback.Honeypot' => array
			(
				'field' => 'hairy_pot',
				'message' => 'E-mail address is not valid',
				'errorField' => 'author_email',
			),
		);

	public $order = 'Post.created asc';
}
