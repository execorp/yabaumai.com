<?
//クラス概要
//○○(axis,sky,exe等).php依存からの脱却用。クラス本来の使い方とは異なる。
//09/12/11　ver 1.00　作成（takeoka）

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
