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
        //TODO use OP_1,2,3...16 for optimizing script size
        switch(strlen($dataLength))
        {
            case 0:
                return $this;
            case 1:
                if(ord($data) === 0)
                    array_push($this->script, array('opCode' => OpCodes::OP_FALSE));
                else if(ord($data) === 1)
                    array_push($this->script, array('opCode' => OpCodes::OP_1));
                else if(ord($data) === 2)
                    array_push($this->script, array('opCode' => OpCodes::OP_2));
                else if(ord($data) === 3)
                    array_push($this->script, array('opCode' => OpCodes::OP_3));
                else if(ord($data) === 4)
                    array_push($this->script, array('opCode' => OpCodes::OP_4));
                else if(ord($data) === 5)
                    array_push($this->script, array('opCode' => OpCodes::OP_5));
                else if(ord($data) === 6)
                    array_push($this->script, array('opCode' => OpCodes::OP_6));
                else if(ord($data) === 7)
                    array_push($this->script, array('opCode' => OpCodes::OP_7));
                else if(ord($data) === 8)
                    array_push($this->script, array('opCode' => OpCodes::OP_8));
                else if(ord($data) === 9)
                    array_push($this->script, array('opCode' => OpCodes::OP_9));
                else if(ord($data) === 10)
                    array_push($this->script, array('opCode' => OpCodes::OP_10));
                else if(ord($data) === 11)
                    array_push($this->script, array('opCode' => OpCodes::OP_11));
                else if(ord($data) === 12)
                    array_push($this->script, array('opCode' => OpCodes::OP_12));
                else if(ord($data) === 13)
                    array_push($this->script, array('opCode' => OpCodes::OP_13));
                else if(ord($data) === 14)
                    array_push($this->script, array('opCode' => OpCodes::OP_14));
                else if(ord($data) === 15)
                    array_push($this->script, array('opCode' => OpCodes::OP_15));
                else if(ord($data) === 16)
                    array_push($this->script, array('opCode' => OpCodes::OP_16));
                if(ord($data) < 17)
                    return $this;
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
     * @param int $number
     * @return $this
     */
    public function pushNumber($number)
    {
        $this->pushData(
            $this->interpreter->numToVarIntString($number)
        );
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