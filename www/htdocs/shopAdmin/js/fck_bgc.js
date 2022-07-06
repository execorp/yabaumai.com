//重要　事前にfckエディタの配置先を示すg_area_nameをグローバルで定義する事

// セレクトリストの状態を受け取るグローバル変数
var g_bgcobject = "";
var g_oldvalue = "";

//動作　FCKエディタの表示部分の背景色を指定した色で差し替える
//入力　色名(文字列)
function fckbackgroundchange(selectcolor) {
    // fck_common.jsを事前に読み込む必要がある
    if ( fckareacheck() ) {
//        if (selectcolor != g_oldvalue) {
            if ( selectcolor.match(/[0-9a-f]{6}/) ) {
                document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.background='#'+selectcolor;
                if (document.getElementById('colorBox')) {
                    document.getElementById('colorBox').value = selectcolor;
                }
            } else {
                document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.background=selectcolor;
            }
//            g_oldvalue = selectcolor;
//        }
    }
}
//動作　FCKエディタの表示部分の背景色を状態に応じて差し替える
//入力　色のテキストボックス(オブジェクト)
function selectbgcolor(inputColor) {
    if (typeof(inputColor.value) == 'string') {
        selectcolor = inputColor.value;
    } else {
        selectcolor = inputColor.options[inputColor.selectedIndex].value;
    }
    fckbackgroundchange(selectcolor);
}
//動作　selectbgcolorの定期並列監視起動用関数
//入力　色のテキストボックス(オブジェクト)
//注意　実行するたびに自分自身を再定義しています
function bgcolorregularity(inputColor) {
    g_bgcobject = inputColor;
    selectbgcolor(g_bgcobject);
    // setViser.jsを事前に読み込む必要がある
    setViser( "fckareacheck()" , "bgcolorregularity(g_bgcobject)" , 300 );
}
