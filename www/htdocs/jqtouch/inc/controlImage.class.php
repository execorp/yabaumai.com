<?
//クラス概要
//このクラスは画像変換クラスです。
/*

//このクラスの使い方の例
//初期化
$editImage = new controlImage($path,$type);
//取得ファイルが画像かどうかを調べる
if ( $editImage->typeImage() ) {
    //画像だった場合与えられた条件に沿ってリサイズを行い、ファイルサイズを変数に代入する
    $size = $editImage->resizeImage($imgMaxWidth,$imgMaxHeight,$quality,$save_path);
    //画像の幅
    $width = $editImage->getImageWidth();
    //画像の高さ
    $height = $editImage->getImageHeight();
    //データ部分
    $contents = "0x" . bin2hex( $editImage->getContents());
}
*/

//クラス構成

//メンバー変数
//$filePath     (str)       ファイルのパス
//$fileType     (str)       image/X形式でのファイルの種類
//$fileSize     (int)       ファイルサイズ
//$fileWidth    (int)       画像の幅
//$fileHeight   (int)       画像の高さ
//$fileContents (contents)  画像そのもの

//メンバー関数
//名称　controlImage
//動作　初期化処理
//入力　$path(str)ファイルのパス
//　　　$type(str)image/X形式でのファイルの種類
//　　　$size(int)ファイルサイズ・省略可

//名称　resizeImage
//動作　縦横の比率が狂わないように幅と高さを合わせてリサイズする
//入力　$imgMaxWidth(int)最大幅
//　　　$imgMaxHeight(int)最大高さ
//　　　$quality(int)品質
//　　　$savePath(str)サーバー上で一時的に保存するためのフォルダのパス
//出力　(int)リサイズ後のファイルサイズ

//名称　typeImage
//動作　画像判定、$fileTypeが画像の時は真、画像以外の時は偽を返す
//出力　(bool)真偽

//セッタ
//setFileSize
//入力　なし
//操作　現在の$fileContentsを基準にしてファイルサイズを計算する

//setContents   
//入力　画像パス
//操作　画像そのもの

//setImageSize  
//入力　画像パス
//操作　幅と高さ

//ゲッタ
//getContents
//getImageWidth
//getImageHeight
//getFileSize

class controlImage
{
    var $filePath;
    var $fileType;
    var $fileSize;
    var $fileWidth;
    var $fileHeight;
    var $fileContents;

    function controlImage( $path, $type ,$size = "" ) {
        $this->filePath = $path;
        $this->fileType = $type;
        if ( $this->typeImage() ) {
            $this->setContents( $this->filePath );
            if ( is_numeric($size) ) {
                $this->fileSize = $size;
            } else {
                $this->setFileSize();
            }
            $this->setImageSize($this->filePath);
        }
    }

    function resizeImage( $imgMaxWidth, $imgMaxHeight , $quality=100 ,$savePath="" ) {
        $type = $this->fileType;
        $size['0'] = $this->fileWidth;
        $size['1'] = $this->fileHeight;
        if ( ( $size['0'] > $imgMaxWidth || $size['1'] > $imgMaxHeight ) &&
             ( $type == "image/jpeg" || $type == "image/pjpeg" ) ) {
            
            $handle = imagecreatefromstring( $this->fileContents );
            $reSize = $size;
            //アスペクト比固定処理
            $tmpW = $size['0'] / $imgMaxWidth;
            if( $imgMaxHeight != 0 ){
                $tmpH = $size['1'] / $imgMaxHeight;
            }
            if ( $tmpW > 1 || $tmpH > 1 ) {
                if ( $imgMaxHeight == 0 ) {
                    if ( $tmpW > 1 ) {
                        $reSize['0'] = $imgMaxWidth;
                        $reSize['1'] = $size['1'] * $imgMaxWidth / $size['0'];
                    }
                } else {
                    if ( $tmpW > $tmpH ) {
                        $reSize['0'] = $imgMaxWidth;
                        $reSize['1'] = $size['1'] * $imgMaxWidth / $size['0'];
                    } else {
                        $reSize['1'] = $imgMaxHeight;
                        $reSize['0'] = $size['0'] * $imgMaxHeight / $size['1'];
                    }
                }
            }
            $imgNew = ImageCreateTrueColor( $reSize['0'],  $reSize['1'] );
            $imgDef = $handle;
            $prtTime = date("H:i:s", (time() - date("Z")) + 9 * 3600);
            $prtMd5 = MD5($prtTime);
            $prtMd5Access = $savePath . $prtMd5;
            ImageCopyResampled( $imgNew,  $imgDef,  0,  0,  0,  0, $reSize['0'], $reSize['1'], $size['0'], $size['1'] );
            ImageJpeg( $imgNew, $prtMd5Access , $quality );
            ImageDestroy( $imgDef );
            ImageDestroy( $imgNew );
            $this->setContents( $prtMd5Access );
            $this->setFileSize();
            $this->setImageSize( $prtMd5Access );
            unlink ( $prtMd5Access );
        }
        $result = $this->fileSize;
        return $result;
    }

    function typeImage() {
        switch ( $this->fileType ) {
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/gif':
            case 'image/png':
            case 'image/x-png':
                $result = true;
                break;
            default:
                $result = false;
                break;
        }
        if ( $result === false ) {
            $filePathExp = explode(".",$this->filePath);
            if ( $filePathExp[ count($filePathExp) - 1 ] == 'gif') {
                $this->fileType = 'image/gif';
                $result = true;
            }
        }
        return $result;
    }
//セッタ
    function setContents( $value ) {
        $this->fileContents = file_get_contents( $value );
        return true;
    }

    function setFileSize() {
        $this->fileSize = strlen( $this->fileContents );
        return true;
    }

    function setImageSize($value) {
        list( $this->fileWidth, $this->fileHeight ) = getimagesize( $value );
        return true;
    }
//ゲッタ
    function getContents() {
        return $this->fileContents;
    }

    function getImageWidth() {
        return $this->fileWidth;
    }

    function getImageHeight() {
        return $this->fileHeight;
    }

    function getFileSize() {
        return $this->fileSize;
    }

    function getFileType() {
        return $this->fileType;
    }
}
?>
