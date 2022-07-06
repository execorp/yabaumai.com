<?PHP
//クラス概要
//このクラスはＨＴＭＬと携帯向けデコメールの相互変換クラスです。
//ＦＣＫエディタを用いて編集する事とpic.phpを使用する事が前提で作られています。
//　09/12/11　ver 1.00　基本動作作成（y.takeoka）

//デコメールクラス構成

//メンバー変数

//$decoMail：デコメール本文(str)
//$domain：ドメイン名(str)
//$basePath：基本ディレクトリの位置(str)※ドメイン名と連動
//$imgFolder：イメージファイルディレクトリ(str)
//$testFlg：テストフラグ(bool)
//$mailLenLimit：メール容量制限(int)

//メンバー関数

//名称　decoMailImgConv()
//動作　srcの管理画面表示用画像名をaltの携帯添付用画像名で置き換える

//名称　_FckEmojiConv()
//動作　fckエディタの絵文字画像を絵文字表示用タグに置き換える

//名称　_p2divConv()
//動作　ページタグをDIVタグと改行に置き換える

//名称　_decoMailImgConv()
//動作　srcの管理画面表示用画像名をaltの携帯添付用画像名で置き換える

//名称　allConv()
//動作　_decoMailImgConv、_FckEmojiConv、_p2divConvをまとめて実行する

//名称　checkMailLen
//動作　長さが適切か判断して真偽を返す
//出力　trueまたはfalse(ただしtrueの場合エラーがある)

//名称　checkDecoMailImg
//動作　添付画像が適切か判断して真偽を返す
//出力　trueまたはfalse(ただしtrueの場合エラーがある)

//セッタ（外部からクラスのメンバー変数を設定する）
//setDomain
//setImgFolder
//setDecoMail

//ゲッタ（外部からクラスのメンバー変数を取得する）
//getDecoMail

require_once(DECO_INC_PATH."commonObject.class.php" );
class decoConv extends commonObject
{
    var $decoMail;
    var $domain;
    var $basePath;
    var $imgFolder;
    var $mailLenLimit = 9000;
    var $imgList;
    // 絵文字置換用配列
    var $emojiArray = array(
                'sun.gif' => '{emj_d_0001}'             , 'cloud.gif' => '{emj_d_0002}'         , 'rain.gif' => '{emj_d_0003}'          , 'snow.gif' => '{emj_d_0004}'
              , 'thunder.gif' => '{emj_d_0005}'         , 'typhoon.gif' => '{emj_d_0006}'       , 'mist.gif' => '{emj_d_0007}'          , 'sprinkle.gif' => '{emj_d_0008}'
              , 'aries.gif' => '{emj_d_0009}'           , 'taurus.gif' => '{emj_d_0010}'        , 'gemini.gif' => '{emj_d_0011}'        , 'cancer.gif' => '{emj_d_0012}'
              , 'leo.gif' => '{emj_d_0013}'             , 'virgo.gif' => '{emj_d_0014}'         , 'libra.gif' => '{emj_d_0015}'         , 'scorpius.gif' => '{emj_d_0016}'
              , 'sagittarius.gif' => '{emj_d_0017}'     , 'capricornus.gif' => '{emj_d_0018}'   , 'aquarius.gif' => '{emj_d_0019}'      , 'pisces.gif' => '{emj_d_0020}'
              , 'sports.gif' => '{emj_d_0021}'          , 'baseball.gif' => '{emj_d_0022}'      , 'golf.gif' => '{emj_d_0023}'          , 'tennis.gif' => '{emj_d_0024}'
              , 'soccer.gif' => '{emj_d_0025}'          , 'ski.gif' => '{emj_d_0026}'           , 'basketball.gif' => '{emj_d_0027}'    , 'motorsports.gif' => '{emj_d_0028}'
              , 'pocketbell.gif' => '{emj_d_0029}'      , 'train.gif' => '{emj_d_0030}'         , 'subway.gif' => '{emj_d_0031}'        , 'bullettrain.gif' => '{emj_d_0032}'
              , 'car.gif' => '{emj_d_0033}'             , 'rvcar.gif' => '{emj_d_0034}'         , 'bus.gif' => '{emj_d_0035}'           , 'ship.gif' => '{emj_d_0036}'
              , 'airplane.gif' => '{emj_d_0037}'        , 'house.gif' => '{emj_d_0038}'         , 'building.gif' => '{emj_d_0039}'      , 'postoffice.gif' => '{emj_d_0040}'
              , 'hospital.gif' => '{emj_d_0041}'        , 'bank.gif' => '{emj_d_0042}'          , 'atm.gif' => '{emj_d_0043}'           , 'hotel.gif' => '{emj_d_0044}'
              , '24hours.gif' => '{emj_d_0045}'         , 'gasstation.gif' => '{emj_d_0046}'    , 'parking.gif' => '{emj_d_0047}'       , 'signaler.gif' => '{emj_d_0048}'
              , 'toilet.gif' => '{emj_d_0049}'          , 'restaurant.gif' => '{emj_d_0050}'    , 'cafe.gif' => '{emj_d_0051}'          , 'bar.gif' => '{emj_d_0052}'
              , 'beer.gif' => '{emj_d_0053}'            , 'fastfood.gif' => '{emj_d_0054}'      , 'boutique.gif' => '{emj_d_0055}'      , 'hairsalon.gif' => '{emj_d_0056}'
              , 'karaoke.gif' => '{emj_d_0057}'         , 'movie.gif' => '{emj_d_0058}'         , 'upwardright.gif' => '{emj_d_0059}'   , 'carouselpony.gif' => '{emj_d_0060}'
              , 'music.gif' => '{emj_d_0061}'           , 'art.gif' => '{emj_d_0062}'           , 'drama.gif' => '{emj_d_0063}'         , 'event.gif' => '{emj_d_0064}'
              , 'ticket.gif' => '{emj_d_0065}'          , 'smoking.gif' => '{emj_d_0066}'       , 'nosmoking.gif' => '{emj_d_0067}'     , 'camera.gif' => '{emj_d_0068}'
              , 'bag.gif' => '{emj_d_0069}'             , 'book.gif' => '{emj_d_0070}'          , 'ribbon.gif' => '{emj_d_0071}'        , 'present.gif' => '{emj_d_0072}'
              , 'birthday.gif' => '{emj_d_0073}'        , 'telephone.gif' => '{emj_d_0074}'     , 'mobilephone.gif' => '{emj_d_0075}'   , 'memo.gif' => '{emj_d_0076}'
              , 'tv.gif' => '{emj_d_0077}'              , 'game.gif' => '{emj_d_0078}'          , 'cd.gif' => '{emj_d_0079}'            , 'heart.gif' => '{emj_d_0080}'
              , 'spade.gif' => '{emj_d_0081}'           , 'diamond.gif' => '{emj_d_0082}'       , 'club.gif' => '{emj_d_0083}'          , 'eye.gif' => '{emj_d_0084}'
              , 'ear.gif' => '{emj_d_0085}'             , 'rock.gif' => '{emj_d_0086}'          , 'scissors.gif' => '{emj_d_0087}'      , 'paper.gif' => '{emj_d_0088}'
              , 'downwardright.gif' => '{emj_d_0089}'   , 'upwardleft.gif' => '{emj_d_0090}'    , 'foot.gif' => '{emj_d_0091}'          , 'shoe.gif' => '{emj_d_0092}'
              , 'eyeglass.gif' => '{emj_d_0093}'        , 'wheelchair.gif' => '{emj_d_0094}'    , 'newmoon.gif' => '{emj_d_0095}'       , 'moon1.gif' => '{emj_d_0096}'
              , 'moon2.gif' => '{emj_d_0097}'           , 'moon3.gif' => '{emj_d_0098}'         , 'fullmoon.gif' => '{emj_d_0099}'      , 'dog.gif' => '{emj_d_0100}'
              , 'cat.gif' => '{emj_d_0101}'             , 'yacht.gif' => '{emj_d_0102}'         , 'xmas.gif' => '{emj_d_0103}'          , 'downwardleft.gif' => '{emj_d_0104}'  
              , 'phoneto.gif' => '{emj_d_0105}'         , 'mailto.gif' => '{emj_d_0106}'        , 'faxto.gif' => '{emj_d_0107}'         , 'info01.gif' => '{emj_d_0108}'
              , 'info02.gif' => '{emj_d_0109}'          , 'mail.gif' => '{emj_d_0110}'          , 'by-d.gif' => '{emj_d_0111}'          , 'd-point.gif' => '{emj_d_0112}'
              , 'yen.gif' => '{emj_d_0113}'             , 'free.gif' => '{emj_d_0114}'          , 'id.gif' => '{emj_d_0115}'            , 'key.gif' => '{emj_d_0116}'
              , 'enter.gif' => '{emj_d_0117}'           , 'clear.gif' => '{emj_d_0118}'         , 'search.gif' => '{emj_d_0119}'        , 'new.gif' => '{emj_d_0120}'
              , 'flag.gif' => '{emj_d_0121}'            , 'freedial.gif' => '{emj_d_0122}'      , 'sharp.gif' => '{emj_d_0123}'         , 'mobaq.gif' => '{emj_d_0124}'
              , 'one.gif' => '{emj_d_0125}'             , 'two.gif' => '{emj_d_0126}'           , 'three.gif' => '{emj_d_0127}'         , 'four.gif' => '{emj_d_0128}'
              , 'five.gif' => '{emj_d_0129}'            , 'six.gif' => '{emj_d_0130}'           , 'seven.gif' => '{emj_d_0131}'         , 'eight.gif' => '{emj_d_0132}'
              , 'nine.gif' => '{emj_d_0133}'            , 'zero.gif' => '{emj_d_0134}'          , 'ok.gif' => '{emj_d_0135}'            , 'heart01.gif' => '{emj_d_0136}'
              , 'heart02.gif' => '{emj_d_0137}'         , 'heart03.gif' => '{emj_d_0138}'       , 'heart04.gif' => '{emj_d_0139}'       , 'happy01.gif' => '{emj_d_0140}'
              , 'angry.gif' => '{emj_d_0141}'           , 'despair.gif' => '{emj_d_0142}'       , 'sad.gif' => '{emj_d_0143}'           , 'wobbly.gif' => '{emj_d_0144}'
              , 'up.gif' => '{emj_d_0145}'              , 'note.gif' => '{emj_d_0146}'          , 'spa.gif' => '{emj_d_0147}'           , 'cute.gif' => '{emj_d_0148}'
              , 'kissmark.gif' => '{emj_d_0149}'        , 'shine.gif' => '{emj_d_0150}'         , 'flair.gif' => '{emj_d_0151}'         , 'annoy.gif' => '{emj_d_0152}'
              , 'punch.gif' => '{emj_d_0153}'           , 'bomb.gif' => '{emj_d_0154}'          , 'notes.gif' => '{emj_d_0155}'         , 'down.gif' => '{emj_d_0156}'
              , 'sleepy.gif' => '{emj_d_0157}'          , 'sign01.gif' => '{emj_d_0158}'        , 'sign02.gif' => '{emj_d_0159}'        , 'sign03.gif' => '{emj_d_0160}'
              , 'impact.gif' => '{emj_d_0161}'          , 'sweat01.gif' => '{emj_d_0162}'       , 'sweat02.gif' => '{emj_d_0163}'       , 'dash.gif' => '{emj_d_0164}'
              , 'sign04.gif' => '{emj_d_0165}'          , 'sign05.gif' => '{emj_d_0166}'        , 'slate.gif' => '{emj_d_0167}'         , 'pouch.gif' => '{emj_d_0168}'
              , 'pen.gif' => '{emj_d_0169}'             , 'shadow.gif' => '{emj_d_0170}'        , 'chair.gif' => '{emj_d_0171}'         , 'night.gif' => '{emj_d_0172}'
              , 'soon.gif' => '{emj_d_0173}'            , 'on.gif' => '{emj_d_0174}'            , 'end.gif' => '{emj_d_0175}'           , 'clock.gif' => '{emj_d_0176}'

              , 'appli01.gif' => '{emj_d_1001}'         , 'appli02.gif' => '{emj_d_1002}'       , 't-shirt.gif' => '{emj_d_1003}'       , 'moneybag.gif' => '{emj_d_1004}'
              , 'rouge.gif' => '{emj_d_1005}'           , 'denim.gif' => '{emj_d_1006}'         , 'snowboard.gif' => '{emj_d_1007}'     , 'bell.gif' => '{emj_d_1008}'
              , 'door.gif' => '{emj_d_1009}'            , 'dollar.gif' => '{emj_d_1010}'        , 'pc.gif' => '{emj_d_1011}'            , 'loveletter.gif' => '{emj_d_1012}'
              , 'wrench.gif' => '{emj_d_1013}'          , 'pencil.gif' => '{emj_d_1014}'        , 'crown.gif' => '{emj_d_1015}'         , 'ring.gif' => '{emj_d_1016}'
              , 'sandclock.gif' => '{emj_d_1017}'       , 'bicycle.gif' => '{emj_d_1018}'       , 'japanesetea.gif' => '{emj_d_1019}'   , 'watch.gif' => '{emj_d_1020}'
              , 'think.gif' => '{emj_d_1021}'           , 'confident.gif' => '{emj_d_1022}'     , 'coldsweats01.gif' => '{emj_d_1023}'  , 'coldsweats02.gif' => '{emj_d_1024}'  
              , 'pout.gif' => '{emj_d_1025}'            , 'gawk.gif' => '{emj_d_1026}'          , 'lovely.gif' => '{emj_d_1027}'        , 'good.gif' => '{emj_d_1028}'
              , 'bleah.gif' => '{emj_d_1029}'           , 'wink.gif' => '{emj_d_1030}'          , 'happy02.gif' => '{emj_d_1031}'       , 'bearing.gif' => '{emj_d_1032}'
              , 'catface.gif' => '{emj_d_1033}'         , 'crying.gif' => '{emj_d_1034}'        , 'weep.gif' => '{emj_d_1035}'          , 'ng.gif' => '{emj_d_1035}'
              , 'clip.gif' => '{emj_d_1037}'            , 'copyright.gif' => '{emj_d_1038}'     , 'tm.gif' => '{emj_d_1039}'            , 'run.gif' => '{emj_d_1040}'
              , 'secret.gif' => '{emj_d_1041}'          , 'recycle.gif' => '{emj_d_1042}'       , 'r-mark.gif' => '{emj_d_1043}'        , 'danger.gif' => '{emj_d_1044}'
              , 'ban.gif' => '{emj_d_1045}'             , 'empty.gif' => '{emj_d_1046}'         , 'pass.gif' => '{emj_d_1047}'          , 'full.gif' => '{emj_d_1048}'
              , 'leftright.gif' => '{emj_d_1049}'       , 'updown.gif' => '{emj_d_1050}'        , 'school.gif' => '{emj_d_1051}'        , 'wave.gif' => '{emj_d_1052}'
              , 'fuji.gif' => '{emj_d_1053}'            , 'clover.gif' => '{emj_d_1054}'        , 'cherry.gif' => '{emj_d_1055}'        , 'tulip.gif' => '{emj_d_1056}'
              , 'banana.gif' => '{emj_d_1057}'          , 'apple.gif' => '{emj_d_1058}'         , 'bud.gif' => '{emj_d_1059}'           , 'maple.gif' => '{emj_d_1060}'
              , 'cherryblossom.gif' => '{emj_d_1061}'   , 'riceball.gif' => '{emj_d_1062}'      , 'cake.gif' => '{emj_d_1063}'          , 'bottle.gif' => '{emj_d_1064}'
              , 'noodle.gif' => '{emj_d_1065}'          , 'bread.gif' => '{emj_d_1066}'         , 'snail.gif' => '{emj_d_1067}'         , 'chick.gif' => '{emj_d_1068}'
              , 'penguin.gif' => '{emj_d_1069}'         , 'fish.gif' => '{emj_d_1070}'          , 'delicious.gif' => '{emj_d_1071}'     , 'smile.gif' => '{emj_d_1072}'
              , 'horse.gif' => '{emj_d_1073}'           , 'pig.gif' => '{emj_d_1074}'           , 'wine.gif' => '{emj_d_1075}'          , 'shock.gif' => '{emj_d_1076}'
       );

    function decoConv($domain, $wwwFlg = 0, $imgFolder = 'inc', $testFlg = 0) {
        $this->setTest($testFlg);
        $this->setDomain($domain, $wwwFlg);
        $this->setImgFolder($imgFolder);
    }

    function _decoMailImgConv() {
        if (is_array($this->imgList)) {
            $this->_decoMailImgListConv();
        }
        $this->_decoMailImgAltConv();
        return true;
    }

    function _decoMailImgListConv() {
        $imgList = $this->imgList;
        // DB格納画像が存在するなら置き換える
        foreach ($imgList as $repKey => $repValue) {
            $repStr = '/alt=.*src=".*pic.php.*imgId=' . $repKey . '.*"/';
            $repValue = 'src="' . $repValue . '"';
            $this->decoMail = preg_replace($repStr, $repValue, $this->decoMail);
            $repStr = '/src=".*pic.php.*imgId=' . $repKey . '.*"/';
            $this->decoMail = preg_replace($repStr, $repValue, $this->decoMail);
        }
        $this->testDump($this->decoMail,'decoMailImg', $this->testFlg);
        return true;
    }

    function _decoMailImgAltConv() {
        $repStr = '/ src=".*pic\.php.*"/';
        // DB格納画像が存在するなら置き換える
        $this->decoMail = preg_replace($repStr, '', $this->decoMail);
        $this->testDump($value,'Path', $this->testFlg);
        $this->decoMail = str_replace('alt="image', 'src="image', $this->decoMail);
        $this->testDump($this->decoMail,'decoMailImg', $this->testFlg);
        return true;
    }

    function decoMailImgRecover($tableName = "Deco_mailImage") {
        if (is_array($this->imgList)) {
            $this->decoMailImgListRecover($tableName);
        }
        $this->decoMailImgAltRecover($tableName);
        return true;
    }

    function decoMailImgListRecover($tableName) {
        $imgList = $this->imgList;
        foreach ($imgList as $repKey => $repValue) {
            $repStr = '../../' . $this->imgFolder . '/pic.php?t=' .  $tableName . '&imgId=' . $repKey ;
            $this->decoMail = eregi_replace('src="' . $repValue . '"' , 'src="' . $repStr . '"' , $this->decoMail);
        }
        $this->testDump($this->decoMail,'decoMailImg', $this->testFlg);
    }

    function decoMailImgAltRecover($tableName) {
        $searchArray = '';
        for ($i = 1 ; $i <= 9 ; $i++) {
            for ($j = 1 ; $j <= 9 ; $j++) {
                $searchValue = '../../' . $this->imgFolder . '/pic.php?t=' .  $tableName . '&imgId=' . $i . $j;
                $searchKey = 'image_' . $this->domain . '-' . $i . '-' . $j . '.jpg';
                $searchArray[$searchKey]= $searchValue;
                $searchKey = 'image_' . $this->domain . '-' . $i . '-' . $j . '.gif';
                $searchArray[$searchKey]= $searchValue;
                $searchKey = 'image_' . $this->domain . '-' . $i . '-' . $j . '.png';
                $searchArray[$searchKey]= $searchValue;
            }
        }
        foreach ($searchArray as $repKey => $repValue) {
            $this->decoMail = str_replace($repKey, $repValue, $this->decoMail);
        }
        $this->testDump($this->decoMail,'decoMailImg', $this->testFlg);
        return true;
    }

    function trimBodyTag() {
        $this->decoMail = str_replace('</body>', '', $this->decoMail);
        $baseCount = strlen($this->decoMail);
        $this->decoMail = preg_replace('/</' , "\n".'<' , $this->decoMail);
        $this->decoMail = preg_replace('/>/' , '>'."\n" , $this->decoMail);
        preg_match('/<body bgcolor=".*">/', $this->decoMail, $tmpArray);
        $resultArray = explode('"', $tmpArray[0]);
        $result = $resultArray[1];
        $this->decoMail = preg_replace('/<body bgcolor=".*">/' , '', $this->decoMail);
        $this->decoMail = preg_replace('/\n</' , '<' , $this->decoMail);
        $this->decoMail = preg_replace('/>\n/' , '>' , $this->decoMail);
        return $result;
    }

    function _FckEmojiConv() {
        $emojiReplace = $this->emojiArray;
        foreach ($emojiReplace as $rep_key => $rep_value) {
            $rep_str = '/<img.*src=".*fckeditor.*' . $rep_key . '" \/>/';
            $this->decoMail = preg_replace($rep_str , $rep_value , $this->decoMail);
        }
        $this->testDump($this->decoMail,'decoMail_emoji', $this->testFlg);
        return true;
    }

    function FckEmojiRecover() {
        $emojiReplace = $this->emojiArray;
        foreach ($emojiReplace as $repKey => $repValue) {
            $repStr = '<img alt="" src="/fckeditor/editor/images/smiley/typepad/' . $repKey . '" />';
            $this->decoMail = str_replace($repValue, $repStr, $this->decoMail);
        }
        $this->testDump($this->decoMail,'decoMail_emoji', $this->testFlg);
        return true;
    }

    function FckEmojiDump() {
        $emojiReplace = $this->emojiArray;
        $result = "";
        foreach ($emojiReplace as $repKey => $repValue) {
            $result .= $repValue;
        }
        return $result;
    }

    function plainConv() {
        $this->_FckEmojiConv();
        $this->decoMail = strip_tags($this->decoMail);
    }

    function _pc2telConv() {
        $repStr = "\r";
        $repValue = "";
        $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);
        $repStr = "\n";
        $repValue = "\r\n";
        $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);
        $repStr = '<p';
        $repValue = '<div';
        $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);
        $repStr = '</p>';
        $repValue = '</div><br>';
        $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);

        $this->_tagDivider($this->decoMail, 'div');
        $this->_tagDivider($this->decoMail, 'span');
        $this->_tagDivider($this->decoMail, 'font');

        $searchStr = '/color="rgb\(\s*[0-2]{0,1}[0-9]{1,2}\s*,\s*[0-2]{0,1}[0-9]{1,2}\s*,\s*[0-2]{0,1}[0-9]{1,2}\s*\);?"/';
        preg_match_all($searchStr, $this->decoMail, $tmpArray);
        if (is_array($tmpArray[0])) {
            foreach ($tmpArray[0] As $key => $value) {
                $repStr = str_replace('"', '', $value);
                $repStr = str_replace('color=', '', $repStr);
                $divColor = str_replace(';', '', $repStr);
                $divColor = str_replace(')', '', $repStr);
                $divColor = str_replace('rgb(', '', $divColor);
                $divArray = array();
                $divArray = explode(',', $divColor);
                $repValue = "#";
                foreach ($divArray As $divKey => $divValue) {
                    $hexValue = dechex(trim($divValue));
                    if (strlen($hexValue) == 1) {
                        $hexValue = "0" . $hexValue;
                    }
                    $repValue .= $hexValue;
                }
                $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);
            }
        }
        unset($tmpArray);

        $searchStr = '/color="#[0-9a-f]{3}"/';
        preg_match_all($searchStr, $this->decoMail, $tmpArray);
        if (is_array($tmpArray[0])) {
            foreach ($tmpArray[0] As $key => $value) {
                $repStr = str_replace('color=', '', $value);
                $repValue = '"#';
                $repValue .= substr($repStr, 2, 1);
                $repValue .= substr($repStr, 2, 1);
                $repValue .= substr($repStr, 3, 1);
                $repValue .= substr($repStr, 3, 1);
                $repValue .= substr($repStr, 4, 1);
                $repValue .= substr($repStr, 4, 1);
                $repValue .= '"';
                $this->decoMail = str_replace($repStr, $repValue, $this->decoMail);
            }
        }
        $this->testDump($this->decoMail,'decoMailP2div',$this->testFlg);
        return true;
    }

    function _tagDivider(&$text, $tag) {
        $divideEnd = strpos($text, '</' . $tag);
        if (is_numeric($divideEnd)) {
            $tagEnd = strpos($text, '>', $divideEnd);
            //変換範囲外（後）保持
            if (strlen($text) > $tagEnd) {
                $sufText = substr($text, $tagEnd + 1);
            } else {
                $sufText = "";
            }
            $subText = substr($text, 0, $divideEnd);
            $tagStart = strposLast($subText, '<' . $tag);
            //変換範囲外（前）保持
            if ($tagStart > 0) {
                $preText = substr($text, 0, $tagStart);
            } else {
                $preText = "";
            }
            $divideStart = strpos($subText, '>', $tagStart) - $tagStart + 1;
            $tagStartData = substr($subText, $tagStart, $divideStart);
            $mainText = substr($subText, $tagStart + $divideStart);
            unset($subText);
            switch ($tag) {
                case 'font':
                    $tagArray = $this->_fontConvert($tagStartData, $tag);
                    break;
                default:
                    $tagArray = $this->_styleConvert($tagStartData, $tag);
                    break;
            }
            if (is_array($tagArray)) {
                foreach($tagArray As $key => $value) {
                    $mainPre = $mainPre . $key;
                    $mainSuf = $value . $mainSuf;
                }
            }
            $text = $preText . $mainPre . $mainText . $mainSuf . $sufText;
            unset($preText); unset($mainPre); unset($mainText);
            unset($mainSuf); unset($sufText);
            $this->_tagDivider($text, $tag);
        } else {
            $text = str_replace('tmp' . $tag, $tag, $text);
        }
    }

    function _styleConvert($text, $tag) {
        $result = "";
        // フォントサイズ段階調整
        $size['x-small'] = 1;
        $size['small']   = 2;
        $size['medium']  = 3;
        $size['normal']  = 3;
        $size['large']   = 4;
        $size['x-large'] = 5;
        preg_match('/align\s*=\s*".*"/', $text, $tmpArray);
        $divArray  = explode('"', $tmpArray[0]);
        if ($divArray[1] != "") {
            $result['<tmp' . $tag . ' align="' . trim($divArray[1]) . '">'] = '</tmp' . $tag . '>';
        }
        preg_match('/style\s*=\s*".*"/', $text, $tmpArray);
        $divArray  = explode('"', $tmpArray[0]);
        $loopArray = explode(';', $divArray[1]);
        if (is_array($loopArray)) {
            $nobr = 1;
            foreach($loopArray As $value) {
                $data = explode(':', $value);
                if (is_array($data)) {
                    $name = trim($data[0]);
                    if ($name == 'color') {
                        $colorKey = '<font color="' . trim($data[1]) . '">';
                        $result[$colorKey] = '</font>';
                        $lastKey = $colorKey;
                    } else if ($name == 'font-size') {
                        $sizeKey = '<font size="' . $size[trim($data[1])] . '">';
                        $result[$sizeKey] = '</font>';
                        $lastKey = $sizeKey;
                    } else if ($name == 'text-align') {
                        $result['<tmp' . $tag . ' align="' . trim($data[1]) . '">'] = '</tmp' . $tag . '>';
                        $nobr = 0;
                    }
                }
            }
            if ($tag == 'div' && $lastKey != "" && $nobr = 1) {
                $result['<br>' . $lastKey] = '</font>';
            }
        }
        return $result;
    }

    function _fontConvert($text, $tag) {
        $result = "";
        preg_match('/color=".*"/', $text, $tmpArray);
        $divArray  = explode('"', $tmpArray[0]);
        if ($tmpArray[0] != "") {
            $result['<tmp' . $tag . " " .  $tmpArray[0] . '>'] = '</tmp' . $tag . '>';
        }
        preg_match('/size=".*"/', $text, $tmpArray);
        $divArray  = explode('"', $tmpArray[0]);
        if ($tmpArray[0] != "") {
            $result['<tmp' . $tag . " " . $tmpArray[0] . '>'] = '</tmp' . $tag . '>';
        }
        return $result;
    }

    function allConv() {
        $this->decoMail = preg_replace('/</' , "\r\n".'<' , $this->decoMail);
        $this->decoMail = preg_replace('/>/' , '>'."\r\n" , $this->decoMail);
        $this->_FckEmojiConv();
        $this->_decoMailImgConv();
        $this->_pc2telConv();
        $this->decoMail = preg_replace('/\r\n</',  '<', $this->decoMail);
        $this->decoMail = preg_replace('/\r\n\{/', '{', $this->decoMail);
        $this->decoMail = preg_replace('/>\r\n/',  '>', $this->decoMail);
        return true;
    }

    function checkMailLen() {
        $tmpStr = $this->decoMail;
        $tmpLen = strlen(base64_encode($tmpStr));
        $this->testDump($tmpLen, 'tmpLen', $this->testFlg);
        if ($tmpLen > $this->mailLenLimit) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function checkDecoMailImg() {
        $result = false;
        preg_match_all('/<img.*>/', $this->decoMail, $tmpArray);
        if (is_array($tmpArray[0])) {
            $domainStr = str_replace('.', '\.', $this->domain);
            foreach ($tmpArray[0] As $key => $value) {
                $tmpResult = preg_match('/^<img src="image_' . $domainStr . '/' , $value);
                if ($tmpResult == 0) {
                    $result = true;
                }
            }
        }
        return $result;
    }

//セッタ
    function setTest($value) {
        $this->testFlg = $value;
        return true;
    }

    function setDomain($value, $wwwFlg) {
        $this->domain = $value;
        if ($wwwFlg) {
            $wwwStr = 'www.';
        }else{
            $wwwStr = '';
        }
        $this->basePath = 'http://' . $wwwStr . $this->domain . '/';
        return true;
    }
    function setImgFolder($value) {
        $this->imgFolder = $value;
        return true;
    }
    function setDecoMail($value) {
        $this->decoMail = $value;
        return true;
    }
    function setImgList($value) {
        $this->imgList = $value;
        return true;
    }
    function set_xxxx($value) {
        $this->xxxx = $value;
        return true;
    }

//ゲッタ
    function getDecoMail() {
        return $this->decoMail;
    }
    function get_xxxx() {
        return $this->xxxx;
    }
}
?>
