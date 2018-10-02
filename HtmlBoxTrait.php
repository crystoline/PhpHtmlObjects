<?php
namespace com\crysto\html;

Trait HtmlBoxTrait{
	/**
	 *
	 * @param string $tag
	 * @param string|array $attrs
	 * @param string|array $contents
	 * @param boolean $close
	 * @return \com\crysto\html\Html
	 *
	 */
	static function create ($tag, $attrs = array(), $contents = array(),$close = true){
		$html = new Html($tag, $close);
		$html->addAttr($attrs);
		$html->addContent($contents);

		return $html;
	}
}