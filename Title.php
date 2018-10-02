<?php
namespace com\crysto\html;
/**
 * HTML Title
 * @author crysto
 *
 */
class Title extends HtmlBox{
	/**
	 *
	 * @param string $title
	 */
	function __construct($title= null){
		parent::__construct('title');
		if ($title)$this->add($title);
	}
	/**
	 *
	 * @param string $title
	 * @return \com\crysto\html\Title
	 */
	function setTitle($title){
		if ($title)$this->add($title);
		return $this;
	}
}