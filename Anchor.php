<?php
namespace com\crysto\html;

/**
 * @desc Html link class
 * @link string href
 * @content string text
 * @title string title
 */
final class Anchor extends HtmlBox{
	/**
	 * @param string $link
	 * @param string|array $content
	 * @param string $title
	 */
	function __construct($link,$content='',$title =''){
		parent::__construct('a');
		if ($link)$this->attr(array('href' => $link));
		if ($title)$this->attr(array('title' => $title));
		if ($content)$this->add($content);

	}

	/**
	 * <b>Set URL of an anchor</b>
	 * @param string $link
	 */
	final function setLink($link){
		$this->attr(array('href' => $link));
		return $this;
	}
	/**
	 * @deprecated
	 * @param unknown $content
	 */
	final function setContent($content){
		$this->add($content);
		return $this;
	}
	/**
	 * <b>Set Title</b>
	 * @param string $title
	 * @return \com\crysto\html\Anchor
	 */
	final function setTitle($title){
		$this->attr(array('title' => $title));
		return $this;
	}

}