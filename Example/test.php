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

$scriptBuilder->pushData('HELLO')
              ->pushData('HELLO2')
              ->addOpCode(OpCodes::OP_EQUAL)
              ->addOpCode(OpCodes::OP_DROP)
              ->addOpCode(OpCodes::OP_DUP)
              ->addOpCode(OpCodes::OP_EQUAL)
              ->dumpScript();