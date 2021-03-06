<?php

namespace App\Helpers;

class TextHelper
{
    /**
     * @param $text
     * @return mixed
     */
    public static function ru2Lat($text)
    {
        $cyr = [
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
        ];

        $lat = [
            'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
            'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
            'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'IA',
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
            'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
            'h', 'c', 'ch', 'sh', 'sh', '`', 'y', '`', 'e', 'iu', 'ia'
        ];

        $text = str_replace($cyr, $lat, $text);
        $text = str_replace("_"," ",$text);

        return $text;
    }

    /**
     * @param $text
     * @return string
     */
    public static function formatMarkNames($text)
    {
        $text = str_replace("_"," ",$text);
        return mb_strlen($text, 'UTF-8') > 3 ? self::ucfirst_utf8(mb_strtolower($text)) : $text;
    }

    public static function ucfirst_utf8($str)
    {
        return mb_substr(mb_strtoupper($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str)-1, 'utf-8');
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function Lat2ru($string)
    {
        $cyr = [
            "Щ", "Ш", "Ч","Ц", "Ю", "Я", "Ж","А","Б","В",
            "Г","Д","Е","Ё","З","И","Й","К","Л","М","Н",
            "О","П","Р","С","Т","У","Ф","Х","Ь","Ы","Ъ",
            "Э","Є", "Ї","І","В",
            "щ", "ш", "ч","ц", "ю", "я", "ж","а","б","в",
            "г","д","е","ё","з","и","й","к","л","м","н",
            "о","п","р","с","т","у","ф","х","ь","ы","ъ",
            "э","є", "ї","і","в"
        ];

        $lat = [
            "Shch","Sh","Ch","C","Yu","Ya","J","A","B","V",
            "G","D","E","E","Z","I","y","K","L","M","N",
            "O","P","R","S","T","U","F","H","",
            "Y","" ,"E","E","Yi","I","W",
            "shch","sh","ch","c","Yu","Ya","j","a","b","v",
            "g","d","e","e","z","i","y","k","l","m","n",
            "o","p","r","s","t","u","f","h",
            "", "y","" ,"e","e","yi","i","w"
        ];

        $string = str_replace($lat,$cyr,$string);
        $string = str_replace("_"," ",$string);
        return $string;
    }

    /**
     * @param $text
     * @return false|mixed|string
     */
    public static function slug($text)
    {
        $tr = [
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ё" => "E",
            "Ж" => "J",
            "З" => "Z",
            "И" => "I",
            "Й" => "Y",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "H",
            "Ц" => "TS",
            "Ч" => "CH",
            "Ш" => "SH",
            "Щ" => "SCH",
            "Ъ" => "",
            "Ы" => "YI",
            "Ь" => "",
            "Э" => "E",
            "Ю" => "YU",
            "Я" => "YA",
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "e",
            "ж" => "j",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "h",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ъ" => "y",
            "ы" => "yi",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "«" => "",
            "»" => "",
            "№" => "",
            "Ӏ" => "",
            "’" => "",
            "ˮ" => "",
            "_" => "-",
            "'" => "",
            "`" => "",
            "^" => "",
            "\." => "",
            "," => "",
            ":" => "",
            "<" => "",
            ">" => "",
            "!" => ""
        ];

        foreach ($tr as $ru => $en) {
            $text = mb_eregi_replace($ru, $en, $text);
        }

        $text = mb_strtolower($text);
        $text = str_replace(' ', '-', $text);
        return $text;
    }
}

