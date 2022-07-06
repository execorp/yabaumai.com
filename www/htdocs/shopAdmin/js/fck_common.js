//重要　事前にfckエディタの配置先を示すg_area_nameをグローバルで定義する事

//動作　FCKエディタの表示部分がHTML編集モードか否かを調べる
//出力　真偽
function fckareacheck(){
    if (document.getElementById(g_area_name + '___Frame') && 
        "contentWindow" in document.getElementById(g_area_name + '___Frame') &&
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea')  &&
        document.getElementById(g_area_name + '___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0] && 
        "contentWindow" in document.getElementById(g_area_name+'___Frame').contentWindow.document.getElementById('xEditingArea').getElementsByTagName("IFRAME")[0]) {
        result = true;
    } else {
        result = false;
    }
    return result;
}
