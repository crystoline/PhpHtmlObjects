<?php
namespace com\crysto\html;

/**
 * @desc HTML Line Break Object
 * @author crysto
 *
 */
final class Hr extends \com\crysto\html\Html{
	
	function __construct(){
		parent::__construct('br', false);
	}
}