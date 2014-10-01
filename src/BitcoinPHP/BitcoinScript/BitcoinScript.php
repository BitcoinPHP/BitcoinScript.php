<?php

/**
 *
 *
 * @author Jan Moritz Lindemann
 */

namespace BitcoinPHP\BitcoinScript;

class BitcoinScript
{

    private $vfExec = array();
    private $mainStack = array();
    private $altStack = array();
    private $script;

    private $opCodes = array('OP_FALSE'     => 0,
                             'OP_0'         => 0,
                             'OP_PUSHDATA1' => 76,
                             'OP_PUSHDATA2' => 77,
                             'OP_PUSHDATA4' => 78,
                             'OP_1NEGATE'   => 79,
                             'OP_RESERVED'  => 80,
                             'OP_TRUE'      => 81,
                             'OP_1'         => 81,
                             'OP_2'         => 82,
                             'OP_3'         => 83,
                             'OP_4'         => 84,
                             'OP_5'         => 85,
                             'OP_6'         => 86,
                             'OP_7'         => 87,
                             'OP_8'         => 88,
                             'OP_9'         => 89,
                             'OP_10'        => 90,
                             'OP_11'        => 91,
                             'OP_12'        => 92,
                             'OP_13'        => 93,
                             'OP_14'        => 94,
                             'OP_15'        => 95,
                             'OP_16'        => 96,

                             // control
                             'OP_NOP'       => 97,
                             'OP_VER'       => 98,
                             'OP_IF'        => 99,
                             'OP_NOTIF'     => 100,
                             'OP_VERIF'     => 101,
                             'OP_VERNOTIF'  => 102,
                             'OP_ELSE'      => 103,
                             'OP_ENDIF'     => 104,
                             'OP_VERIFY'    => 105,
                             'OP_RETURN'    => 106,

                             // stack ops
                             'OP_TOALTSTACK'   => 107,
                             'OP_FROMALTSTACK' => 108,
                             'OP_2DROP'        => 109,
                             'OP_2DUP'         => 110,
                             'OP_3DUP'         => 111,
                             'OP_2OVER'        => 112,
                             'OP_2ROT'         => 113,
                             'OP_2SWAP'        => 114,
                             'OP_IFDUP'        => 115,
                             'OP_DEPTH'        => 116,
                             'OP_DROP'         => 117,
                             'OP_DUP'          => 118,
                             'OP_NIP'          => 119,
                             'OP_OVER'         => 120,
                             'OP_PICK'         => 121,
                             'OP_ROLL'         => 122,
                             'OP_ROT'          => 123,
                             'OP_SWAP'         => 124,
                             'OP_TUCK'         => 125,

                             // splice ops
                             'OP_CAT'          => 126,
                             'OP_SUBSTR'       => 127,
                             'OP_LEFT'         => 128,
                             'OP_RIGHT'        => 129,
                             'OP_SIZE'         => 130,

                              // bit logic
                             'OP_INVERT'       => 131,
                             'OP_AND'          => 132,
                             'OP_OR'           => 133,
                             'OP_XOR'          => 134,
                             'OP_EQUAL'        => 135,
                             'OP_EQUALVERIFY'  => 136,
                             'OP_RESERVED1'    => 137,
                             'OP_RESERVED2'    => 138,

                             // numeric
                             'OP_1ADD'         => 139,
                             'OP_1SUB'         => 140,
                             'OP_2MUL'         => 141,
                             'OP_2DIV'         => 142,
                             'OP_NEGATE'       => 143,
                             'OP_ABS'          => 144,
                             'OP_NOT'          => 145,
                             'OP_0NOTEQUAL'    => 146,

                             'OP_ADD'          => 147,
                             'OP_SUB'          => 148,
                             'OP_MUL'          => 149,
                             'OP_DIV'          => 150,
                             'OP_MOD'          => 151,
                             'OP_LSHIFT'       => 152,
                             'OP_RSHIFT'       => 153,

                             'OP_BOOLAND'             => 154,
                             'OP_BOOLOR'              => 155,
                             'OP_NUMEQUAL'            => 156,
                             'OP_NUMEQUALVERIFY'      => 157,
                             'OP_NUMNOTEQUAL'         => 158,
                             'OP_LESSTHAN'            => 159,
                             'OP_GREATERTHAN'         => 160,
                             'OP_LESSTHANOREQUAL'     => 161,
                             'OP_GREATERTHANOREQUAL'  => 162,
                             'OP_MIN'                 => 163,
                             'OP_MAX'                 => 164,

                             'OP_WITHIN'              => 165,

                             // crypto
                             'OP_RIPEMD160'           => 166,
                             'OP_SHA1'                => 167,
                             'OP_SHA256'              => 168,
                             'OP_HASH160'             => 169,
                             'OP_HASH256'             => 170,
                             'OP_CODESEPARATOR'       => 171,
                             'OP_CHECKSIG'            => 172,
                             'OP_CHECKSIGVERIFY'      => 173,
                             'OP_CHECKMULTISIG'       => 174,
                             'OP_CHECKMULTISIGVERIFY' => 175,

                             // expansion
                             'OP_NOP1'  => 176,
                             'OP_NOP2'  => 177,
                             'OP_NOP3'  => 178,
                             'OP_NOP4'  => 179,
                             'OP_NOP5'  => 180,
                             'OP_NOP6'  => 181,
                             'OP_NOP7'  => 182,
                             'OP_NOP8'  => 183,
                             'OP_NOP9'  => 184,
                             'OP_NOP10' => 185,

                             // template matching params
                             'OP_PUBKEYHASH'    => 253,
                             'OP_PUBKEY'        => 254,
                             'OP_INVALIDOPCODE' =>255);

    private $rOpCodes = array();

    public function __construct()
    {
        foreach($this->opCodes as $key => $codeNbr)
        {
            $this->rOpCodes[$codeNbr] = $key;
        }
    }

    public function setScript($script)
    {
        $this->script = $script;
    }

    public function setHexScript($script)
    {
        $this->script = hex2bin($script);
    }

    public function evalScript()
    {
        $this->executeOpCode();
    }

    public function executeOpCode($position = 0, $continue = true)
    {
        $nextPosition = 0;
        $opCode = $this->rOpCodes[ord(substr($this->script, $position, 1))];
        switch($opCode)
        {

            case 'OP_CAT':
            case 'OP_SUBSTR':
            case 'OP_LEFT':
            case 'OP_RIGHT':
            case 'OP_INVERT':
            case 'OP_AND':
            case 'OP_OR':
            case 'OP_XOR':
            case 'OP_2MUL':
            case 'OP_2DIV':
            case 'OP_MUL':
            case 'OP_DIV':
            case 'OP_MOD':
            case 'OP_LSHIFT':
            case 'OP_RSHIFT':
                return false;

            case 'OP_1NEGATE':
            case 'OP_1':
            case 'OP_2':
            case 'OP_3':
            case 'OP_4':
            case 'OP_5':
            case 'OP_6':
            case 'OP_7':
            case 'OP_8':
            case 'OP_9':
            case 'OP_10':
            case 'OP_11':
            case 'OP_12':
            case 'OP_13':
            case 'OP_14':
            case 'OP_15':
            case 'OP_16':
                //??
            break;

            case 'OP_NOP':
            case 'OP_NOP1': case 'OP_NOP2': case 'OP_NOP3': case 'OP_NOP4': case 'OP_NOP5':
            case 'OP_NOP6': case 'OP_NOP7': case 'OP_NOP8': case 'OP_NOP9': case 'OP_NOP10':
            break;

            case 'OP_IF':
            case 'OP_NOTIF':
                if(empty($this->mainStack))
                    return false;
                $vch = $this->popFromMainStack();
                $fValue = $this->castToBool($vch);
                if($opCode == 'OP_NOTIF')
                    $fValue = !$fValue;
                array_push($this->vfExec, $fValue);
                $nextPosition = $position + 1;
            break;

            case 'OP_ELSE':
                if (empty($this->vfExec))
                    return false;
                $this->vfExec[0] = !$this->vfExec[0];
                $nextPosition = $position + 1;
            break;

            case 'OP_ENDIF':
                if (empty($this->vfExec))
                    return false;
                array_pop($this->vfExec);
                $nextPosition = $position + 1;
            break;

            case 'OP_VERIFY':
                if (empty($this->mainStack))
                    return false;
                if(false == $this->castToBool($this->popFromMainStack()))
                    return false;
                $nextPosition = $position + 1;
            break;

            case 'OP_RETURN':
                return false;
            break;

            case 'OP_TOALTSTACK':
                if (empty($this->mainStack))
                    return false;
                $this->pushOnAlStack($this->popFromMainStack());
                $nextPosition = $position + 1;
            break;

            case 'OP_FROMALTSTACK':
                if (empty($this->altStack))
                    return false;
                $this->pushOnMainStack($this->popFromAltStack());
                $nextPosition = $position + 1;
            break;

            case 'OP_2DROP':
                // (x1 x2 -- )
                if (count($this->mainStack) < 2)
                    return false;
                $this->popFromMainStack();
                $this->popFromMainStack();
                $nextPosition = $position + 1;
            break;

            case 'OP_2DUP':
                // (x1 x2 -- x1 x2 x1 x2)
                if (count($this->mainStack) < 2)
                    return false;
                $vch1 = $this->stacktop(-2);
                $vch2 = $this->stacktop(-1);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $nextPosition = $position + 1;
            break;

            case 'OP_3DUP':
                // (x1 x2 x3 -- x1 x2 x3 x1 x2 x3)
                if (count($this->mainStack) < 3)
                    return false;
                $vch1 = $this->stacktop(-3);
                $vch2 = $this->stacktop(-2);
                $vch3 = $this->stacktop(-1);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $this->pushOnMainStack($vch3);
                $nextPosition = $position + 1;
            break;

            case 'OP_2OVER':
                // (x1 x2 x3 x4 -- x1 x2 x3 x4 x1 x2)
                if (count($this->mainStack) < 4)
                    return false;
                $vch1 = $this->stacktop(-4);
                $vch2 = $this->stacktop(-3);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $nextPosition = $position + 1;
            break;


            case 'OP_2ROT':
                // (x1 x2 x3 x4 x5 x6 -- x3 x4 x5 x6 x1 x2)
                if (count($this->mainStack) < 6)
                    return false;
                $vch1 = $this->stacktop(-6);
                $vch2 = $this->stacktop(-5);

                $this->eraseFromMainStack(-6);
                $this->eraseFromMainStack(-5);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $nextPosition = $position + 1;
            break;

            case 'OP_2SWAP':
                // (x1 x2 x3 x4 -- x3 x4 x1 x2)
                if (count($this->mainStack) < 4)
                    return false;
                $vch1 = $this->stacktop(-2);
                $vch2 = $this->stacktop(-4);
                $this->setOnMainStack($vch1, -4);
                $this->setOnMainStack($vch2, -2);

                $vch1 = $this->stacktop(-1);
                $vch2 = $this->stacktop(-3);
                $this->setOnMainStack($vch1, -3);
                $this->setOnMainStack($vch2, -1);
                $nextPosition = $position + 1;
            break;

            case 'OP_IFDUP':
                // (x - 0 | x x)
                if (count($this->mainStack) < 1)
                    return false;
                $vch = $this->stacktop(-1);
                if($this->castToBool($vch))
                    $this->pushOnMainStack($vch);
                $nextPosition = $position + 1;
            break;

            case 'OP_DEPTH':
                // -- stacksize
                $this->pushOnMainStack(count($this->mainStack));
                $nextPosition = $position + 1;
            break;

            case 'OP_DROP':
                // (x -- )
                if (count($this->mainStack) < 1)
                    return false;
                $this->popFromMainStack();
                $nextPosition = $position + 1;
            break;

            case 'OP_DUP':
                // (x -- x x)
                if (count($this->mainStack) < 1)
                    return false;
                $vch = $this->stacktop(-1);
                $this->pushOnMainStack($vch);
                $nextPosition = $position + 1;
            break;

            case 'OP_NIP':
                // (x1 x2 -- x2)
                if (count($this->mainStack) < 2)
                    return false;
                $this->eraseFromMainStack(-2);
                $nextPosition = $position + 1;
            break;

            case 'OP_OVER':
                // (x1 x2 -- x1 x2 x1)
                if (count($this->mainStack) < 2)
                    return false;
                $vch = $this->stacktop(-2);
                $this->pushOnMainStack($vch);
                $nextPosition = $position + 1;
            break;

            case 'OP_PICK':
            case 'OP_ROLL':
                // (xn ... x2 x1 x0 n - xn ... x2 x1 x0 xn)
                // (xn ... x2 x1 x0 n - ... x2 x1 x0 xn)
                if (count($this->mainStack) < 2)
                    return false;
                $n = $this->stacktop(-1);
                $this->popFromMainStack();
                if ($n < 0 || $n >= count($this->mainStack))
                    return false;
                $vch = $this->stacktop(-$n-1);
                if ($opCode == 'OP_ROLL')
                    $this->eraseFromMainStack(-$n-1);
                $this->pushOnMainStack($vch);
                $nextPosition = $position + 1;
            break;

            case 'OP_ROT':
                // (x1 x2 x3 -- x2 x3 x1)
                //  x2 x1 x3  after first swap
                //  x2 x3 x1  after second swap
                if (count($this->mainStack) < 3)
                    return false;
                swap(stacktop(-3), stacktop(-2));
                swap(stacktop(-2), stacktop(-1));
            break;

            case 'OP_SWAP':
            {
                // (x1 x2 -- x2 x1)
                if (stack.size() < 2)
                    return false;
                swap(stacktop(-2), stacktop(-1));
            }
                break;

            case 'OP_TUCK':
            {
                // (x1 x2 -- x2 x1 x2)
                if (stack.size() < 2)
                    return false;
                valtype vch = stacktop(-1);
                    stack.insert(stack.end()-2, vch);
                }
                break;


            case 'OP_SIZE':
            {
                // (in -- in size)
                if (stack.size() < 1)
                    return false;
                CScriptNum bn(stacktop(-1).size());
                    stack.push_back(bn.getvch());
                }
                break;


            //
            // Bitwise logic
            //
            case 'OP_EQUAL':
            case 'OP_EQUALVERIFY':
                //case OP_NOTEQUAL: // use OP_NUMNOTEQUAL
            {
                // (x1 x2 - bool)
                if (stack.size() < 2)
                    return false;
                valtype& vch1 = stacktop(-2);
                valtype& vch2 = stacktop(-1);
                bool fEqual = (vch1 == vch2);
                    // OP_NOTEQUAL is disabled because it would be too easy to say
                    // something like n != 1 and have some wiseguy pass in 1 with extra
                    // zero bytes after it (numerically, 0x01 == 0x0001 == 0x000001)
                    //if (opcode == OP_NOTEQUAL)
                    //    fEqual = !fEqual;
                    popstack(stack);
                    popstack(stack);
                    stack.push_back(fEqual ? vchTrue : vchFalse);
                    if (opcode == OP_EQUALVERIFY)
                    {
                        if (fEqual)
                            popstack(stack);
                        else
                            return false;
                    }
                }
                break;


            //
            // Numeric
            //
            case 'OP_1ADD':
            case 'OP_1SUB':
            case 'OP_NEGATE':
            case 'OP_ABS':
            case 'OP_NOT':
            case 'OP_0NOTEQUAL':
            {
                // (in -- out)
                if (stack.size() < 1)
                    return false;
                CScriptNum bn(stacktop(-1));
                    switch (opcode)
                    {
                        case OP_1ADD:       bn += bnOne; break;
                        case OP_1SUB:       bn -= bnOne; break;
                        case OP_NEGATE:     bn = -bn; break;
                        case OP_ABS:        if (bn < bnZero) bn = -bn; break;
                        case OP_NOT:        bn = (bn == bnZero); break;
                        case OP_0NOTEQUAL:  bn = (bn != bnZero); break;
                        default:            assert(!"invalid opcode"); break;
                    }
                    popstack(stack);
                    stack.push_back(bn.getvch());
                }
                break;

            case 'OP_ADD':
            case 'OP_SUB':
            case 'OP_BOOLAND':
            case 'OP_BOOLOR':
            case 'OP_NUMEQUAL':
            case 'OP_NUMEQUALVERIFY':
            case 'OP_NUMNOTEQUAL':
            case 'OP_LESSTHAN':
            case 'OP_GREATERTHAN':
            case 'OP_LESSTHANOREQUAL':
            case 'OP_GREATERTHANOREQUAL':
            case 'OP_MIN':
            case 'OP_MAX':
            {
                // (x1 x2 -- out)
                if (stack.size() < 2)
                    return false;
                CScriptNum bn1(stacktop(-2));
                    CScriptNum bn2(stacktop(-1));
                    CScriptNum bn(0);
                    switch (opcode)
                    {
                        case OP_ADD:
                            bn = bn1 + bn2;
                            break;

                        case OP_SUB:
                            bn = bn1 - bn2;
                            break;

                        case OP_BOOLAND:             bn = (bn1 != bnZero && bn2 != bnZero); break;
                        case OP_BOOLOR:              bn = (bn1 != bnZero || bn2 != bnZero); break;
                        case OP_NUMEQUAL:            bn = (bn1 == bn2); break;
                        case OP_NUMEQUALVERIFY:      bn = (bn1 == bn2); break;
                        case OP_NUMNOTEQUAL:         bn = (bn1 != bn2); break;
                        case OP_LESSTHAN:            bn = (bn1 < bn2); break;
                        case OP_GREATERTHAN:         bn = (bn1 > bn2); break;
                        case OP_LESSTHANOREQUAL:     bn = (bn1 <= bn2); break;
                        case OP_GREATERTHANOREQUAL:  bn = (bn1 >= bn2); break;
                        case OP_MIN:                 bn = (bn1 < bn2 ? bn1 : bn2); break;
                        case OP_MAX:                 bn = (bn1 > bn2 ? bn1 : bn2); break;
                        default:                     assert(!"invalid opcode"); break;
                    }
                    popstack(stack);
                    popstack(stack);
                    stack.push_back(bn.getvch());

                    if (opcode == OP_NUMEQUALVERIFY)
                    {
                        if (CastToBool(stacktop(-1)))
                            popstack(stack);
                        else
                            return false;
                    }
                }
                break;

            case 'OP_WITHIN':
            {
                // (x min max -- out)
                if (stack.size() < 3)
                    return false;
                CScriptNum bn1(stacktop(-3));
                    CScriptNum bn2(stacktop(-2));
                    CScriptNum bn3(stacktop(-1));
                    bool fValue = (bn2 <= bn1 && bn1 < bn3);
                    popstack(stack);
                    popstack(stack);
                    popstack(stack);
                    stack.push_back(fValue ? vchTrue : vchFalse);
                }
                break;


            //
            // Crypto
            //
            case 'OP_RIPEMD160':
            case 'OP_SHA1':
            case 'OP_SHA256':
            case 'OP_HASH160':
            case 'OP_HASH256':
            {
                // (in -- hash)
                if (stack.size() < 1)
                    return false;
                valtype& vch = stacktop(-1);
                valtype vchHash((opcode == OP_RIPEMD160 || opcode == OP_SHA1 || opcode == OP_HASH160) ? 20 : 32);
                    if (opcode == OP_RIPEMD160)
                        CRIPEMD160().Write(begin_ptr(vch), vch.size()).Finalize(begin_ptr(vchHash));
                    else if (opcode == OP_SHA1)
                        CSHA1().Write(begin_ptr(vch), vch.size()).Finalize(begin_ptr(vchHash));
                    else if (opcode == OP_SHA256)
                        CSHA256().Write(begin_ptr(vch), vch.size()).Finalize(begin_ptr(vchHash));
                    else if (opcode == OP_HASH160)
                        CHash160().Write(begin_ptr(vch), vch.size()).Finalize(begin_ptr(vchHash));
                    else if (opcode == OP_HASH256)
                        CHash256().Write(begin_ptr(vch), vch.size()).Finalize(begin_ptr(vchHash));
                    popstack(stack);
                    stack.push_back(vchHash);
                }
                break;

        }
    }

    public function popFromMainStack()
    {
        return array_pop($this->mainStack);
    }

    public function popFromAltStack()
    {
        return array_pop($this->altStack);
    }

    public function eraseFromMainStack($pos)
    {
        unset($this->mainStack[count($this->mainStack) + $pos]);
    }

    public function eraseFromAltStack($pos)
    {
        unset($this->altStack[count($this->altStack) + $pos]);
    }

    public function setOnMainStack($value, $pos)
    {
        $this->mainStack[count($this->mainStack) + $pos] = $value;
    }

    public function setOnAltStack($value, $pos)
    {
        $this->altStack[count($this->altStack) + $pos] = $value;
    }

    public function pushOnMainStack($entry)
    {
        array_push($this->mainStack, $entry);
    }

    public function pushOnAlStack($entry)
    {
        array_push($this->altStack, $entry);
    }

    public function stacktop($pos)
    {
        return $this->mainStack[count($this->mainStack) + $pos];
    }

    public function altStacktop($pos)
    {
        return $this->altStack[count($this->altStack) + $pos];
    }

    public function eraseStack($pos)
    {
        return $this->altStack[count($this->altStack) + $pos];
    }

    public function castToBool($value)
    {
        if($value)
            return true;
        else
            return false;
    }

}

?>