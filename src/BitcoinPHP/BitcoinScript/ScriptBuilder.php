<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 11/6/15
 * Time: 4:40 PM
 */

namespace BitcoinPHP\BitcoinScript;


class ScriptBuilder
{
    private $interpreter;
    private $script = array();

    public function __construct()
    {

    }

    /**
     * @param Interpreter $Interpreter
     */
    public function setInterpreter($Interpreter)
    {
        $this->interpreter = $Interpreter;
    }

    /**
     * @param string $opCode
     * @return $this
     */
    public function addOpCode($opCode)
    {
        array_push($this->script, $opCode);
        return $this;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function addData($data)
    {
        array_push($this->script, $data);
        return $this;
    }

    public function getScript()
    {

    }

    public function getRawScript()
    {

    }
}