<?php

namespace com\crysto\html;

class DataList extends HtmlBox{
	
	function __construct($id='') {
		parent::__construct('datalist',array('id'=>$id));
		
	}
	
	function addOption($label,$value){
		$option = new Html('option');
		$option->attr(array('label'=> $label, 'value'=>$value));
		$this->add($option);
	}
	
}

/*
  <input type="url" list="url_list" name="link" />
<datalist id="url_list">
<option label="W3Schools" value="http://www.w3schools.com" />
<option label="Google" value="http://www.google.com" />
<option label="Microsoft" value="http://www.microsoft.com" />
</datalist>*/