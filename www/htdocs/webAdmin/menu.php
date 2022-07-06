<?

$domain   = domain;
$siteName = siteName;

$menu =<<<EOF
<div id="menu_area">
    <h3 id="menu_title">{$domain}<br />{$siteName}</h3>
    <dl>
        <dt>∇掲載申込</dt>
        <dd><a href="./adverList.php" title="gals" target="_top">一覧</a></dd>
        
        <dt>∇お問合わせ</dt>
        <dd><a href="./inquiryList.php" title="gals" target="_top">一覧</a></dd>

        <!-- dt>∇カバーガール</dt>
        <dd><a href="./coverAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./coverList.php" title="gals" target="_top">一覧</a></dd -->

        <!-- dt>∇ヘッダーバナー</dt>
        <dd><a href="./headerBannerAddChange.php" title="gals" target="_top">登録</a></dd -->

        <dt>∇新着情報</dt>
        <dd><a href="./newAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./newList.php" title="gals" target="_top">一覧</a></dd>
    	
        <dt>∇店舗管理</dt>
        <dd><a href="./shopAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./shopList.php" title="gals" target="_top">一覧</a></dd>

        <dt>∇相互リンク管理</dt>
        <dd><a href="./linkAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./linkList.php" title="gals" target="_top">一覧</a></dd>
        	
        <!-- dt>∇認証リンク管理</dt>
        <dd><a href="./linkEnterAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./linkEnterList.php" title="gals" target="_top">一覧</a></dd -->
        	
        <!-- dt>∇18人カバー管理</dt>
        <dd><a href="./galImageAddChange.php" title="gals" target="_top">管理</a></dd -->
        	
        <dt>∇サイドリンク管理</dt>
        <dd><a href="./linkRecommendAddChange.php" title="gals" target="_top">登録</a></dd>
        <dd><a href="./linkRecommendList.php" title="gals" target="_top">一覧</a></dd>

    </dl>
</div>
EOF;
?>
