<?
//基本ライブラリ群
//refrain_print(表示する配列(array))
//  配列を分解し、画面上に出力する。

//array_divider(分解する配列(arrya), 再帰数(int)・内部管理用のため指定しない)
//  配列を分解し、文字列として返す。

//array_key_convert(変換する配列(arrya))
//  配列の添え字を数字に変更したものを返す。

//getTimeHis()
//  現在の時間を「時：分：秒」の形で文字列として返す。

function refrain_print($array) {
    echo array_divider($array);
}

function array_divider($array, $loop = 0) {
    $result = "";
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            for ($i = 0; $i < $loop; $i++) {
                $result .= "__";
            }
            if (is_array($value)) {
                $result .= "[" . htmlspecialchars($key) . "] (<br>\n";
                $loop++;
                $result .= array_divider($value,$loop);
                $loop--;
                for ($i = 0; $i < $loop; $i++) {
                    $result .= "__";
                }
                $result .= ") <br>\n";
            } else {
                $result .= "[" . htmlspecialchars($key) . "] = " . htmlspecialchars($value) . "<br>\n";
            }
        }
    } else {
        $result = htmlspecialchars($array) . "<br>\n";
    }
    return $result;
}

function array_key_convert($array) {
    $result = "";
    if (is_array($array)) {
        $i = 0;
        foreach ($array as $key => $value) {
            $result[$i] = $value;
            $i++;
        }
    } else {
        $result[0] = $array;
    }
    return $result;
}

function getTimeHis() {
    return date("H:i:s", (time() - date("Z")) + 9 * 3600);
}

function getDateTime() {
    return date("Y-m-d H:i:s", time());
}
?>