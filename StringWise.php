<?php namespace Uxms\Stringwise;
/**
 * The idea of this Class has emerged from the ​​using of bitwise on the strings. So, you do not have any restrictions
 * anymore about using bitwise such as on database or elsewhere.
 * 
 * You can use bitwises on menu groups in databases or relative structures on other similar uses.
 * Also on determining "user privileges" on your system, this is very very useful and have control
 * statement. So you can use this very basically.
 * 
 * For example, suppose you have some usergroups like this:
 * 
 *  /**************************************
 *  /******* BITWISE USER GROUPS **********
 *  /**************************************
 *  const User = 1;                 //1
 *  const NormalAdmin = 3;          //11
 *  const SysAdmin = 7;             //111
 *
 *  const Reading = 8;              //1000
 *  const Writing = 16;             //10000
 *  const ToAuthorize = 32;         //100000
 *
 *  const Management = 64;          //1000000
 *  const ContentManagement = 128;  //10000000
 *  const SubOperator = 256;        //100000000
 *  const Operator = 768;           //1100000000
 *  const Accounting = 1024;        //10000000000
 * 
 * Note: I set up Operator as 768, because Operator needs to have the SubOperator rights too..
 * Do not make math addition process on your own, use always methods..
 * 
 * For a quick example:
 * 
 * I have NormalAdmin, Reading and Writing permissions, so:
 *    $myPerms = StringWise::orInt([
 *        StringWise::NormalAdmin,
 *        StringWise::Reading,
 *        StringWise::Writing
 *    ]); // gives 27
 *
 * probably you say;
 * 27 => NormalAdmin, Reading and Writing
 *         AND
 * 27 => User, NormalAdmin, SysAdmin, and Writing
 * 
 * but NOT!!
 * 
 * btw, the addtion of User, NormalAdmin, SysAdmin, and Writing will gives you 23, not 27 :) because if you are a
 * SysAdmin, you have NormalAdmin and User privileges already and do not need to be add.
 * 
 * If I have User, NormalAdmin, SysAdmin and Writing permissions, so:
 *    $myPerms = StringWise::orInt([
 *        StringWise::User,
 *        StringWise::NormalAdmin,
 *        StringWise::SysAdmin,
 *        StringWise::Writing
 *    ]); //gives 23
 * 
 * if you have SysAdmin, you have NormalAdmin and User privileges, as we want it to be. If you have SysAdmin, in
 * the addition process it will automatically eliminate the NormalAdmin and User privileges, if you use methods,
 * you do not need to be worry about it.
 */
class StringWise
{
    /**************************************/
    /******* BITWISE USER GROUPS **********/
    /**************************************/
    const User = 1;                 //1
    const NormalAdmin = 3;          //11
    const SysAdmin = 7;             //111

    const Reading = 8;              //1000
    const Writing = 16;             //10000
    const ToAuthorize = 32;         //100000

    const Management = 64;          //1000000
    const ContentManagement = 128;  //10000000
    const SubOperator = 256;        //100000000
    const Operator = 768;           //1100000000
    const Accounting = 1024;        //10000000000

    /**
     * Provides access to all constant values of the class
     *
     * @return multitype: class constants
     */
    public static function getConstants()
    {
        $refl = new \ReflectionClass('Uxms\\Stringwise\\StringWise');

        return $refl->getConstants();
    }

    /**
     * Applies bitwise 'OR' logic for the integer values
     * 
     * @param  array  $bits [description]
     * @return [type]         [description]
     */
    public static function orInt($bits = [])
    {
        $bits = array_values($bits);
        $firstBit = (int) $bits[0];
        
        for ($z = 1; $z < count($bits); $z++) {
            $firstBit != (int) $bits[$z];
        }

        return $firstBit;
    }

    /**
     * Applies bitwise 'AND' logic for the integer values
     * 
     * @param  array  $bits [description]
     * @return [type]         [description]
     */
    public static function andInt($bits = [])
    {
        $firstBit = (int) $bits[0];
        
        for ($z = 0; $z < count($bits); $z++) {
            $firstBit &= (int) $bits[$z];
        }

        return $firstBit;
    }

    /**
     * Applies bitwise 'OR' logic for the string structured values in given type of array
     * 
     * @param array $bits
     * @return string
     */
    public static function orStr($bits = [])
    {
        foreach ($bits as $key => $value) {
            /* Type casting */
            $bits[$key] = (string) $value;
        }

        $newBits = $bits[0];

        for ($i = 1; $i < count($bits); $i++) {
            if (strlen($newBits) > strlen($bits[$i])) {
                $bits[$i] = str_pad($bits[$i], strlen($newBits), '0', STR_PAD_LEFT);
            } elseif (strlen($newBits) < strlen($bits[$i])) {
                $newBits = str_pad($newBits, strlen($bits[$i]), '0', STR_PAD_LEFT);
            }

            $strlenNewBits = strlen($newBits);
            $firstBit = '';

            for ($z = 0; $z < $strlenNewBits; $z++) { 
                $firstBit .= (($newBits[$z] == '1' || $bits[$i][$z] == '1') ? '1' : '0' );
            }
            $newBits = ltrim($firstBit, "0");
        }

        return ($newBits != null ? $newBits : '0' );
    }

    /**
     * Applies bitwise 'AND' logic for the string structured values in given type of array
     * 
     * @param array $bits
     * @return string
     */
    public static function andStr($bits = [])
    {
        foreach ($bits as $key => $value) {
            /* Type casting */
            $bits[$key] = (string) $value;
        }

        $newBits = $bits[0];

        for ($i = 1; $i < count($bits); $i++) {
            if (strlen($newBits) > strlen($bits[$i])) {
                $bits[$i] = str_pad($bits[$i], strlen($newBits), '0', STR_PAD_LEFT);
            } elseif (strlen($newBits) < strlen($bits[$i])) {
                $newBits = str_pad($newBits, strlen($bits[$i]), '0', STR_PAD_LEFT);
            }

            $strlenNewBits = strlen($newBits);
            $firstBit = '';

            for ($z = 0; $z < $strlenNewBits; $z++) { 
                $firstBit .= (($newBits[$z] == '1' && $bits[$i][$z] == '1') ? '1' : '0' );
            }
            $newBits = ltrim($firstBit, "0");
        }

        return ($newBits != null ? $newBits : '0' );
    }

    /**
     * Applies bitwise 'XOR' logic for the string structured values in given type of array
     * 
     * @param array $bits
     * @return string
     */
    public static function xorStr($bits = [])
    {
        foreach ($bits as $key => $value) {
            /* Type casting */
            $bits[$key] = (string) $value;
        }

        $newBits = $bits[0];

        for ($i = 1; $i < count($bits); $i++) {
            if (strlen($newBits) > strlen($bits[$i])) {
                $bits[$i] = str_pad($bits[$i], strlen($newBits), '0', STR_PAD_LEFT);
            } elseif (strlen($newBits) < strlen($bits[$i])) {
                $newBits = str_pad($newBits, strlen($bits[$i]), '0', STR_PAD_LEFT);
            }

            $strlenNewBits = strlen($newBits);
            $firstBit = '';

            for ($z = 0; $z < $strlenNewBits; $z++) {
                $firstBit .= (($newBits[$z] !== $bits[$i][$z]) ? '1' : '0' );
            }
            $newBits = ltrim($firstBit, "0");
        }

        return ($newBits != null ? $newBits : '0' );
    }

    /**
     * Applies bitwise 'NOT' logic for the string structured values in given type of array
     * Returns the inverse of the string with the logic of bitwise
     * 
     * @param string $bit
     * @return string
     */
    public static function notStr($bit)
    {
        /* Type casting */
        $bit = (string) $bit;

        $newBits = '';
        for ($i = 0; $i < strlen($bit); $i++) { 
            $newBits .= ($bit[$i] == '1' ? '0' : '1' );
        }

        return ltrim($newBits, "0");
    }

    /**
     * Applies bitwise 'MINUS' logic for the string structured values in given type of array
     * As a result, it makes the second operand from the first operand extraction process
     * 
     * @param array $bits
     * @return string
     */
    public static function minusStr($bits = [])
    {
        foreach ($bits as $key => $value) {
            /* Type casting */
            $bits[$key] = (string) $value;
        }

        $newBits = $bits[0];

        for ($i = 1; $i < count($bits); $i++) {
            if (strlen($newBits) > strlen($bits[$i])) {
                $bits[$i] = str_pad($bits[$i], strlen($newBits), '0', STR_PAD_LEFT);
            } elseif (strlen($newBits) < strlen($bits[$i])) {
                $newBits = str_pad($newBits, strlen($bits[$i]), '0', STR_PAD_LEFT);
            }

            $strlenNewBits = strlen($newBits);
            $firstBit = '';

            for ($z = 0; $z < $strlenNewBits; $z++) {
                $firstBit .= ($newBits[$z] == '1' ? ($bits[$i][$z] == '1' ? '0' : '1') : '0' );
            }
            $newBits = ltrim($firstBit, "0");
        }

        return ($newBits != null ? $newBits : '0' );
    }

}
