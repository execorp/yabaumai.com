function ins(a,b){
    fckins(a)
}
function fckins(a){
    if (fckareacheck()){
        var oEditor=FCKeditorAPI.GetInstance(g_area_name)
        oEditor.InsertHtml (a)
    }
}
