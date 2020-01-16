<?php

namespace jobindas82\reporter\Base;

class Row
{
    protected $cells = [];
    protected $headerCells = [];
    protected $params = [];

    function __construct($params = [])
    {
        $this->params = $params;
    }

    public function headerCell($value = NULL, $index = NULL, $params = [])
    {
        $this->headerCells[] = isset($this->cells[$index]) && $index >= 0 ? $this->cells[$index] : new Cell($value, $params);
        return;
    }

    public function cell($value = NULL, $index = NULL, $params = [])
    {
        $this->cells[] = isset($this->cells[$index]) && $index >= 0 ? $this->cells[$index] : new Cell($value, $params);
        return;
    }

    public function headerCells($tdData)
    {
        foreach ($tdData as $each) {
            $this->headerCells[] = new Cell(isset($each[0]) ? $each[0] : NULL, isset($each[1]) ? $each[1] : []);
        }
        return;
    }

    public function cells($tdData)
    {
        foreach ($tdData as $each) {
            $this->cells[] = new Cell(isset($each[0]) ? $each[0] : NULL, isset($each[1]) ? $each[1] : []);
        }
        return;
    }

    public function getHeaderCells(){
        return $this->headerCells;
    }

    public function getCells(){
        return $this->cells;
    }
}
