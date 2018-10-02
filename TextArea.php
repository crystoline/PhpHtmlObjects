<?php
namespace com\crysto\html;
/**
 * HTML Textarea
 * @author crysto
 *
 */
class TextArea extends HtmlBox{
	/**
	 *
	 * @param string $name
	 * @param string $content
	 */
	function __construct($name, $content=NULL){
		parent::__construct('textarea');

		$this->attr(array('name'=>$name));
		if ($content)$this->add($content);
	}
}