function deleteKento(e){$.cookie("actualExamCnt",parseInt($.cookie("actualExamCnt"))-1),$("#"+e+" .keepzumiBtn").css("display","none"),$("#"+e+" .keepBtn").css("display","block"),$.ajax({url:"/aps/api/examination/keep/delete",contentType:"application/json",dataType:"json",data:{examinationKeep:e},success:function(e){setHeaderExamCnt()}})}function setViewKento(){$(".btnGroup").each(function(){(1==$(this).children().hasClass("zumi")?$(this).children(".keepzumiBtn"):$(this).children(".keepBtn")).css("display","block")}),$.ajax({type:"GET",url:"/aps/api/examination/list",contentType:"application/json",dataType:"json",data:{},success:function(e){if(0!=e.results.length)for(var t=0;t<e.results.length;t++){var n="#"+e.results[t].job_id+" .keepBtn",o="#"+e.results[t].job_id+" .keepzumiBtn";$(n).css("display","none"),$(o).css("display","block"),$(o).addClass("zumi")}},error:function(){}})}var keepBtnAlertManager={kpBtn:$("p.keepBtn a"),init:function(){var n=this;$.cookie("AlertDisplayed")||($.cookie("AlertDisplayed","no",{expires:30}),$.cookie("vwoKeepBtnCnt","0")),this.kpBtn.on("click",function(){var e,t=$(this).parents(".btnGroup").attr("id");executeKento(t),"no"===$.cookie("AlertDisplayed")&&(e=+$.cookie("vwoKeepBtnCnt"),t=parseInt($.cookie("actualExamCnt")),$.cookie("vwoKeepBtnCnt",1+e),3==+$.cookie("vwoKeepBtnCnt")&&t<21&&(n.showThreeCountAlert(),$.cookie("AlertDisplayed","yes",{expires:30}),$.removeCookie("vwoKeepBtnCnt")))})},showThreeCountAlert:function(){setTimeout(function(){var e=$('<div class="modal-bg">'),t=$('<span class="closeBtn">×</span>').on("click",function(){e.remove()}),n=$('<div class="alertBox"><h1><em>'+$.cookie("actualExamCnt")+'</em>件キープした求人があります！</h1><hr/>キープした仕事を比較して<br/>あなたに合ったお仕事に<br/>応募しよう！<p class="exmListBtn"><a href="/aps/list.htm?type=ExaminationList&region_id='+vp.ac+'">キープした仕事を確認する</a></p></div>');$("body").append(e.append(n.prepend(t)))},1e3)}};