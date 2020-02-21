<?php

class questions
{
    private $parameters = [];
    private $lang;

    const PARAM_LANGUAGE = 'lang';

    const PARAMETERS_ERROR = [
        'ok' => false,
        'message' => 'query error',
        'code' => 400
    ];

    const METHOD_ERROR = [
        'ok' => false,
        'message' => 'Method not allowed',
        'code' => 405
    ];

    public function __construct($_parameters = [], $_method = 'get')
    {
        $this->parameters = $_parameters;
        if(!$this->setParameters()){
            $this->response(self::PARAMETERS_ERROR);
        }
        switch($_method)
        {
            case 'GET':
                break;
            case 'POST':
                // List of translated questions and associated choices
                $this->response($this->getTranslatedQuestions());
                break;
            default:
                $this->response(self::METHOD_ERROR);
        }
    }

    private function setParameters(): bool
    {
        $valid = true;
        if(gettype($this->parameters) !== 'array'){
            $valid = false;
        }else if(count($this->parameters) !== 1){
            $valid = false;
        }else{
            $params = explode('=', $this->parameters[0]);
            if($params[0] !== self::PARAM_LANGUAGE){
                $valid = false;
            }else{
                $this->lang = $params[1];
            }
        }
        return $valid;
    }

    private function response(
        array   $_data)
    {
        header('Content-type: application/json');
        echo json_encode( $_data );
    }

    private function getTranslatedQuestions()
    {
        $data = file_get_contents('./sources/questions.json');
        // TODO: TRANSLATE
        return json_decode($data);
    }
}