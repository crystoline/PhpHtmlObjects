<?php
namespace com\crysto\html;

/**
 * @desc Create html header element
 * @author crysto
 *
 */
class Header extends HtmlBox{
	/**
	 *
	 * @param int $i
	 * @param string|array $content
	 * @param array $attr
	 *
	 */
	function __construct($i,$content,$attr = array()){
		if (!$i && !$content) return;
		if (!$i || !is_int($i)) $i = 0;
		parent::__construct('h'.$i,true);
		$this->add($content);
		$this->attr($attr);
	}
}