<?php
namespace com\crysto\html;
/**
 * HTML Option Object
 * @author crysto
 *
 */
class Option extends HtmlBox{
	/**
	 *
	 * @param unknown $text
	 * @param string $value
	 */
	function __construct($text, $value=NULL){
		parent::__construct('option');
		$this->add(ucfirst($text));
		if (!is_null($value)) $this->attr(array('value'=>$value));
		else $this->attr(array('value'=>$text));
	}

	/**
	 *
	 * @return \com\crysto\html\Option
	 */
	function selected(){

		$this->attr(array('selected'=>'selected'));
		return $this;
	}
}