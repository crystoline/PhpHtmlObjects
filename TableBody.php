<?php
/**
 * Created by PhpStorm.
 * User: cryst
 * Date: 18/10/02
 * Time: 11:33 PM
 */

namespace com\crysto\html;


class TableBody extends Tabular
{
    public function __construct($row, $col)
    {
        parent::__construct($row, $col, 'tbody');
    }
}