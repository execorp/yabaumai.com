//重要　事前にfckエディタの配置先を示すg_area_nameをグローバルで定義する事

//文字色指定用グローバル変数
var g_strcobject = "";

//動作　fckeditorの入力欄の背景を固定する
//注意　実行するたびに自分自身を再定義しています
//　　　色を直接指定しています。g_bgcobjectにも色が直接入ります。
function bgcolorone(colorstr) {
    g_bgcobject = colorstr;
    fckbackgroundchange(colorstr);
    // setViser.jsを事前に読み込む必要がある
    setViser( "fckareacheck()" , "bgcolorone(g_bgcobject)" , 300 );
}

function strcolorone(colorstr) {
    g_strcobject = colorstr;
    fckfontcolorchange(colorstr);
    // setViser.jsを事前に読み込む必要がある
    setViser( "fckareacheck()" , "strcolorone(g_strcobject)" , 300 );
}

//動作　FCKエディタのデフォルト文字色を指定した色で差し替える
//入力　色名(文字列)
function fckfontcolorchange(selectcolor) {
    // fck_common.jsを事前に読み込む必要がある
    if ( fckareacheck() ) {
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0].contentWindow.document.body.style.color=selectcolor;
    }
}
