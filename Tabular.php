<?php
namespace com\crysto\html;
/**
 * HTML Table object
 * @author crysto
 *
 */
class Tabular extends Htmlbox{
	var $row,$col, $rowspan, $colspan;
	private $markspan;

    /**
     *
     * @param int $row
     * @param int $col
     * @param string $tag
     */
	function __construct($row, $col, $tag = 'table'){
		parent::__construct($tag);
		//$this->row= (int) $row ;
		$this->col = (int) $col ;


		$this->addRows((int) $row) ;
		$this->markspan = array();
	}
	/**
	 * Add single row to table
	 * @return \com\crysto\html\Table
	 */
	private function newRow(){
		$r = new HtmlBox('tr');
		for($i=0;$i<$this->col;$i++)
			$r->add(new HtmlBox('td')) ;
		$this->row++;
		$this->add($r);
		return $this;
	}
	/**
	 * Add new rows to table
	 * @param int $n
	 * @return \com\crysto\html\Table
	 */
	function addRows($n){
		$n = (int) $n;
		if ($n == 0) return $this;
		for($k=0;$k<$n;$k++)
			$this->newRow ();
		return $this;
	}
	/**
	 *
	 * @param int $n
	 * @return \com\crysto\html\Table
	 */
	function addCols($n, $tag = 'td'){
		$n = (int) $n;
		if ($n == 0) return $this;
		$this->col += $n;
		$row = $this->row;
		for($i=0;$i<$row;$i++)
			for($k=0;$k<$n;$k++)
			$this->contents[$i]->add(new HtmlBox($tag));
		return $this;

	}
	/**
	 * Define cell's row span
	 * @param int $i row index
	 * @param int $j col index
	 * @param int $value
	 * @return \com\crysto\html\Table
	 */
	final function rowSpan($i, $j, $value){
		if (!$value = (int)$value)
			return $this;
		if (!$this->checkRow($i,$j) and $this->contents[$i]->contents[$j] !== '')
			$this->contents[$i]->contents[$j]->attr(array('rowspan'=>$value));
		return $this;
	}
	/**
	 * Define cell's col span
	 * @param int $i row index
	 * @param int $j col index
	 * @param int $value
	 * @return \com\crysto\html\Table
	 */
	final function colSpan($i, $j, $value){
		$value = (int)$value;
		if ($value <2) return $this;
		if (!$this->checkCol($i,$j) and @$this->contents[$i]->contents[$j])
			$this->contents[$i]->contents[$j]->attr(array('colspan'=>$value));
		return $this;
	}
	/**
	 * Check row for any span
	 * @param int $i
	 * @param int $j
	 * @return number
	 */
	final private function checkRow($i,$j){
		for($k=0;$k<$i; $k++)
			if (isset($this->contents[$k]->contents[$j]->attrs['rowspan']) and 
					(int)$this->contents[$k]->contents[$j]->attrs['rowspan'] + $k > $i)
			return $k+1;
		return 0;
	}
	/**
	 * Check col for any span
	 * @param int $i
	 * @param int $j
	 * @return number
	 */
	final private function checkCol($i,$j){
		for($k=0;$k<$j; $k++)
			if (isset($this->contents[$i]->contents[$k]->attrs['colspan']) and 
					(int)$this->contents[$i]->contents[$k]->attrs['colspan'] + $k > $j)
			return $k+1;
		return 0;
	}

	/**
	 * remove unwanted cells after colspan
	 * @param int $i
	 * @param int $j
	 */
	final private function sanitzeCol($i,$j){
		if(@$k = $this->checkCol($i,$j)and @!$this->markspan[$i][$j] ){
			@$move = $this->contents[$i]->contents[$j]->contents;
			$k =$k - 1;

			if (is_array($move))
				foreach($move as $v)
				$this->cellContent($i,$k,$v);

			$this->markspan[$i][$j] = true;
			$this->contents[$i]->contents[$j] = '';


		}else{
			$this->markspan[$i][$j] = false;
		}

	}
	/**
	 * remove unwanted cells after rowspan
	 * @param int $i
	 * @param int $j
	 */
	final private function sanitzeRow($i,$j){
		if(@$k = $this->checkRow($i,$j) and @!$this->markspan[$i][$j]){

			$k =$k- 1;

			//check colspan at rowpan
			$span = (int) @$this->contents[$k]->contents[$j]->attrs['colspan'];
			for ($a = $j; $a <$j + $span; $a++){
				if ($this->checkCol($k,$a)){
					@$move = $this->contents[$i]->contents[$a]->contents;
					if (is_array($move))
						foreach($move as $v) $this->cellContent($i,$j,$v);

					$this->markspan[$i][$a] = true;//
					$this->contents[$i]->contents[$a] = '';


				}

			}
			@$move = $this->contents[$i]->contents[$j]->contents;
			if (is_array($move))
				foreach($move as $v)
				$this->cellContent($k,$j,$v);

			$this->markspan[$i][$j] = true;///
			$this->contents[$i]->contents[$j] = '';

		}
			
		else{
			$this->markspan[$i][$j] = false;
		}
		//else leave as it is
	}
	/**
	 * Start row and col sanitazation
	 */
	private function validate(){
		$row = $this->row;
		$col = $this->col;
		for($i=0;$i<$row;$i++)
			for($j=0;$j<$col;$j++)
			$this->sanitzeRow($i,$j);

		for($i=0;$i<$row;$i++)
			for($j=0;$j<$col;$j++)
			$this->sanitzeCol($i,$j);

	}
	/**
	 * Add cell content
	 * @param int $i
	 * @param int $j
	 * @param strint|array $content
	 * @param $array $attr
	 * @return \com\crysto\html\Table
	 */
	
	function cellContent($i,$j,$content,$attr = array()){
		if (!$content or ($i <= -1 or $i >= $this->row) or ($j <= -1 or $j >=$this->col))
			return $this;

		if(@$this->contents[$i]->contents[$j]){
			$this->contents[$i]->contents[$j]->add($content);
			if($attr and is_array($attr))
				$this->cellAtrr($i, $j, $attr);
		}
		return $this;
	}
	/**
	 * defined row styles
	 * @param int $i
	 * @param array|string $array
	 * @return \com\crysto\html\Table
	 */
	function rowStyle($i,$array){
		if (!$array or ($i <= -1 or $i >= $this->row))
			return $this;
		$this->contents[$i]->style($array);
		return $this;
	}
	/**
	 * defined row atrributes
	 * @param int $i
	 * @param array|string $array
	 * @return \com\crysto\html\Table
	 */
	function rowAttr($i,$array){
		if (!$array or ($i <= -1 or $i >= $this->row))
			return $this;
		$this->contents[$i]->attr($array);
		return $this;
	}
	/**
	 * defined cell styles
	 * @param int $i
	 * @param int $j
	 * @param array|string $array
	 * @return \com\crysto\html\Table
	 */
	function cellStyle($i,$j,$array){
		if (!$array or ($i <= -1 or $i >= $this->row) or ($j <= -1 or $j >=$this->col))
			return $this;
		$this->contents[$i]->contents[$j]->style($array);
		return $this;
	}
	/**
	 * defined cell styles
	 * @param int $i
	 * @param int $j
	 * @param array|string $array
	 * @return \com\crysto\html\Table
	 */
	function cellAtrr($i,$j,$array){
		if (!$array or ($i <= -1 or $i >= $this->row) or ($j <= -1 or $j >=$this->col))
			return $this;
		$this->contents[$i]->contents[$j]->attr($array);
		return $this;
	}
	/**
	 * initialize cells with non-breaking space
	 */
	final private function initCells(){
		$row = $this->row;
		$col = $this->col;
		for($i=0;$i<$row;$i++)
			for($j=0;$j<$col;$j++)
			if (@$this->contents[$i]->contents[$j] and
					@!$this->markspan[$i][$j] and
					count(@$this->contents[$i]->contents[$j]->contents) == 0)
			$this->cellContent($i,$j,'&nbsp;');

	}

	/**
	 * (non-PHPdoc)
	 * @see \com\crysto\html\Html::parse()
	 */
	final function parse(){
		$this->validate();
		$this->initCells();
		return parent::parse();

	}
}