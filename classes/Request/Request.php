<?php

namespace Request;

class Request
{
    private $method;
    private $parameters;
    private $action;

    const ACTION_QUESTIONS = 'questions';
    const ACTION_COMPONENTS = 'components';

    public function __construct()
    {
        if(!isset($_GET['parameter']) || $_GET['parameter'] == ''){
            $this->responseError();
        }else{
            $this->method = $_SERVER['REQUEST_METHOD'];
            $queryString = explode('/', $_GET['parameter']);
            $this->action = trim($queryString[0], '/');
            $this->setParameters($queryString);
            switch($this->action)
            {
                case self::ACTION_QUESTIONS:
                    $this->action = self::ACTION_QUESTIONS;
                    break;
                case self::ACTION_COMPONENTS:
                    $this->action = self::ACTION_COMPONENTS;
                    break;
                default:
                    $this->responseError();
            }
        }
    }

    private function setParameters(
        array    $parameters)
    {
        $this->parameters = [];
        for($i=1; $i<=count($parameters); $i++) {
            if(isset($parameters[$i])
                && !is_null($parameters[$i])
                && $parameters[$i] != '')
            {
                $this->parameters[] = $parameters[$i];
            }
        }
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMethod()
    {
        return $this->method;
    }

    private function responseError()
    {
        die('Error');
    }
}