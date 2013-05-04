<?php
App::uses('AppModel', 'Model');
/**
 * Author Model
 *
 */
class Author extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'author';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

}
