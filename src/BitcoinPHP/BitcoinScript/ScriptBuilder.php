<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 11/6/15
 * Time: 4:40 PM
 */

namespace BitcoinPHP\BitcoinScript;

use BitcoinPHP\BitcoinScript\Interpreter;

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
     * @throws \Exception
     */
    public function addOpCode($opCode)
    {
        if(!isset($this->opCodes[$opCode]))
            throw new \Exception('Opcode not found : ' . $opCode);
        array_push($this->script, array('opCode' => $opCode));
        return $this;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function pushData($data)
    {
        $dataLength = $this->interpreter->numToVarIntString(strlen($data));

        switch(strlen($dataLength))
        {
            case 0:
                return $this;

            case 1:
                array_push($this->script, array('opCode' => OpCodes::OP_PUSHDATA1));
            break;

            case 2:
                array_push($this->script, array('opCode' => OpCodes::OP_PUSHDATA2));
            break;

            case 3:
                array_push($this->script, array('opCode' => OpCodes::OP_PUSHDATA3));
            break;
        }

        array_push($this->script, array('bin' => $dataLength));
        array_push($this->script, array('bin' => $data));
        return $this;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function pushHexData($data)
    {
        $data = hex2bin($data);
        return $this->pushData($data);
    }

    /**
     * @return array
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @return string
     */
    public function getHexScript()
    {
        return bin2hex($this->getRawScript());
    }

    /**
     * @return string
     */
    public function getRawScript()
    {
        $script = '';
        foreach($this->script as $scriptElement)
        {
            if(is_array($scriptElement) && isset($scriptElement['opCode']))
                $script .= chr($this->opCodes[$scriptElement['opCode']]);
            if(is_array($scriptElement) && isset($scriptElement['bin']))
                $script .= $scriptElement['bin'];
        }
        return $script;
    }

    public function dumpScript()
    {
        foreach($this->script as $scriptElement)
        {
            if(is_array($scriptElement) && isset($scriptElement['opCode']))
                $dump =  '<' . $scriptElement['opCode'] . '>';
            if(is_array($scriptElement) && isset($scriptElement['bin']))
                $dump = '<0x' . bin2hex($scriptElement['bin']) . '>';

            if(isset($dump))
                echo $dump . ' ';
        }
    }
}