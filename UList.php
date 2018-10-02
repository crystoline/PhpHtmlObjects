<?php
namespace com\crysto\html;


/**
 * HTML Unorder list
 * @author crysto
 * @namespace com\crysto\html
 */
class UList extends Html{
	/**
	 * @param string $type
	 */
	function __construct($type='disc'){
		parent::__construct('ul');
		$this->attr(array('type'=>$type));
	}
	/**
	 * (non-PHPdoc)
	 * @see \com\crysto\html\Html::add()
	 */
	final function add ($content){

		if (is_array($content))
			foreach($content as $value)
			array_push($this->contents, HtmlBox::create('li',array(),$value));
		else
			array_push($this->contents, HtmlBox::create('li',array(),$content));
		return $this;
	}
	//to add more
	/**
	 * add more content to list
	 * @param int $index
	 * @param string|array $content
	 * @return \com\crysto\html\UList
	 */
	final function listAddContent($index,$content){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents))return $this;
		$this->contents[$index]->add($content);
		return $this;
	}
	/**
	 * @deprecated
	 * add more content to list
	 * @param int $index
	 * @param string|array $content
	 * @return \com\crysto\html\UList
	 */
	final function listItemAddContent($index,$content){
		return $this->listAddContent($index, $content);
	}
	/**
	 *
	 * @param int $index
	 * @param string|array $array
	 * @return \com\crysto\html\UList
	 */
	final function listStyle($index,$array=array()){

		if (!is_int($index)) return $this;
		if ($index >= count($this->contents)) return $this;
		$this->contents[$index]->style($array);
		return $this;
	}
	/**
	 *@deprecated
	 * @param int $index
	 * @param string|array $array
	 * @return \com\crysto\html\UList
	 */
	final function listItemStyle($index,$array=array()){

		return $this->listStyle($index,$array);
	}
	/**
	 *
	 * @param int $index
	 * @param array $array
	 * @return \com\crysto\html\UList
	 */
	final function listAttr($index,$array = array()){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents)) return $this;
		$this->contents[$index]->attr($array);
		return $this;
	}
	/**
	 *@deprecated
	 * @param int $index
	 * @param array $array
	 * @return \com\crysto\html\UList
	 */
	final function listItemAttr($index,$array = array()){

		return $this->listAttr($index,$array);
	}
	/**
	 *
	 * @param int $index
	 * @return \com\crysto\html\UList
	 */
	final function space($index){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents)) return $this;
		$this->contents[$index]->space();
		return $this;
	}
}
