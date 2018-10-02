<?php
namespace com\crysto\html;
/**
 * HTML Ordered list object
 * @author crysto
 *
 */
final class OList extends UList{
	/**
	 *
	 * @param string $type
	 */
	function __construct($type='1'){
		parent::__construct($type);
		$this->tag = 'ol';
	}
}
