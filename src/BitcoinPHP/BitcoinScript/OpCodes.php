<?php
/**
 *
 */

namespace BitcoinPHP\BitcoinScript;


class OpCodes
{
    const OP_FALSE = 'OP_FALSE';
    const OP_0 = 'OP_0';
    const OP_PUSHDATA1 = 'OP_PUSHDATA1';
    const OP_PUSHDATA2 = 'OP_PUSHDATA2';
    const OP_PUSHDATA4 = 'OP_PUSHDATA4';
    const OP_1NEGATE = 'OP_1NEGATE';
    const OP_RESERVED = 'OP_RESERVED';
    const OP_TRUE = 'OP_TRUE';
    const OP_1 = 'OP_1';
    const OP_2 = 'OP_2';
    const OP_3 = 'OP_3';
    const OP_4 = 'OP_4';
    const OP_5 = 'OP_5';
    const OP_6 = 'OP_6';
    const OP_7 = 'OP_7';
    const OP_8 = 'OP_8';
    const OP_9 = 'OP_9';
    const OP_10 = 'OP_10';
    const OP_11 = 'OP_11';
    const OP_12 = 'OP_12';
    const OP_13 = 'OP_13';
    const OP_14 = 'OP_14';
    const OP_15 = 'OP_15';
    const OP_16 = 'OP_16';

    // control
    const OP_NOP = 'OP_NOP';
    const OP_VER = 'OP_VER';
    const OP_IF = 'OP_IF';
    const OP_NOTIF = 'OP_NOTIF';
    const OP_VERIF = 'OP_VERIF';
    const OP_VERNOTIF = 'OP_VERNOTIF';
    const OP_ELSE = 'OP_ELSE';
    const OP_ENDIF = 'OP_ENDIF';
    const OP_VERIFY = 'OP_VERIFY';
    const OP_RETURN = 'OP_RETURN';

    // stack ops
    const OP_TOALTSTACK = 'OP_TOALTSTACK';
    const OP_FROMALTSTACK = 'OP_FROMALTSTACK';
    const OP_2DROP = 'OP_2DROP';
    const OP_2DUP = 'OP_2DUP';
    const OP_3DUP = 'OP_3DUP';
    const OP_2OVER = 'OP_2OVER';
    const OP_2ROT = 'OP_2ROT';
    const OP_2SWAP = 'OP_2SWAP';
    const OP_IFDUP = 'OP_IFDUP';
    const OP_DEPTH = 'OP_DEPTH';
    const OP_DROP = 'OP_DROP';
    const OP_DUP = 'OP_DUP';
    const OP_NIP = 'OP_NIP';
    const OP_OVER = 'OP_OVER';
    const OP_PICK = 'OP_PICK';
    const OP_ROLL = 'OP_ROLL';
    const OP_ROT = 'OP_ROT';
    const OP_SWAP = 'OP_SWAP';
    const OP_TUCK = 'OP_TUCK';

    // splice ops
    const OP_CAT = 'OP_CAT';
    const OP_SUBSTR = 'OP_SUBSTR';
    const OP_LEFT = 'OP_LEFT';
    const OP_RIGHT = 'OP_RIGHT';
    const OP_SIZE = 'OP_SIZE';

    // bit logic
    const OP_INVERT = 'OP_INVERT';
    const OP_AND = 'OP_AND';
    const OP_OR = 'OP_OR';
    const OP_XOR = 'OP_XOR';
    const OP_EQUAL = 'OP_EQUAL';
    const OP_EQUALVERIFY = 'OP_EQUALVERIFY';
    const OP_RESERVED1 = 'OP_RESERVED1';
    const OP_RESERVED2 = 'OP_RESERVED2';

    // numeric
    const OP_1ADD = 'OP_1ADD';
    const OP_1SUB = 'OP_1SUB';
    const OP_2MUL = 'OP_2MUL';
    const OP_2DIV = 'OP_2DIV';
    const OP_NEGATE = 'OP_NEGATE';
    const OP_ABS = 'OP_ABS';
    const OP_NOT = 'OP_NOT';
    const OP_0NOTEQUAL = 'OP_0NOTEQUAL';

    const OP_ADD = 'OP_ADD';
    const OP_SUB = 'OP_SUB';
    const OP_MUL = 'OP_MUL';
    const OP_DIV = 'OP_DIV';
    const OP_MOD = 'OP_MOD';
    const OP_LSHIFT = 'OP_LSHIFT';
    const OP_RSHIFT = 'OP_RSHIFT';

    const OP_BOOLAND = 'OP_BOOLAND';
    const OP_BOOLOR = 'OP_BOOLOR';
    const OP_NUMEQUAL = 'OP_NUMEQUAL';
    const OP_NUMEQUALVERIFY = 'OP_NUMEQUALVERIFY';
    const OP_NUMNOTEQUAL = 'OP_NUMNOTEQUAL';
    const OP_LESSTHAN = 'OP_LESSTHAN';
    const OP_GREATERTHAN = 'OP_GREATERTHAN';
    const OP_LESSTHANOREQUAL = 'OP_LESSTHANOREQUAL';
    const OP_GREATERTHANOREQUAL = 'OP_GREATERTHANOREQUAL';
    const OP_MIN = 'OP_MIN';
    const OP_MAX = 'OP_MAX';

    const OP_WITHIN = 'OP_WITHIN';

    // crypto
    const OP_RIPEMD160 = 'OP_RIPEMD160';
    const OP_SHA1 = 'OP_SHA1';
    const OP_SHA256 = 'OP_SHA256';
    const OP_HASH160 = 'OP_HASH160';
    const OP_HASH256 = 'OP_HASH256';
    const OP_CODESEPARATOR = 'OP_CODESEPARATOR';
    const OP_CHECKSIG = 'OP_CHECKSIG';
    const OP_CHECKSIGVERIFY = 'OP_CHECKSIGVERIFY';
    const OP_CHECKMULTISIG = 'OP_CHECKMULTISIG';
    const OP_CHECKMULTISIGVERIFY = 'OP_CHECKMULTISIGVERIFY';

    // expansion
    const OP_NOP1 = 'OP_NOP1';
    const OP_NOP2 = 'OP_NOP2';
    const OP_NOP3 = 'OP_NOP3';
    const OP_NOP4 = 'OP_NOP4';
    const OP_NOP5 = 'OP_NOP5';
    const OP_NOP6 = 'OP_NOP6';
    const OP_NOP7 = 'OP_NOP7';
    const OP_NOP8 = 'OP_NOP8';
    const OP_NOP9 = 'OP_NOP9';
    const OP_NOP10 = 'OP_NOP10';

    // template matching params
    const OP_PUBKEYHASH = 'OP_PUBKEYHASH';
    const OP_PUBKEY = 'OP_PUBKEY';
    const OP_INVALIDOPCODE = 'OP_INVALIDOPCODE';


        private $opCodes = array(self::OP_FALSE     => 0,
                        self::OP_0         => 0,
                        self::OP_PUSHDATA1 => 76,
                        self::OP_PUSHDATA2 => 77,
                        self::OP_PUSHDATA4 => 78,
                        self::OP_1NEGATE   => 79,
                        self::OP_RESERVED  => 80,
                        self::OP_TRUE      => 81,
                        self::OP_1         => 81,
                        self::OP_2         => 82,
                        self::OP_3         => 83,
                        self::OP_4         => 84,
                        self::OP_5         => 85,
                        self::OP_6         => 86,
                        self::OP_7         => 87,
                        self::OP_8         => 88,
                        self::OP_9         => 89,
                        self::OP_10        => 90,
                        self::OP_11        => 91,
                        self::OP_12        => 92,
                        self::OP_13        => 93,
                        self::OP_14        => 94,
                        self::OP_15        => 95,
                        self::OP_16        => 96,

                        // control
                        self::OP_NOP       => 97,
                        self::OP_VER       => 98,
                        self::OP_IF        => 99,
                        self::OP_NOTIF     => 100,
                        self::OP_VERIF     => 101,
                        self::OP_VERNOTIF  => 102,
                        self::OP_ELSE      => 103,
                        self::OP_ENDIF     => 104,
                        self::OP_VERIFY    => 105,
                        self::OP_RETURN    => 106,

                        // stack ops
                        self::OP_TOALTSTACK   => 107,
                        self::OP_FROMALTSTACK => 108,
                        self::OP_2DROP        => 109,
                        self::OP_2DUP         => 110,
                        self::OP_3DUP         => 111,
                        self::OP_2OVER        => 112,
                        self::OP_2ROT         => 113,
                        self::OP_2SWAP        => 114,
                        self::OP_IFDUP        => 115,
                        self::OP_DEPTH        => 116,
                        self::OP_DROP         => 117,
                        self::OP_DUP          => 118,
                        self::OP_NIP          => 119,
                        self::OP_OVER         => 120,
                        self::OP_PICK         => 121,
                        self::OP_ROLL         => 122,
                        self::OP_ROT          => 123,
                        self::OP_SWAP         => 124,
                        self::OP_TUCK         => 125,

                        // splice ops
                        self::OP_CAT          => 126,
                        self::OP_SUBSTR       => 127,
                        self::OP_LEFT         => 128,
                        self::OP_RIGHT        => 129,
                        self::OP_SIZE         => 130,

                        // bit logic
                        self::OP_INVERT       => 131,
                        self::OP_AND          => 132,
                        self::OP_OR           => 133,
                        self::OP_XOR          => 134,
                        self::OP_EQUAL        => 135,
                        self::OP_EQUALVERIFY  => 136,
                        self::OP_RESERVED1    => 137,
                        self::OP_RESERVED2    => 138,

                        // numeric
                        self::OP_1ADD         => 139,
                        self::OP_1SUB         => 140,
                        self::OP_2MUL         => 141,
                        self::OP_2DIV         => 142,
                        self::OP_NEGATE       => 143,
                        self::OP_ABS          => 144,
                        self::OP_NOT          => 145,
                        self::OP_0NOTEQUAL    => 146,

                        self::OP_ADD          => 147,
                        self::OP_SUB          => 148,
                        self::OP_MUL          => 149,
                        self::OP_DIV          => 150,
                        self::OP_MOD          => 151,
                        self::OP_LSHIFT       => 152,
                        self::OP_RSHIFT       => 153,

                        self::OP_BOOLAND             => 154,
                        self::OP_BOOLOR              => 155,
                        self::OP_NUMEQUAL            => 156,
                        self::OP_NUMEQUALVERIFY      => 157,
                        self::OP_NUMNOTEQUAL         => 158,
                        self::OP_LESSTHAN            => 159,
                        self::OP_GREATERTHAN         => 160,
                        self::OP_LESSTHANOREQUAL     => 161,
                        self::OP_GREATERTHANOREQUAL  => 162,
                        self::OP_MIN                 => 163,
                        self::OP_MAX                 => 164,

                        self::OP_WITHIN              => 165,

                        // crypto
                        self::OP_RIPEMD160           => 166,
                        self::OP_SHA1                => 167,
                        self::OP_SHA256              => 168,
                        self::OP_HASH160             => 169,
                        self::OP_HASH256             => 170,
                        self::OP_CODESEPARATOR       => 171,
                        self::OP_CHECKSIG            => 172,
                        self::OP_CHECKSIGVERIFY      => 173,
                        self::OP_CHECKMULTISIG       => 174,
                        self::OP_CHECKMULTISIGVERIFY => 175,

                        // expansion
                        self::OP_NOP1  => 176,
                        self::OP_NOP2  => 177,
                        self::OP_NOP3  => 178,
                        self::OP_NOP4  => 179,
                        self::OP_NOP5  => 180,
                        self::OP_NOP6  => 181,
                        self::OP_NOP7  => 182,
                        self::OP_NOP8  => 183,
                        self::OP_NOP9  => 184,
                        self::OP_NOP10 => 185,

                        // template matching params
                        self::OP_PUBKEYHASH    => 253,
                        self::OP_PUBKEY        => 254,
                        self::OP_INVALIDOPCODE =>255);

    public function getOpcodes()
    {
        return $this->opCodes;
    }

    public function getRopCodes()
    {
        $rOpCodes = array();

        foreach($this->opCodes as $key => $codeNbr)
        {
            $rOpCodes[$codeNbr] = $key;
        }

        return $rOpCodes;
    }
}
