<?
//���̃t�@�C���̓��e�̓T�C�g�ɑ��������ɓK�X�ύX���鎖
if ($domain) {
    define('RSS_DOMAIN',$domain);
} else {
    define('RSS_DOMAIN', '');
}
if ($siteName) {
    define('RSS_SITE_NAME', $siteName);
} else {
    define('RSS_SITE_NAME', '');
}
define('RSS_NEWS_TABLE_NAME', 'whatsNew');
//SELECT�̍��ږ���`imgId`, `title`, `comment`, `dateTime`��Ԃ����A���ږ����قȂ�ꍇ�͕ʖ��ł������w�肷��B
define('NEWS_SQL','SELECT `imgId`, `title`, `comment`, `dateTime` FROM `' . RSS_NEWS_TABLE_NAME . '` ORDER BY `dateTime` DESC LIMIT !');
?>