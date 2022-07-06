<?
//基本ライブラリ群
//　09/12/11　ver 1.00　基本動作作成（takeoka）

//refrain_print(表示する配列(array))
//  配列を分解し、画面上に出力する。

//array_divider(分解する配列(array), 再帰数(int)・内部管理用のため指定しない)
//  配列を分解し、文字列として返す。

//data2table(分解する配列(array(ID=>array(項目名=>値))))
//  配列を分解し、テーブルの型に整形して返す。

//getImageTypeName(バイナリデータ(binary))
//  バイナリデータが画像形式ならその拡張子を返す。一致しない場合空文字列を返す。

//strposLast(文章(str), 検索文字列(str), 再帰数(int)・内部管理用のため指定しない)
//  文章の中で検索文字列が一番最後に現れる位置を返す。

//array_key_convert(変換する配列(arrya))
//  配列の添え字を数字に変更したものを返す。

//getTimeHis()
//  現在の時間を「時：分：秒」の形で文字列として返す。

//getDateTime()
//  現在の時間を「年-月-日 時：分：秒」の形で文字列として返す。

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
                $tmp = getImageTypeName($value);
                if ($tmp != "") {
                    $value = "*." . $tmp . " file";
                }
                $result .= "[" . htmlspecialchars($key) . "] = " . htmlspecialchars($value) . "<br>\n";
            }
        }
    } else {
        $result = htmlspecialchars($array) . "<br>\n";
    }
    return $result;
}

function data2table($dispArray) {
    $result = "<table border=1>\n  <tr>\n";
    $result .= "<td>データがありません。</td>\n";
    $result .= "  </tr>\n";
    $result .= "</table>\n";
    if (is_array($dispArray)) {
        $display2 = "";
        foreach ($dispArray As $id => $dataSet) {
            $display2 .= "  <tr>\n";
            if (is_array($dataSet)) {
                foreach ($dataSet As $key => $value) {
                    $displayHeader[$key] = $key;
                    $tmp = getImageTypeName($value);
                    if ($tmp != "") {
                        $value = "*." . $tmp . " file";
                    }
                    $display2 .= "    <td>" . $value . "</td>\n";
                }
            } else {
                break;
            }
            $display2 .= "  </tr>\n";
        }
        if (is_array($displayHeader)) {
            $result = "<table border=1>\n  <tr>\n";
            foreach ($displayHeader As $key => $value) {
                    $result .= "    <th>" . $value . "</th>\n";
            }
            $result .= "  </tr>\n";
            $result .= $display2 . "</table>\n";
        }
    }
    return $result;
}

function getImageTypeName($contents) {
    $head = substr($contents, 0, 8);
    $result = "";
    if ($head === "\x89PNG\x0d\x0a\x1a\x0a") {
        $result = "png";
    } else if (substr($head, 0, 2) === "\xff\xd8") {
        $result = "jpg";
    } else if (preg_match('/^GIF8[79]a/', $head)) {
        $result = "gif";
    }
    return $result;
}

function strposLast($text, $search, $start = 0) {
    $position = strpos($text, $search, $start);
    if (is_numeric($position)) {
        $result = strposLast($text, $search, $position + 1);
        if ($result == 0) {
            $result = $position;
        }
    } else {
        $result = 0;
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