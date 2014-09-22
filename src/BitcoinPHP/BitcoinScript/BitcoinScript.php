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
                if (count($this->mainStack) < 2)
                    return false;
                $this->popFromMainStack();
                $this->popFromMainStack();
                $nextPosition = $position + 1;
            break;

            case 'OP_2DUP':
                if (count($this->mainStack) < 2)
                    return false;
                $vch1 = $this->stacktop(-2);
                $vch2 = $this->stacktop(-1);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $nextPosition = $position + 1;
            break;

            case 'OP_3DUP':
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
                if (count($this->mainStack) < 4)
                    return false;
                $vch1 = $this->stacktop(-4);
                $vch2 = $this->stacktop(-3);
                $this->pushOnMainStack($vch1);
                $this->pushOnMainStack($vch2);
                $nextPosition = $position + 1;
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
        return $this->mainStack[$pos*-1];
    }

    public function altStacktop($pos)
    {
        return $this->altStack[$pos*-1];
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