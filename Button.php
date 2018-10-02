<?php
namespace com\crysto\html;

/**
 * HTML Button Class
 * @author crysto
 *
 */
class Button extends \com\crysto\html\Html{
    /**
     *
     * @param string $type <i>type of button (button,submit)</i>
     * @param string $text <i>Text content</i>
     * @param string $name <i>Name Attribute</i>
     * @param array $attr <i>Associative Arrays of other Attributes</i>
     */
	function __construct($type='button', $text='',$name='', $attr=array()){
		parent::__construct('button');
		$this->addAttr(array('type'=>$type));
		if ($text)$this->add($text);
		if ($name)$this->attr(array('name'=>$name));
		if ($attr)$this->attr($attr);

	}
}