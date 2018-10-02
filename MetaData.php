<?php
namespace com\crysto\html;
/**
 * HTML Metadata
 * @author crysto
 *
 */
class MetaData extends \com\crysto\html\Html{
	/**
	 *
	 * @param array $attr contain attributes
	 */
	function __construct($attr){
		parent::__construct('meta', false);
		$this->add($attr);
	}
}