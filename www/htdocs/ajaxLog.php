<?php
require_once( "./inc/exe.php" );
require_once( "./inc/.ht_Config.php" );

/*-------------------------------
	Ajax処理
-------------------------------*/
// postがある場合
if(isset($_POST['postId'])){
	$p_id = $_POST['postId'];

	try{
        $goodChk = $db->getOne( "SELECT `shop_id` FROM `log` WHERE `shop_id` = ? AND `user_id` = ? AND `good` = ?", array( $p_id, USER_ID, 1 ) );
		// レコードが1件でもある場合
		if(!empty($goodChk)){
			// レコードを削除する
            $db->query( "DELETE FROM `log` WHERE `shop_id` = ? AND `user_id` = ? AND `good` = ?", array( $p_id, USER_ID, 1 )  );
//			echo count($db->getAll( "SELECT * FROM `good` WHERE `shop_id` = ? ", array( $p_id )));
		}else{
			// レコードを挿入する
            $insertDataArray = array( $p_id, USER_ID, 1, date('Y-m-d H:i:s') );
            $db->query( "INSERT `log` ( `shop_id`,`user_id`,`good`,`created_date` ) VALUES ( ?, ?, ?, ? ) ", $insertDataArray );
//			echo count($db->getAll( "SELECT * FROM `good` WHERE `shop_id` = ? ", array( $p_id )));
		}
        // お気に入りの総数を表示
        echo count($db->getAll( "SELECT `user_id` FROM `log` WHERE `shop_id` > ? AND `user_id` = ? AND `good` = ?", array( 0, USER_ID, 1 ) ) );
	}catch(Exception $e){
		error_log('エラー発生：'.$e->getMessage());
	}
}
