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
    private $opCodes;
    private $rOpCodes;

    /**
     * @param OpCodes $opCodes
     */
    public function __construct($opCodes)
    {
        $this->opCodes = $opCodes->getOpcodes();
        $this->rOpCodes = $opCodes->getRopCodes();
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