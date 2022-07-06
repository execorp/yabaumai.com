<?
//��{���C�u�����Q
//�@09/12/11�@ver 1.00�@��{����쐬�itakeoka�j

//refrain_print(�\������z��(array))
//  �z��𕪉����A��ʏ�ɏo�͂���B

//array_divider(��������z��(array), �ċA��(int)�E�����Ǘ��p�̂��ߎw�肵�Ȃ�)
//  �z��𕪉����A������Ƃ��ĕԂ��B

//data2table(��������z��(array(ID=>array(���ږ�=>�l))))
//  �z��𕪉����A�e�[�u���̌^�ɐ��`���ĕԂ��B

//getImageTypeName(�o�C�i���f�[�^(binary))
//  �o�C�i���f�[�^���摜�`���Ȃ炻�̊g���q��Ԃ��B��v���Ȃ��ꍇ�󕶎����Ԃ��B

//strposLast(����(str), ����������(str), �ċA��(int)�E�����Ǘ��p�̂��ߎw�肵�Ȃ�)
//  ���͂̒��Ō��������񂪈�ԍŌ�Ɍ����ʒu��Ԃ��B

//array_key_convert(�ϊ�����z��(arrya))
//  �z��̓Y�����𐔎��ɕύX�������̂�Ԃ��B

//getTimeHis()
//  ���݂̎��Ԃ��u���F���F�b�v�̌`�ŕ�����Ƃ��ĕԂ��B

//getDateTime()
//  ���݂̎��Ԃ��u�N-��-�� ���F���F�b�v�̌`�ŕ�����Ƃ��ĕԂ��B

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
    $result .= "<td>�f�[�^������܂���B</td>\n";
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