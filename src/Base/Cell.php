<?php

namespace jobindas82\reporter\Base;

class Cell
{
    protected $value;
    protected $params = [];

    function __construct($value, $params = [])
    {
        $this->value = $value;
        $this->params = $params;
    }

    public function getValue(){
        return $this->value;
    }

    public function getParams(){
        return $this->params;
    }
}
