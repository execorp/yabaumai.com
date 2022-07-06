click_action = "";
click_action_type = "";

//jQueryの読み込み確認
if(typeof jQuery != "undefined"){ 
    // 読み込まれている
    $(document).ready(function(){
        // functionの確認
        if (typeof jQuery.cookie != "function") {
            jQuery.getScript("https://log.e-aidem.com/js/jquery.cookie.js", function() {
                if (typeof md5 != "function") {
                    jQuery.getScript("https://log.e-aidem.com/js/md5.min.js", function() {
                        setAidemCookie();
                    });
                } else {
                    setAidemCookie();
                }
            });
        } else {
            if (typeof md5 != "function") {
                jQuery.getScript("https://log.e-aidem.com/js/md5.min.js", function() { 
                    setAidemCookie();
                });
            } else {
                setAidemCookie();
            }
        }
    });
} else {
    // 読み込まれていない
    var jq = document.createElement('script');
    jq.type = "text/javascript";
    jq.src = 'https://log.e-aidem.com/js/jquery-1.8.3.min.js';
    document.body.appendChild(jq);
    jq.onload = function() {
        $(document).ready(function(){
            // functionの確認
           if (typeof jQuery.cookie != "function") {
                jQuery.getScript("https://log.e-aidem.com/js/jquery.cookie.js", function() {
                   if (typeof md5 != "function") {
                        jQuery.getScript("https://log.e-aidem.com/js/md5.min.js", function() {
                            setAidemCookie();
                       });
                   } else {
                        setAidemCookie();
                   }
               });
           } else {
               if (typeof md5 != "function") {
                    jQuery.getScript("https://log.e-aidem.com/js/md5.min.js", function() { 
                       setAidemCookie();
                   });
               } else {
                   setAidemCookie();
               }
           }
       });
    }
}


// データの設定
function setAidemCookie() {
    // aidemidの確認
    var aidemid = jQuery.cookie("aidemid");
    if(aidemid === undefined){
        // aidemidの発行
        setAidemid();
        //初回訪問　初回を設定
        jQuery.cookie("visid_new", "1");
    } else {
        //初回訪問　リピートを設定
        jQuery.cookie("visid_new", "0");
    }

    // max-ageが使用できないので、expiresで指定するための値取得
    var maxage = getExpires();

    // セッション内の時間、回数
    if (jQuery.cookie("parent_session")) {
        jQuery.cookie("first_session_flag", "1");
        if (jQuery.cookie("child_session")) {
        } else {
            var cookie_value = createDate(0, 0);

            jQuery.cookie("child_session", cookie_value, { expires: maxage });

            if (jQuery.cookie("first_time")) {
            } else {
                jQuery.cookie("first_time", cookie_value);
            }
        }

        var next_count = 1;
        if (jQuery.cookie("session_count")) {
            try {
                var session_count = parseInt(jQuery.cookie("session_count"));
                next_count = session_count + 1;
            } catch(e) {
                console.log('error session count.');
            }
        }
        jQuery.cookie("session_count", next_count);
    } else {
        var cookie_value = createDate(0, 0);

        jQuery.cookie("first_time", cookie_value);
        jQuery.cookie("parent_session", cookie_value);
        jQuery.cookie("child_session", cookie_value, { expires: maxage });
        jQuery.cookie("first_session_flag", "0");
        jQuery.cookie("session_count", "1");
    }

    //アクセス時刻
    var now_date  = new Date(Date.now());
    var cookie_value = createDate(1, now_date);
    jQuery.cookie("access_time", cookie_value);

    //セッション内　最終ページ
    if ('vp' in this) {
        jQuery.cookie("session_flag", vp.originUrl);
    } else if ('vcprms' in this) {
        jQuery.cookie("session_flag", vcprms.pageUrl);
    } else {
        jQuery.cookie("session_flag", '');
    }

    // アクセスログ送信
    send("0");
}

// クリックアクションの取得
function aca(ca, cat) {
    //クリックアクション
    click_action = ca;
    //クリックアクション
    click_action_type = cat;

    // アクセスログ送信
    send("1");
}

// アクセスログ送信準備
function send(ca_flg) {
    // ログインID
    var member_id = '';
    // レコメンドパラメータ
    var toaster_prms = {};

    //  itoasterのみ使用のためtoaster_type_idは設定されていない。
	if ('vp' in this) {
        $.when(getLoginidAsyncOrg())
        .done(function(loginid){
            console.log('ail_loginid:' + '');
            member_id = loginid;
    
            sendalog(ca_flg, member_id,toaster_prms);
        }).fail(function(loginid){
            member_id = '';
            sendalog(ca_flg, member_id,toaster_prms);
        });
    } else if ('vcprms' in this) {
        $.when(getLoginidAsyncOrg())
        .done(function(loginid){
            console.log('ail_loginid:' + '');
            member_id = loginid;
            
            sendalog(ca_flg, member_id,toaster_prms);
        }).fail(function(loginid){
            member_id = '';
            sendalog(ca_flg, member_id,toaster_prms);
        });
	} else {
        $.when(getLoginidAsyncOrg())
        .done(function(loginid){
            console.log('ail_loginid:' + '');
            member_id = loginid;
            
            sendalog(ca_flg, member_id,toaster_prms);
        }).fail(function(loginid){
            member_id = '';
            sendalog(ca_flg, member_id,toaster_prms);
        });
    }
}

// アクセスログ送信
function sendalog(ca_flg, member_id, toaster_prms) {

    // 一覧ページに表示されている仕事IDを設定
    var list_job_id = '';
    var url = getUrl();

	// 一覧PVに集計する要素が含まれている仕事IDを取得する
	if (ca_flg !== "1") {
	    list_job_id = getJobIdList();
    }

    // レコメンドの種類
    var rec_id =  toaster_prms["RECID"];
    var rec_ref =  toaster_prms["RECKBN"];

    // 配列の初期化
    var jsonArray = {};

    //データをかき集める
    jsonArray['aidemid'] = jQuery.cookie("aidemid");
    jsonArray['visid_new'] = jQuery.cookie("visid_new");
    jsonArray['click_action'] = click_action;
    jsonArray['click_action_type'] = click_action_type;
    jsonArray['parent_session'] = jQuery.cookie("parent_session");
    jsonArray['child_session'] = jQuery.cookie("child_session");
    jsonArray['first_session_flag'] = jQuery.cookie("first_session_flag");
    jsonArray['session_count'] = jQuery.cookie("session_count");
    jsonArray['access_time'] = jQuery.cookie("access_time");
    jsonArray['first_time'] = jQuery.cookie("first_time");
    if ('vp' in this) {
        jsonArray['page_url'] = vp.originUrl;
    } else if ('vcprms' in this) {
        jsonArray['page_url'] = vcprms.pageUrl;
    } else {
        // これだけでいいかも・・・
        jsonArray['page_url'] = location.href;
    }

    var flag = $('body[id="top"]')

    if (flag.length) {
        var pageUrl = jsonArray['page_url'];
        var param = (pageUrl.indexOf('?') < 0 ? '?' : '&') + 'sanalyzetop=1';
        jsonArray['page_url'] += param;
    }

    jsonArray['os'] = navigator.platform;
    jsonArray['cookies'] = navigator.cookieEnabled;
    jsonArray['user_agent'] = navigator.userAgent;
    jsonArray['referrer'] = document.referrer;
    jsonArray['member_ID'] = member_id;
    jsonArray['list_job_id'] = list_job_id;
    jsonArray['rec_id'] = rec_id;
    jsonArray['rec_ref'] = rec_ref;

    //JSON文字列に変換したい場合は以下コードを実行する
    var JsonStr = window.JSON.stringify(jsonArray);

    jQuery.ajax("https://log.e-aidem.com/api/ail", {
            //crossDomain: true,
        type: 'POST',
        data: jsonArray,
        dataType: 'json',
        timeout: 3000
    })
    .done(function(data) {
        console.log(data);
    })
    .fail(function() {
        console.log('aidemlog error.');
    });
}

// aidemidを発行する
function setAidemid() {
    var data = new Date();
    data += Math.random();
    var id = md5(data).substring(0,10);
    jQuery.cookie("aidemid", id, { expires: 730,path:'/' });
}

// ログイン中のidを取得する
function getLoginidAsyncOrg() {
    var d = new jQuery.Deferred;

    // ステージング環境の場合はログインIDを取得しない
    var devHostname = getUrl();
    if (devHostname == '') {
        devHostname = location.href;
    }
    if( isStagingPage(devHostname) ) {
        d.resolve('');
        return d.promise();
    }

    // 採促ページの場合、ログインIDを取得しない
    if(!isEaidem(devHostname)) {
        d.resolve('');
        return d.promise();
    }

    jQuery.ajax({
        type: "GET",
        url: "https://www.e-aidem.com/member/api/member_info.htm",
        dataType: "json",
        timeout: 500
    })
    .done(function(data) {
        console.log('success loginid.');
        d.resolve(data.loginID);
    })
    .fail(function(data){
        console.log('error loginid.');
        d.reject();
    });
    return d.promise();
}

// 日付をフォーマットする
function createDate(sep, mil){
    if (mil == 0) {
        DD = new Date();
    } else {
        DD = new Date(mil);
    }
    var year = DD.getFullYear();
    var month = DD.getMonth() + 1;
    if(month < 10){
        month = "0" + month;
    }
    var day = DD.getDate();
    if(day < 10){
        day = "0" + day;
    }
    var hour = DD.getHours();
    if(hour < 10){
        hour = "0" + hour;
    }
    var minute = DD.getMinutes();
    if(minute < 10){
        minute = "0" + minute;
    }
    var second = DD.getSeconds();
    if(second < 10){
        second = "0" + second;
    }
    if (sep == '0') {
        var value = year+month+day+hour+minute+second;
    } else {
        var value = year+"-"+month+"-"+day+" "+hour+":"+minute+":"+second;
    }

    return value;
}

// 有効期限の設定
function getExpires() {
    // 3分
    date = new Date();
    date.setTime( date.getTime() + ( 3 * 60 * 1000 ));
    return date;
}

// レコメンドパラメータの設定
function getToasterCode(ttid) {
    var toaster_prms = {};
    var recdtll = jQuery.cookie("recdtll");
    var recdtld = jQuery.cookie("recdtld");
    var url = getUrl();

    if (isListPage(url)) {
        toaster_prms["RECKBN"] = "LST";
    } else if (isDetailPage(url)) {
        toaster_prms["RECKBN"] = "DTL";
    }

    if(ttid !== undefined){
        toaster_prms["RECID"] = ttid;
    }

    if(recdtll !== undefined){
        toaster_prms["RECDTLL"] = jQuery.cookie("recdtll");
    }

    if(recdtld !== undefined){
        toaster_prms["RECDTLD"] = jQuery.cookie("recdtld");
    }

    return toaster_prms;
}

// 仕事IDの取得
function getJobIdList() {
    var list_job_id = '';
    // イーアイデム総合PC（もう使えないかも知れない）
    var elements = document.getElementsByClassName( "seoLink" ) ;
    for( var i=0,l=elements.length; l>i; i++ ) {
        var element = elements[i] ;
        list_job_id = list_job_id + element.id + ',';
    }
    // イーアイデム総合SP、イーアイデム正社員
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "btnGroup clearfix data-for-aidemlog" ) ;
        for( var i=0,l=elements.length; l>i; i++ ) {
            var element = elements[i] ;
            list_job_id = list_job_id + element.id + ',';
        }
    }

    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "btnGroup clearfix" ) ;
        for( var i=0,l=elements.length; l>i; i++ ) {
            var element = elements[i] ;
            list_job_id = list_job_id + element.id + ',';
        }
    }

    // イーアイデム総合、正社員PC
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "btn btn-keep data-for-aidemlog" );
        for (var i=0, cnt = elements.length; i < cnt; i++) {
            list_job_id += elements[i].getAttribute('data-job_offer_id') + ',';
        }
    }
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "btn btn-keep" );
        for (var i=0, cnt = elements.length; i < cnt; i++) {
            list_job_id += elements[i].getAttribute('data-job_offer_id') + ',';
        }
    }

    // 採促
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "btn btn-add data-for-aidemlog" );
        for (var i=0, cnt = elements.length; i < cnt; i++) {
            list_job_id += elements[i].getAttribute('data-id') + ',';
        }
    }
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "data-for-aidemlog" );
        for (var i=0, cnt = elements.length; i < cnt; i++) {
            list_job_id += elements[i].getAttribute('data-id') + ',';
        }
    }

    // マチジョブPC
    var elements = document.getElementsByClassName( "kyujinInfo05" ) ;
    for( var i=0,l=elements.length; l>i; i++ ) {
        var element = elements[i] ;
        //console.log('DEBUG element.' + element.innerHTML);
        var textstr = element.innerHTML;
        textstr = textstr.replace("(", "");
        textstr = textstr.replace(")", "");
        list_job_id = list_job_id + textstr + ',';
    }
    // マチジョブSP
    if (list_job_id === '') {
        var elements = document.getElementsByClassName( "kentoBtn" ) ;
        for( var i=0,l=elements.length; l>i; i++ ) {
            var element = elements[i] ;
            list_job_id = list_job_id + element.name + ',';
        }
    }

    return list_job_id;

}

// velocity ParameterからURLを取得
function getUrl() {
    var url = '';
    if ('vp' in this) {
        url = vp.originUrl;
    } else if ('vcprms' in this) {
        url = vcprms.pageUrl;
    } else if('originUrl' in this){
        url = originUrl;
    } else {
        url = location.href;
    }
    //console.log('DEBUG url.' + url);
    return url;
}

// 仕事IDの取得対象ページか判定する
function isListPage(url) {
    var targetUrls = [
        'list.htm',
        '_city.htm',
        '_sta.htm',
        '_shokusyu.htm',
        '_koyo.htm',
        '_style.htm',
        '_cl.htm',
        '_new.htm',
        '_fw.htm',
        '_rail.htm',
        '_groupcity.htm',
        '_closelist.htm',
        'kyujin_l.htm'
    ];
    return checkPage(url, targetUrls);
}

// 詳細ページか判定する
function isDetailPage(url) {
    var targetUrls = [
        'detail.htm',
        '_detail.htm',
        'kyujin_d.htm'
    ];
    return checkPage(url, targetUrls);
}

// ステージングか判定する
function isStagingPage(url) {
    var targetUrls = [
        'stg-njg-front.job-gear.jp',
        'dev1-front.xn--cckxa3a6ipd.jp',
        'dev2-front.xn--cckxa3a6ipd.jp',
        '192.168.99.100'
    ];
    return checkPage(url, targetUrls);
}

// イーアイデムか判定する
function isEaidem(url) {
    var targetUrls = [
        'www.e-aidem.com'
    ];

    return checkPage(url, targetUrls);
}

// 引数で指定したURLにマッチするか判定
function checkPage(url, checkPages) {
    for (var i=0; i < checkPages.length; i++) {
        if (url.indexOf(checkPages[i]) > -1) {
            return true;
        }
    }
    return false;
}