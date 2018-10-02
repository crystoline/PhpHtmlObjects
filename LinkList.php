<?php
namespace com\crysto\html;
/**
 * HTML Unorder list
 * @author crysto
 * @namespace com\crysto\html
 */
class LinkList extends UList{
	

	/**
	 * Add linked list items to the next index;
	 * (non-PHPdoc)
	 * @see \com\crysto\html\Html::add()
	 */
	final function addLink ($href, $content, $title=''){

			$link = new Anchor($href, $content, $title);
				array_push($this->contents, HtmlBox::create('li', array(), $link));
		return $this;
	}
	
	/**
	 * add more content to list to a given index
	 * @param unknown $index
	 * @param unknown $content
	 * @return \com\crysto\html\LinkList
	 */
	final function addLinkContent($index,$content){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents))return $this;
		$this->contents[$index]->contents[0]->add($content);
		return $this;
	}
	
	

	final function linklistAttr($index,$array = array()){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents)) return $this;
		$this->contents[$index]->contents[0]->attr($array);
		return $this;
	}
	
	final function linklistStyle($index,$array = array()){
		if (!is_int($index)) return $this;
		if ($index >= count($this->contents)) return $this;
		$this->contents[$index]->contents[0]->style($array);
		return $this;
	}

}
