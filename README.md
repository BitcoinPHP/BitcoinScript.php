BitcoinScript
=============

Code is not functional yet

Objectives
==============

Create a transaction should look somehow like this:
```php
$transactionBuilder->addOutput($amountInSatoshi,
                               $scriptBuilder->addData('HELLO') //TxOut script
                                             ->addOpCode($OpCodes::OP_DUP)
                                             ->addData('HELLO2')
                                             ->addOpCode($OpCodes::OP_EQUAL)
                                             ->getRawScript()
                               )
                   ->addInput($outputTransactionHash,
                              $outputIndex,
                              $scriptBuilder->addData('HELLO') //sig Script
                                            ->addOpCode($OpCodes::OP_DUP)
                                            ->addData('HELLO2')
                                            ->addOpCode($OpCodes::OP_EQUAL)
                                            ->getRawScript()
                              )
                   )
                   
                   ->getRawTransaction();
```
