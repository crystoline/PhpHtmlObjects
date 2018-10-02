<?php
namespace com\crysto\html;

/**
 * HTML label Object
 * @author crysto
 *
 */
class Label extends HtmlBox{
	/**
	 *
	 * @param string $text
	 * @param string $for
	 */
	function __construct($text, $for = NULL){
		parent::__construct('label');
		$this->add($text);
		if ($for)$this->attr(array('for'=>$for));
	}
}