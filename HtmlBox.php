<?php
namespace com\crysto\html;
/**
 * @desc Create HTML element with closing tag
 * @author crysto
 *
 */
class HtmlBox extends \com\crysto\html\Html{
	/**
	 *
	 * @param string $tag
	 * @param array $attrs
	 */
	use HtmlTrait;
	
	function  __construct($tag,$attrs=array()){
		$close = true;
		parent::__construct($tag, $close );
		if($attrs) $this->attr($attrs);
	}
	
	
	/**
	 * Insert HTML line break
	 * @param integer $i
	 * @return \com\crysto\html\HtmlBox
	 */
	final function br($i=1){
		$i = (int) $i;
		if (!$i) $i = 1;
		for ($n=0; $n<$i;$n++)
			$this->add(new \com\crysto\html\Html('br', false));
		return $this;
	}

	/**
	 * Insert html non-breaking space
	 * @return \com\crysto\html\HtmlBox
	 */
	function space(){
		$this->add('&nbsp;');
		return $this;
	}

	/**
	 *
	 * @param int $i
	 * @param string|array $content
	 * @return \com\crysto\html\HtmlBox
	 */

	function changeContent($i, $content){
		if ($i < count($this->contents))
			return $this;
		$this->contents[$i] = $content;
		return $this;
	}
}