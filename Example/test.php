<?php

use \BitcoinPHP\BitcoinScript\OpCodes;
use \BitcoinPHP\BitcoinScript\Interpreter;
use \BitcoinPHP\BitcoinScript\ScriptBuilder;

require_once('../src/BitcoinPHP/BitcoinScript/OpCodes.php');
require_once('../src/BitcoinPHP/BitcoinScript/Interpreter.php');
require_once('../src/BitcoinPHP/BitcoinScript/ScriptBuilder.php');


$opCodes = new OpCodes();
$interpreter = new Interpreter($opCodes);
$scriptBuilder = new ScriptBuilder($opCodes);

$scriptBuilder->setInterpreter($interpreter);

$script = $scriptBuilder->pushData('HELLO')
              ->pushData('HELLO2')
              ->pushData('LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL')
              ->pushNumber(4)
              ->pushNumber(2)
              ->pushNumber(42)
             // ->addOpCode(OpCodes::OP_EQUAL)
              ->addOpCode(OpCodes::OP_DROP)
              ->addOpCode(OpCodes::OP_DROP)
              ->addOpCode(OpCodes::OP_DROP)
              ->addOpCode(OpCodes::OP_DROP)
              ->addOpCode(OpCodes::OP_DUP)
              ->addOpCode(OpCodes::OP_DUP)
              //->addOpCode(OpCodes::OP_EQUAL)
              ->getHexScript();

$scriptBuilder->dumpScript();

$interpreter->setHexScript($script);
$interpreter->evalScript(true);
