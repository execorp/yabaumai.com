<?php

// 携帯用テンプレート変換フィルター
function mobileOutputfilter($template, &$smarty)
{
	header("Content-Type: text/html; charset=Shift_JIS");
	include_once( "emojilib/lib/mobile_class_8.php" );
	$template = $emoji_obj->replace_emoji($template);
	$template = mb_convert_encoding($template, 'SJIS-win', 'UTF-8');
	$template = mb_convert_kana($template, 'ask', "SJIS-win");
	
	return $template;
}

// PC用テンプレート変換フィルター
function pcOutputfilter($template, &$smarty)
{
	// 何もしない
	
	return $template;
}

// スマートフォン用テンプレート変換フィルター
function smartOutputfilter($template, &$smarty)
{
	// 何もしない
	
	return $template;
}
