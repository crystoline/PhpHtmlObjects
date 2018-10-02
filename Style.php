<?php
namespace com\crysto\html;
class  Style{
	private $styles;

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
	final private function string2style($str){
		$list = explode(';',$str);
		if (is_array($list)){
			foreach($list as $value){
				$s = explode(':', $value);
				if($value)
					$this->addStyle(array( $s[0] => $s[1]));
			}
		}else
			$s = explode(':', $list);
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
	public function __call($name, $arguments)
	{
		// Note: value of $name is case sensitive.
		echo "Calling object method '$name' "
		. implode(', ', $arguments). "\n";
	}

	/**  As of PHP 5.3.0  */
	public static function __callStatic($name, $arguments)
	{
		// Note: value of $name is case sensitive.
		echo "Calling static method '$name' "
		. implode(', ', $arguments). "\n";
	}

}