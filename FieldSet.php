<?php
namespace com\crysto\html;


class FieldSet extends HtmlBox{
	
	/**
	 * 
	 * @param string $legend
	 */
	function __construct($legend='') {
		parent::__construct('fieldset');
		if ($legend){
			$l = new HtmlBox('legend');
			$l->add($legend);
			$this->add($l);
		}
	}
}