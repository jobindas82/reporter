<?php

namespace jobindas82\reporter;

use jobindas82\reporter\Base as Base;

class Reporter
{
    protected $tableName = NULL;
    protected $params = [];
    protected $head = NULL;
    protected $body = NULL;
    protected $footer = NULL;
    protected $tableData = NULL;
    protected $compiledClass;
    protected $meta = [
        'creator' => '',
        'lastModified' => '',
        'title' => '',
        'subject' => '',
        'description' => '',
        'keywords' => '',
        'category' => ''
    ];

    function __construct($tableName, $params = [], $tableData = NULL)
    {
        $this->params = $params;
        $this->tableName = $tableName;
        $this->tableData = $tableData;
        if ($tableData != NULL) {
            $this->_BuildTableArray();
        }
        $this->compileHtmlClass();
    }

    function compileHtmlClass(){
        if( isset($this->params['htmlClass']) ){
            $this->compiledClass = implode(' ', $this->params['htmlClass']);
        }
        return;
    }

    function _BuildTableArray()
    {
        return;
    }

    public function meta($metaData = NULL){
        if( $metaData != NULL )
            $this->meta = $metaData;
        return;
    }

    public function head($params = [])
    {
        $this->head = new Base\Head($params);
        return $this->head;
    }

    public function body($params = [])
    {
        $this->body = new Base\Body($params);
        return $this->body;
    }

    public function footer($params = [])
    {
        $this->footer = new Base\Footer($params);
        return $this->footer;
    }

    public function outJson($echo = false)
    {
        //Table Header
        $tableHeader = [];
        if ($this->head != NULL) {
            $tableHeader = ['params' => $this->head->getParams()];
            foreach ($this->head->getRows() as $x => $eachRow) {
                $cells = $eachRow->getHeaderCells();
                for ($i = 0; $i < count($cells); $i++) {
                    $tableHeader['data'][$x][] = ['value' => $cells[$i]->getValue(), 'params' => $cells[$i]->getParams()];
                }
            }
        }

        //Table Body
        $tableBody = [];
        if ($this->body != NULL) {
            $tableBody = ['params' => $this->body->getParams()];
            foreach ($this->body->getRows() as $x => $eachRow) {
                $cells = $eachRow->getCells();
                for ($i = 0; $i < count($cells); $i++) {
                    $tableBody['data'][$x][] = ['value' => $cells[$i]->getValue(), 'params' => $cells[$i]->getParams()];
                }
            }
        }

        //Table Footer
        $tableFooter = [];
        if ($this->footer != NULL) {
            $tableFooter = ['params' => $this->footer->getParams()];
            foreach ($this->footer->getRows() as $x => $eachRow) {
                $cells = $eachRow->getCells();
                for ($i = 0; $i < count($cells); $i++) {
                    $tableFooter['data'][$x][] = ['value' => $cells[$i]->getValue(), 'params' => $cells[$i]->getParams()];
                }
            }
        }

        $response = [
            'tableName' => $this->tableName,
            'meta' => $this->meta,
            'tableParams' => $this->params,
            'tableHtmlClass' => $this->compiledClass,
            'tableHeader' => $tableHeader,
            'tableBody' => $tableBody,
            'tableFooter' => $tableFooter
        ];

        if ($echo)
            echo json_encode($response);
        else
            return json_encode($response);
    }

    public static function outHtml(){
        echo 'hello';
    }
}
