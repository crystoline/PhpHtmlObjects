<?php
namespace com\crysto\html;
/**
 * @desc create HTML Image Object
 * @author crysto
 *
 */
final class Img extends \com\crysto\html\Html{
	/**
	 *
	 * @param string $src
	 * @param array $array
	 */
	function __construct($src,$array=array()){
		parent::__construct('img', false);
		$this->attr(array('src' => $src));
		if ($array)$this->attr($array);
	}
	/**
	 * @deprecated
	 * @param string $value
	 * @return \com\crysto\html\Img
	 */
	final function setHeight($value){
		return $this->height($value);
	}

	/**
	 * @param string $value
	 * @return \com\crysto\html\Img
	 */
	final function height($value){
		$this->attr(array('height' => $value));
		return $this;
	}
	/**
	 * @deprecated
	 * @param string $value
	 * @return \com\crysto\html\Img
	 */
	final function setWidth($value){
		return $this->width($value);
	}
	/**
	 * @param string $value
	 * @return \com\crysto\html\Img
	 */
	final function width($value){
		$this->attr(array('width' => $value));
		return $this;
	}
}