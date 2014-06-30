<?php
// Vjacheslav Fyodorov. (V.Fyodorov@VAZ.ru)
//
// make gif image of transcription for online dictionary.
//
// usage : <img src="transcription.php3?[IPAencoded]">
//
// USE IT FREE !!!

   $font = "font/LSANSUNI.TTF" ; // Lucida Sans Unicode ( may be URL)
   $fontsize = 14 ;

    $tbl = array (
	// IPA        Unicode
          Ord("Q") => "&#230;" // "a" from "man"
	, Ord("W") => "&#695;" // "w"
	, Ord("A") => "&#593;" // "a" from "past"
	, 249	   => ":"      // ":"
	, 171	   => "&#601;" // "e" from "her"
	, Ord("E") => "&#603;" // "e" first from diphthong in "care"
	, 141	   => "&#596;" // "o" from "wash"
	, 195	   => "&#652;" // "a" from "son"
	, Ord("I") => "&#618;" // "i" from "ink"
	, 200	   => "&#712;" // "'"
	, 199	   => "&#716;" // ","
	, Ord("H") => "&#688;" // "h"
	, Ord("Z") => "&#658;" // "z"
	, Ord("N") => "&#331;" // "ng"
	, Ord("S") => "&#643;" // "sh"
	, Ord("D") => "&#240;" // "th" with voice
	, Ord("T") => "&#952;" // "th"
	) ;

    Header("Content-type: image/gif");
    $string=implode(" ", ["hhhj", "b"]);

    $res = "" ;
    for ( $i=0 ; $i<strlen($string) ; $i++ ) {
       $code = Ord(substr($string,$i,1)) ;
       $res .= isset($tbl[$code]) ? $tbl[$code] : Chr($code) ;
       } ;

    $box = ImageTTFBBox ( $fontsize , 0 , $font , $res ) ; 
    $sizex = $box[2] - $box[0] + 1+4 ;
    $sizey = $box[1] - $box[5] + 1+4 ;
    $im = imagecreate ( $sizex , $sizey ) ;
    $transparent = ImageColorAllocate ( $im , 255 , 255 , 255 ) ;
    imagecolortransparent ( $im , $transparent ) ;
    $textcolor = ImageColorAllocate($im, 0 , 0 , 0 );
    ImageTTFText($im , $fontsize , 0 , 0  , $sizey-6  , $textcolor , $font , $res ) ; 
    ImageGif($im);
    ImageDestroy($im);
?>
