<?php

class questions
{
    private $parameters = [];

    const PARAMETERS_ERROR = [
        'ok' => false,
        'message' => 'query error',
        'code' => 400
    ];

    public function __construct($_parameters = [])
    {
        $this->parameters = $_parameters;
        if(!$this->validateParameters()){
            $this->response(self::PARAMETERS_ERROR);
        }
    }

    private function validateParameters()
    {
        $valid = true;
        if(gettype($this->parameters) !== 'array'){
            $valid = false;
        }else if(count($this->parameters) !== 1){
            $valid = false;
        }
        return $valid;
    }

    private function response(
        array   $_data)
    {
        header('Content-type: application/json');
        echo json_encode( $_data );
    }
}