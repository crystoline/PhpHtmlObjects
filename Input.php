<?php
namespace com\crysto\html;

/**
 * HTML Input object
 * @author crysto
 *
 */

class Input extends \com\crysto\html\Html{
	/**
	 *
	 * @param string $type
	 * @param string $name
	 * @param string $value
	 */
	function __construct($type='text',$name=NULL, $value=NULL){
		parent::__construct('input', false);
		$this->attr(array('type'=>$type));
		if ($name)$this->attr(array('name'=>$name));
		if ($value)$this->value($value);

	}
	/**
	 * @deprecated
	 * set the value attribute of input object
	 * @param string $value
	 * @return \com\crysto\html\Input
	 */
	function setValue($value){
		return $this->value($value);
	}
	/**
	 * @desc set the value attribute of input object
	 * @param string $value
	 * @return \com\crysto\html\Input
	 */
	function value($value){
		if ($value)$this->attr(array('value'=>$value));
		return $this;
	}
}