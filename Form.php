<?php
namespace com\crysto\html;

/**
 * @desc Create a form element
 * @author crysto
 */
class Form extends HtmlBox{
	/**
	 *
	 * @param string $method Form submittion method. e.g get, post, delete or put
	 * @param string $action Form action page e.g update.php
	 * @param string $enctype
	 */
	function __construct($method, $action='',
			$enctype='application/x-www-form-urlencoded'){
		parent::__construct('form');
		$this->attr(array('method'=>$method,'action'=>$action,'enctype'=>$enctype));
	}
}


