$(function(){$("header .menuBtn").on("click",function(){$("#modalMenu").show()}),$(".btn-close")
    .on("click",function(){$("#modalMenu").hide(),$("#modalMenu").css("display","none")})}),
    $(function(){$(".pagetop").click(function(){return $("html,body").animate({scrollTop:0},300),!1})});
var apiExaminationInit=function(e,n){return $.ajax({type:"GET",url:"/aps/api/examination/"+e,contentType:"applicat" +
        "ion/json",dataType:"json",data:n})};
function executeKento(i){if($("#"+i+" .keepBtn").hasClass("disabled")) return!1;$("#"+i+" .keepBtn")
    .addClass("disabled"),$.cookie("actualExamCnt",parseInt($.cookie("actualExamCnt"))+1),
    apiExaminationInit("count",{}).done(function(e,n,t){if(20<=parseInt(e))
    {if(1!=confirm("「キープリスト」の\n上限を超えました。\n新たにキープする場合、\n古い情報から削除されます。\n\nキープしますか？"))
        return!1;$("#"+i+" .keepBtn").css("display","none"),$("#"+i+" .keepzumiBtn").css("display","block"),
        apiExaminationInit("keep",{examinationKeep:i}).done(function(e,n,t){$("#"+i+".btnGroup")
            .append('<div id="kentoalert"><p class="text">キープしました</p></div>'),$("#"+i+" #kentoalert")
            .css("display","block"),$("#"+i+" #kentoalert").fadeOut(2500),setHeaderExamCnt()})
            .fail(function(e,n,t){})}else $("#"+i+" .keepBtn").css("display","none"),$("#"+i+" .keepzumiBtn")
            .css("display","block"),apiExaminationInit("keep",{examinationKeep:i})
            .done(function(e,n,t){$("#"+i+".btnGroup")
                .append('<div id="kentoalert"><p class="text">キープしました</p></div>'),$("#"+i+" #kentoalert")
                .css("display","block"),$("#"+i+" #kentoalert").fadeOut(2500),setHeaderExamCnt()})
            .fail(function(e,n,t){})}).fail(function(e,n,t){}).always(function(e){$("#"+i+" .keepBtn")
        .removeClass("disabled")})}
function getExamCount(){apiExaminationInit("count",{})
    .done(function(e,n,t){return e}).fail(function(e,n,t){})}function deleteId(e){
    return confirm("削除しますか？")&&($.cookie("actualExamCnt",parseInt($.cookie("actualExamCnt"))-1),-1!=
    window.location.href.indexOf("ExaminationList")&&ga("send","event","Detail","Keep_out",e),
        $.ajax({url:"/aps/api/examination/keep/delete",contentType:"application/json",dataType:"json",
            data:{examinationKeep:e},success:function(e){return location.reload(),!0}})),!1}
function deleteAll(e){return!!confirm("求人情報を全件削除しますか？")&&($.cookie("actualExamCnt",0),
    "ExaminationList"!=e?($.cookie(e,"",{expires:30,path:"/"}),location.reload(),!0):(
        $.ajax({url:"/aps/api/examination/keep/deleteall",contentType:"application/json",dataType:"json",
            data:{},success:function(e){return location.reload(),!0}}),!1))}function loadingview(){$("#nowloading")
    .remove();var e=$('<div id="nowloading"><img src="/aps/assets/spn/img/uniq/map/mapsearch/map_loading.gif"><' +
    '/div>');e.css({width:$(window).width(),height:$(window).height(),position:"fixed",top:"0px",left:"0px",
    backgroundColor:"rgba(255,255,255,0.6)",display:"-webkit-box",boxAlign:"center",boxPack:"center",zIndex:"1000"}),
    $("body").append(e)}function checkChangeMode(e){try{var n=window.sessionStorage.getItem("top_aps"),
    t=window.sessionStorage.getItem("top_ac_aps")}catch(e){}if(""==n)try{window.sessionStorage.clear()}
catch(e){}else if(""==t||t!=e)try{window.sessionStorage.clear()}catch(e){}try{window.sessionStorage.setItem
("top_aps","1"),window.sessionStorage.setItem("top_ac_aps",e)}catch(e){}}function mail(e,n){idnum+=1,e=(e=e
    .replace(/\@/g,".")).replace(/\%/,"@"),""==n&&(n=e),"nolink"==n?$("#mail").html("【"+e+"】"):(mailid[idnum]=e,
    $("#mail").html("&rArr; <a href=\"javascript:mailto('"+idnum+"');\">"+n+"</a>"))}
function mailto(e){location.href="mailto:"+mailid[e]}function changeImgSize(e,n){var t,i,a=e,o=$(e).closest(n),
    s=$(a).width(),r=$(a).height(),c=$(o).width(),l=$(o).height(),d=s*l/r,u=r*c/s,p=s*l/r,f=r*c/s;
    (i=c<=s?!(l<r)||r<s?(t=c,u):(t=d,l):l<=r?c<s?(t=c,u):(t=d,l):l<c?r<s?(t=c,u):(t=d,l):r<s?(t=d,l):(t=c,u))
    <t?l<=i?(i=l,t=p):(t=c,i=f):t<i&&(l<i?(t=c,i=f):(i=l,t=p)),$(a).attr({width:t}),$(a).attr({height:i}),$(a)
        .css({"margin-top":(l-i)/2}),$(o).css("text-align","center"),$(a).fadeIn(250)}
$(function(){getJobCount=function(e){$.ajax({type:"GET",url:"/aps/api/job/count"+e,timeout:1e4,cache:!1,data:{},
    dataType:"json",context:e}).done(function(e,n,t){var i=this.slice(1),a=i.split("&"),o="",s=[];
        if($.each(a,function(e,n){var t=n.split("="),i=t[0];"region_id"==i&&(o=t[1]),"district_id"==i&&(s=t[1]
            .split(","))}),o&&s.length)if("infinite"==othermedia.judgeHelloworkFunctype(o,s,i)){var r=[];$.each(a,
            function(e,n){var t=n.split("="),i=t[0],a=t[1].split(",");$.each(a,function(e,n){r.push(i+"="+n)})}),
            othermedia.exeHelloworknumAjax(e,r)}else $("#jobCnt").text(addComma(e));else $("#jobCnt")
            .text(addComma(e))}).fail(function(e,n,t){$("#jobCnt").text("-")}).always(function(e,n,t){})},
    addComma=function(e){var n=String(e),t=n.replace(/^(-?\d+)(\d{3})/,"$1,$2");return t!==n?addComma(t):t}});
    // mailid=new Array,idnum=0;var MemberControl={isLogin:function()
    // {$.ajax({async:!1,url:"/member/api/member_info.htm",dataType:"json",data:{task:"getLoginStatus"}
    //     ,success:function(e){MemberControl._changeBt(e.loginStatus)}})},actLogout:function(){
    //     confirm("ログアウトしますか？")&&$.ajax({url:"/member/api/logout.htm",dataType:"json",data:{task:"logout"},
    //         success:function(e){MemberControl._changeBt(e.loginStatus)}})},_changeBt:function(e)
    // {1==e?($(".loginBefore").addClass("imphide"),$(".loginAfter").removeClass("imphide")):(
    //     $(".loginAfter").addClass("imphide"),$(".loginBefore").removeClass("imphide"))},
    // openEntryList_notlogin:function(){if(!confirm("応募履歴はログイン状態の時のみご利用いただけます。\nログインしますか？"))
    //     return!1;location.href=vp.domain_ssl+"/member/top.htm"},openEntryList:
    //     function(){window.open(vp.domain_ssl+"/member/history/top.htm","rireki",
    //         "width=800,height=750,scrollbars=yes,resizable=yes")}};
    // function telLog(e){var n="id="+e+"&scd=002",t=(-1!=location.href.indexOf("https://www.e-aidem.com")?"https://job-gear.jp/":"https://stg.job-gear.jp/")+"jsp/pt.jsp";jQuery.ajax({type:"POST",url:t,async:!1,dataType:"jsonp",data:n,timeout:5e3,cache:!1})}function getExamCount(){var n=new jQuery.Deferred;return $.ajax({type:"GET",url:"/aps/api/examination/count",contentType:"application/json",dataType:"json",data:{}}).done(function(e){n.resolve(e)}).fail(function(e){n.reject()}),n.promise()}function setHeaderExamCnt(){var n=new jQuery.Deferred;return getExamCount().done(function(e){if(null==$("#pageTop .examBtn.square .examCnt")||0==$("#pageTop .examBtn.square .examCnt").length)return!1;$("#pageTop .examBtn.square .examCnt").text(e),n.resolve(e)}).fail(function(e){n.reject()}),n.promise()}function getOtherConditionKeys(){var e=[],n=location.search.match(/other_condition=(.*?)(&|$)/);if(n){var t=decodeURIComponent(n[1]);if(t)for(var i=t.split("&"),a=i.length,o=0;o<a;o++)if(""!=i[o]){var s=i[o].match(/(.*)=/);e.push(s[1])}}return e}function existOtherValue(e,n){for(var t=n.length,i=0;i<t;i++){var a=e.indexOf(n[i]);-1!==a&&e.splice(a,1)}return 0<e.length}function changeCheckboxOnClickList(){$(".searchCont li").on("click",function(e){var n=$(e.target);"LI"==n.prop("nodeName")&&n.find("input").click()})}function getBrowsinghistoryCount(){var n=new jQuery.Deferred;return $.ajax({type:"GET",url:"/aps/api/browsinghistory/count",contentType:"application/json",dataType:"json",data:{},success:function(e){n.resolve(e)},error:function(){n.reject()}}),n.promise()}function setAidemid(){if(void 0===jQuery.cookie("aidemid")){var e=new Date;e+=Math.random();var n=md5(e).substring(0,10);jQuery.cookie("aidemid",n,{expires:730,path:"/"})}}