<?
//�N���X�T�v
//����(axis,sky,exe��).php�ˑ�����̒E�p�p�B�N���X�{���̎g�����Ƃ͈قȂ�B
//09/12/11�@ver 1.00�@�쐬�itakeoka�j

class decoFunction
{
    function stripSlushR( $text ){
        $textStriped = ereg_replace( "\\\\r", "", $text );
        $textStriped = ereg_replace( "\\\\n", "", $textStriped );
        return $textStriped;
    }

    function stripSlushR4mail( $text ){
        $textStriped = ereg_replace( "\\\\r", " ", $text );
        $textStriped = ereg_replace( "\\\\n", "", $textStriped );
        return $textStriped;
    }
}
?>
