<?php
namespace com\crysto\html;

/**
 * Div container class
 * @author crysto
 *
 */
class Div extends HtmlBox{

    /**
     *
     * @param string $content Content of Div. Can be text or html or html object
     * @param array $attr Initial div attributes
     * @param array $style Initial div styles
     */
	function __construct($content = '',$attr= array(),$style=array()){
		
		parent::__construct('div',$attr);
		$this->addContent($content);
		$this->style($style);
	}
}