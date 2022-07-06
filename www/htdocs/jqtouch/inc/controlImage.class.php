<?
//�N���X�T�v
//���̃N���X�͉摜�ϊ��N���X�ł��B
/*

//���̃N���X�̎g�����̗�
//������
$editImage = new controlImage($path,$type);
//�擾�t�@�C�����摜���ǂ����𒲂ׂ�
if ( $editImage->typeImage() ) {
    //�摜�������ꍇ�^����ꂽ�����ɉ����ă��T�C�Y���s���A�t�@�C���T�C�Y��ϐ��ɑ������
    $size = $editImage->resizeImage($imgMaxWidth,$imgMaxHeight,$quality,$save_path);
    //�摜�̕�
    $width = $editImage->getImageWidth();
    //�摜�̍���
    $height = $editImage->getImageHeight();
    //�f�[�^����
    $contents = "0x" . bin2hex( $editImage->getContents());
}
*/

//�N���X�\��

//�����o�[�ϐ�
//$filePath     (str)       �t�@�C���̃p�X
//$fileType     (str)       image/X�`���ł̃t�@�C���̎��
//$fileSize     (int)       �t�@�C���T�C�Y
//$fileWidth    (int)       �摜�̕�
//$fileHeight   (int)       �摜�̍���
//$fileContents (contents)  �摜���̂���

//�����o�[�֐�
//���́@controlImage
//����@����������
//���́@$path(str)�t�@�C���̃p�X
//�@�@�@$type(str)image/X�`���ł̃t�@�C���̎��
//�@�@�@$size(int)�t�@�C���T�C�Y�E�ȗ���

//���́@resizeImage
//����@�c���̔䗦������Ȃ��悤�ɕ��ƍ��������킹�ă��T�C�Y����
//���́@$imgMaxWidth(int)�ő啝
//�@�@�@$imgMaxHeight(int)�ő卂��
//�@�@�@$quality(int)�i��
//�@�@�@$savePath(str)�T�[�o�[��ňꎞ�I�ɕۑ����邽�߂̃t�H���_�̃p�X
//�o�́@(int)���T�C�Y��̃t�@�C���T�C�Y

//���́@typeImage
//����@�摜����A$fileType���摜�̎��͐^�A�摜�ȊO�̎��͋U��Ԃ�
//�o�́@(bool)�^�U

//�Z�b�^
//setFileSize
//���́@�Ȃ�
//����@���݂�$fileContents����ɂ��ăt�@�C���T�C�Y���v�Z����

//setContents   
//���́@�摜�p�X
//����@�摜���̂���

//setImageSize  
//���́@�摜�p�X
//����@���ƍ���

//�Q�b�^
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
            //�A�X�y�N�g��Œ菈��
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
//�Z�b�^
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
//�Q�b�^
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
