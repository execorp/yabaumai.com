function submitFreeword(){var e=$("#areaselect").val(),n=$("input#top_input").val();if(""===n)return alert("フリーワードを入力してください。"),!1;$("#freeword_box input#top_input").prop("disabled",!0),$("#freeword_box #searchbotton").css("pointer-events","none");var t="/aps/list.htm?max_view=50&region_id="+e+"&PS=6&free_word="+encodeURIComponent(n);return location.href=t,!1}$("#areaSearch li.btn08").on("click",function(){$("#resortSearch").removeClass("panelUp").addClass("panelDown")}),$("#resortSearch .backAreaSearch a").on("click",function(){$("#resortSearch").removeClass("panelDown").addClass("panelUp")}),$("#areaSearch .area_list li.region").on("click",function(){var e=$(this).data("region");$(this).text();$(".pref_select_box[data-region="+e+"]").addClass("visible")}),$(".pref_select_box .btn-back").on("click",function(){$(this).parents(".pref_select_box").removeClass("visible")}),$("#popular h2").on("click",function(){$(this).next().slideToggle()}),$(function(){$(".Sform #top_input").keypress(function(e){return!(e.which&&13===e.which||e.keyCode&&13===e.keyCode)||(submitFreeword(),!1)}),$("#searchbotton").on("click",function(){submitFreeword()})}),$(function(){var e=window.navigator.userAgent,n="";if(-1==e.indexOf("Trident")&&-1==e.indexOf("MSIE")||(n=1),1!=n){var t="";$('input[name="free_word"]').on("change keyup",function(){t=$(this).val()}),$('input[name="free_word"]').autocomplete({source:function(e,o){$.ajax({url:"/aps/api/job/suggest?keyword="+t,cache:!1,dataType:"json",data:{param1:e.term},success:function(e){o(e)},error:function(e,n,t){o([""])}})}})}});