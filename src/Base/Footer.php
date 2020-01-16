<?php

namespace jobindas82\reporter\Base;

class Footer
{
    protected $rows = [];
    protected $params = [];

    function __construct($params = [])
    {
        $this->params = $params;
    }

    public function row($index=NULL, $params=[])
    {
        $row = isset($this->rows[$index]) && $index >= 0 ? $this->rows[$index] : new Row($params);
        $this->rows[] = $row;
        return $row;
    }

    public function rowsWithCells($trData = [])
    {
        foreach ($trData as $each) {
            $row = new Row(isset($each['params']) ? $each['params'] : []);
            $row->cells(isset($each['cells']) ? $each['cells'] : []);
            $this->rows[] = $row;
        }
        return;
    }

    public function getParams(){
        return $this->params;
    }

    public function getRows(){
        return $this->rows;
    }
}
