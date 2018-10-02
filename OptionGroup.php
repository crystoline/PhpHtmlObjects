<?php
namespace com\crysto\html;
/**
 * HTML Optiongroup object
 * @author crysto
 *
 */
class OptionGroup extends HtmlBox{
	/**
	 *
	 * @param string $label
	 */
	function __construct($label){
		parent::__construct('optgroup');
		$this->attr(array('label'=>$label));
	}
	/**
	 *
	 * @param string $value
	 * @return \com\crysto\html\OptionGroup
	 */
	function selected($value){
		foreach ($this->contents as $c ){
			if ($c instanceof Option and @$c->attrs['value'] == $value){
				$c->selected();
				return $this;
			}
		}
		return $this;
	}
	/**
	 *
	 * @param string $text
	 * @param string $value
	 * @return \com\crysto\html\OptionGroup
	 */
	function addOption($text,$value=null){
		$this->add(new Option($text,$value));
		return $this;
	}
}