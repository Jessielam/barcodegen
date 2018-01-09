<?php
/**
 * @author Ryan Weber <ryan@picoprime.com>
 */

namespace PicoPrime\BarcodeGen;

class Code128 implements BarcodeString
{
    /**
     * Generate barcode in Code128 family format. This is called
     * differently to generate Code128/Code128b and Code128a.
     *
     * @param $text
     * @param $chksum
     * @param array $codeArray
     * @param string $prefix
     * @param string $suffix
     * @return string
     */
    protected function getCode128String($text, $chksum, array $codeArray, $prefix = '', $suffix = '')
    {
        $codeString = '';
        $codeKeys = array_keys($codeArray);
        $codeValues = array_flip($codeKeys);

        for ($X = 1; $X <= strlen($text); $X++) {
            $activeKey = substr($text, ($X - 1), 1);
            $codeString .= $codeArray[$activeKey];
            $chksum = ($chksum + ($codeValues[$activeKey] * $X));
        }

        $codeString .= $codeArray[$codeKeys[($chksum - (intval($chksum / 103) * 103))]];

        return $prefix . $codeString . $suffix;
    }

    /**
     * Generate barcode in Code128 standard.
     *
     * @param string $text
     * @return string
     */
    public function generateString($text)
    {
        $codeArray = [
            " " => "212222",
            "!" => "222122",
            "\"" => "222221",
            "#" => "121223",
            "$" => "121322",
            "%" => "131222",
            "&" => "122213",
            "'" => "122312",
            "(" => "132212",
            ")" => "221213",
            "*" => "221312",
            "+" => "231212",
            "," => "112232",
            "-" => "122132",
            "." => "122231",
            "/" => "113222",
            "0" => "123122",
            "1" => "123221",
            "2" => "223211",
            "3" => "221132",
            "4" => "221231",
            "5" => "213212",
            "6" => "223112",
            "7" => "312131",
            "8" => "311222",
            "9" => "321122",
            ":" => "321221",
            ";" => "312212",
            "<" => "322112",
            "=" => "322211",
            ">" => "212123",
            "?" => "212321",
            "@" => "232121",
            "A" => "111323",
            "B" => "131123",
            "C" => "131321",
            "D" => "112313",
            "E" => "132113",
            "F" => "132311",
            "G" => "211313",
            "H" => "231113",
            "I" => "231311",
            "J" => "112133",
            "K" => "112331",
            "L" => "132131",
            "M" => "113123",
            "N" => "113321",
            "O" => "133121",
            "P" => "313121",
            "Q" => "211331",
            "R" => "231131",
            "S" => "213113",
            "T" => "213311",
            "U" => "213131",
            "V" => "311123",
            "W" => "311321",
            "X" => "331121",
            "Y" => "312113",
            "Z" => "312311",
            "[" => "332111",
            "\\" => "314111",
            "]" => "221411",
            "^" => "431111",
            "_" => "111224",
            "\`" => "111422",
            "a" => "121124",
            "b" => "121421",
            "c" => "141122",
            "d" => "141221",
            "e" => "112214",
            "f" => "112412",
            "g" => "122114",
            "h" => "122411",
            "i" => "142112",
            "j" => "142211",
            "k" => "241211",
            "l" => "221114",
            "m" => "413111",
            "n" => "241112",
            "o" => "134111",
            "p" => "111242",
            "q" => "121142",
            "r" => "121241",
            "s" => "114212",
            "t" => "124112",
            "u" => "124211",
            "v" => "411212",
            "w" => "421112",
            "x" => "421211",
            "y" => "212141",
            "z" => "214121",
            "{" => "412121",
            "|" => "111143",
            "}" => "111341",
            "~" => "131141",
            "DEL" => "114113",
            "FNC 3" => "114311",
            "FNC 2" => "411113",
            "SHIFT" => "411311",
            "CODE C" => "113141",
            "FNC 4" => "114131",
            "CODE A" => "311141",
            "FNC 1" => "411131",
            "Start A" => "211412",
            "Start B" => "211214",
            "Start C" => "211232",
            "Stop" => "2331112"
        ];

        return $this->getCode128String($text, 104, $codeArray, '211214', '2331112');
    }
}
