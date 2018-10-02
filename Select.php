<?php
namespace com\crysto\html;
/**
 * HTML Select object
 * @author crysto
 *
 */
class Select extends HtmlBox{
	/**
	 *
	 * @param string $name
	 */
	function __construct($name){
		parent::__construct('select');
		$this->attr(array('name'=>$name));
	}
	/**
	 * add option
	 * @param string $text
	 * @param string $value
	 * @return \com\crysto\html\Select
	 */
	function addOption($text,$value=null){
		$this->add(new Option($text,$value));
		return $this;
	}
	/**
	 * add options
	 * @param array $array
	 * @return \com\crysto\html\Select
	 */
	function addOptions($array){
		foreach ($array as $text => $value)
			$this->add(new Option($text,$value));
		return $this;
	}
	/**
	 * defined selected option
	 * @param string $value
	 * @return \com\crysto\html\Select
	 */
	function selected($value){
		foreach ($this->contents as $c){

			if ($c instanceof Option and @$c->attrs['value'] == $value){
				$c->selected();
				return $this;
			}
			elseif ($c instanceof OptionGroup){ //and @$cc->attrs['value'] == $value){

				if ($c->selected($value)) return $this;

			}
		}
		return $this;
	}
}