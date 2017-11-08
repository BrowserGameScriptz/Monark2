<?php 
namespace app\classes;

use yii\db\Exception;

class ColorUtil{
	
	public static function colorizeBasedOnAplhaChannnel( $file, $targetR, $targetG, $targetB, $targetName ) {
	
		$im_src = imagecreatefrompng($file);
	
		$width = imagesx($im_src);
		$height = imagesy($im_src);
	
		$im_dst = imagecreatefrompng( $file );
	
		// Note this:
		// Let's reduce the number of colors in the image to ONE
		imagefilledrectangle( $im_dst, 0, 0, $width, $height, 0xFFFFFF );
	
		for($x=0; $x<$width; $x++ ) {
			for( $y=0; $y<$height; $y++ ) {
	
				$alpha = ( imagecolorat( $im_src, $x, $y ) >> 24 & 0xFF );
	
				$col = imagecolorallocatealpha( $im_dst,
						/*$targetR - (int) ( 1.0 / 255.0  * $alpha * (double) $targetR ),
						 $targetG - (int) ( 1.0 / 255.0  * $alpha * (double) $targetG ),
				$targetB - (int) ( 1.0 / 255.0  * $alpha * (double) $targetB ),*/
						$targetR,
						$targetG,
						$targetB,
						$alpha
						);
	
				if ( false === $col ) {
                    throw(new Exception('sorry, out of colors...'));
				}
	
				imagesetpixel( $im_dst, $x, $y, $col );
	
			}
	
		}
	
		imagepng($im_dst, $targetName);
		imagedestroy($im_dst);
	
		/* Transparent */
		self::changeimagetransparent($targetName);
	}
	
	public static function changeimagetransparent($targetName){
		$im_src = imagecreatefrompng($targetName);
	
		//Color which will be transparent
		$white = imagecolorallocate($im_src, 255, 255, 255);
		// Make the image transparent
		imagecolortransparent($im_src, $white);
		 
		imagepng($im_src, $targetName);
		imagedestroy($im_src);
	}
}
?>