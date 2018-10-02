<?php 
namespace com\crysto\html;
//use com\crysto\html\HtmlBox;

/**
 * <ul>
 * 	<li>This package contain all Html child class.</li>
 * 	<li>can be use to generate any html content from php.</li>
 * </ul>
 * @Author <b>Adekoya A.A ,</b> a.k.a:<font color='blue'> Crystoline</font>
 * @Desc Generate HTML <b>Objects in PHP</b>
 * @version 1.1.11
 * @package com\crysto
 * @tutorial  <a href="http://www.crysto.org/mod/html/tutorial">Online Tutorial</a>
 * @example <p>$img = new Html('img',false);<br>
 * $img->attr(array('href' => 'http://myimage.com/pic.jpg'));      <br>
 * print $img</p>
 * 
 */
class Html{

	/*use trait_name1, trait_name2 {
			trait_name1::function_name1 insteadof trait_name2;
			trait_name1::function_name2 as static function_name3;
			trait_name1::function_name4 as function_name5;
		}
		*/
	use HtmlTrait;
	protected $tag, $attrs, $contents, $styles;
	protected $fullAttr, $fullContent, $close , $parsed;
    protected $style;

    /**
	 *
	 * @param string $tag
	 * @param boolean $close
	 */
	public function __construct ($tag, $close = true){
		if ($tag and  !is_int($tag)) {
            $this->tag = strtolower($tag);
            $this->close = (bool) $close;
            $this->attrs = array();
            $this->style = array();
            $this->contents = array();
            $this->parsed = false;
        }
	}

	
	/**
	 * print html output
	 */
	function __invoke() {
		echo $this->parse();
	}

    /**
     * @param $t
     * @return self $this
     */
	public function proto($t) {
		if ($t === $this) {
		    return  $this;
        }
		//else return $self;
	}

    /**
     * @deprecated
     * @param array $array
     * @return Html
     */
	final function addAttr ($array){

		return $this->attr($array);
	}
	/**
	 * @desc <b style='font-size:11px;color:blue'>
	 * Assign attributes to html object</b>
	 * @param array $array
	 * @return \com\crysto\html\Html
	 * @example $html->attr(array('class'=>'myclass'));
	 */
	final function attr($array){
		if (is_array($array))
			foreach($array as $name=>$value){
			$name = strtolower($name);
			$this->attrs[$name] = $value;
		}
		return $this;
	}

    /**
     * @deprecated
     * @param array|string $array
     * @return Html
     */
	final function addStyle($array){

		return $this->style($array);
	}

    /**
     * @desc <b style='font-size:11px;color:blue'>
     * set style for html object</b>
     * @param array|string $array
     * @return Html
     */
	final function style($array){
		if (is_array($array))
			foreach($array as $name=>$value){
			$name = strtolower($name);
			$this->styles[$name] = $value;
		}elseif (is_string($array)){
			$this->string2style($array);
		}
		return $this;
	}

    /**
     * @deprecated
     * @param string|array $content
     * @return Html
     */
	public function addContent ($content){
		return $this->add($content);
	}

    /**
     *
     * @param string|array $content
     * @return Html
     */
	public function add($content){
		if (!$this->close) return $this;
		if (is_array($content))
			foreach($content as $value)
			array_push($this->contents, $value);
		else
			array_push($this->contents, $content);
		return $this;
	}
	/**
	 * return the content of this html as string
	 */
	public function contentToString(){
		if (!$this->close) return '';
			//$tmp = new Html('');
			//var_dump($this->contents)
			//$tmp->add();
			return implode('', $this->contents);
	}
	/**
	 * clear content
	 * @return \com\crysto\html\Html
	 */
	final function clear(){
		$this->contents = array();
		return $this;
	}
	/**
	 * reset object. clears all content, style ans attrs
	 * @return \com\crysto\html\Html
	 */
	final function reset(){
		$this->attrs = array();
		$this->style = array();
		$this->clear();
		return $this;
	}
	/**
	 * return to object as string (html tags)
	 * @return string
	 */
	function __tostring(){
		return $this->parse();
//		 $str = $this->parse();
//		if(is_string($str))
//			return $str;
//		else return '';
	}
	/**
	 *Parse object as string (html tags)
	 * @return string
	 */
	function parse(){
			
		$this->parseAttr();

		$out = "<".$this->tag.$this->fullAttr;
		if ($this->close){
			$out .= ">";
			$this->parseContent();
			$this->fullContent = $out.$this->fullContent."</{$this->tag}>";
		}
		else $this->fullContent = $out.' />'."";

		return $this->fullContent;

	}
	/**
	 * add style from string
	 * @param string $str
	 * @example <font color='green'>$html->string2style('color:red;height:200px')</font>;
	 */
	final private function string2style($str){
		$list = explode(';',$str);
		if (is_array($list)){
			foreach($list as $value){
				$s = explode(':', $value);
				if($value)
					$this->addStyle(array( $s[0] => $s[1]));
			}
		}else{
		    $s = explode(':', $str);
            $this->addStyle([$s[0] => $s[1]]);
        }
	}
	/**
	 * create the string representation of styles
	 * @return string
	 */
	final private function parseStyle(){
		$style ='';
		if(is_array($this->styles))
			foreach(@$this->styles as $name => $value)
			$style .=  $name.': '.$value.'; ';
		return $style;
	}
	/**
	 * create the string representation of attrs
	 * @return string
	 */
	final private function parseAttr(){
		$attr = $this->attrs;
		foreach($attr as $name => $value){
			if ($name ==  'style')
				$this->string2style($value);
			else
				$this->fullAttr .=  ' '.$name.'="'.$value.'"';
		}
		if ($this->styles)
			$this->fullAttr .= ' style="'.$this->parseStyle().'"';
	}
	/**
	 * create the string|html representation of content
	 */
	final private function parseContent(){
		 $this->fullContent = '';
		for($i = 0; $i < count($this->contents); $i++){
			$this->fullContent .= $this->contents[$i];
		} 
		return ;
//		 $this->fullContent = '';
//		for($i = 0; $i < count($this->contents); $i++){
//			if($this->contents[$i] instanceof Html)
//				$this->fullContent .= $this->contents[$i]->parse();
//			else
//				$this->fullContent .= $this->contents[$i];
//		}
	}
}


