<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 11/6/15
 * Time: 2:49 PM
 */

namespace BitcoinPHP\BitcoinScript;


class TransactionBuilder
{
    private $interpreter;

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
     * @param $transactionInput
     */
    public function addTransactionInput($transactionInput)
    {

    }

    public function addTransactionOutput($transactionOut)
    {

    }

    public function getTransaction()
    {

    }

    public function getHexTransaction()
    {

    }

    public function getRawTransaction()
    {

    }
}