<?php
/**
 * Created by PhpStorm.
 * User: cryst
 * Date: 18/10/02
 * Time: 11:34 PM
 */

namespace com\crysto\html;


class Table extends HtmlBox
{
    protected $header;
    protected $body;
    protected $footer;
    private $cols;
    private $rows;

    /**
     * Table constructor.
     * @param $row
     * @param $col
     * @param array $attr
     */
    public function __construct($row, $col, $attr = [])
    {
        $this->rows = $row;
        $this->cols = $col;
        parent::__construct('table', $attr);
        $this->body = new TableBody($row, $col);
        $this->header = new TableHeader(1, $col);
        $this->footer = new TableFooter(1, $col);
    }

    /**
     * @return TableHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return TableBody
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return TableFooter
     */
    public function getFooter()
    {
        return $this->footer;
    }

    function parse()
    {
        $this->contents[] = $this->header;
        $this->contents[] = $this->body;
        $footer_str = $this->footer->parse();
        if(!empty($footer_str)) {
            $this->contents[] = $footer_str;
        }
        return parent::parse();
    }

}