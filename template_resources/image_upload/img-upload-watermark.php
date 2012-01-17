<?php				

/*
							//1. create image thumbnails
							createThumb($_FILES['file']['tmp_name'][$i],$folder.'/thumbnails/'.$file_name[$i]);
					
							//2. resize and watermark images heres
							create_img($_FILES['file']['tmp_name'][$i],$folder.$file_name[$i],720,'../images/pro/water_mark.png')

*/


	//create a thumbnail image
	function createThumb($source,$dest,$thumb_width,$thumb_height) {
			 
		//check whether this is a valid image
			
		list($width,$height) = getimagesize($source);
		$thumb_width=$thumb_width;
		$thumb_height=$thumb_height;		
					 
		if($width>$height) {
			$new_width = $thumb_width;
			$diff=$new_width/$width;
			$new_height=$height*$diff;
		}
				  
		if($height>$width) {
			$new_height = $thumb_height;
			$diff=$new_height/$height;
			$new_width=$width*$diff;
		}
				  
		
		$new_im = imagecreatetruecolor($new_width,$new_height);
		$im = imagecreatefromjpeg($source);
		imagecopyresampled($new_im,$im,0,0,0,0,$new_width,$new_height,$width,$height);
				  
					
		if(imagejpeg($new_im,$dest,100))
			return true;
		else 
			return false;
	}
	
	function create_img($source,$dest,$thumb_width,$thumb_height,$overlay_img) {
		list($width,$height) = getimagesize($source);
				  
		$thumb_width=$thumb_width;
		$thumb_height=$thumb_height;		  
		//do resizing 
		if($width>$height) {
			$new_width = $thumb_width;
			$diff=$new_width/$width;
			$new_height=$height*$diff;
		}
				  
		if($height>$width) {
			$new_height = $thumb_height;
			$diff=$new_height/$height;
			$new_width=$width*$diff;
		}
	
		$new_im = imagecreatetruecolor($new_width,$new_height);
		$im = imagecreatefromjpeg($source);
		imagecopyresampled($new_im,$im,0,0,0,0,$new_width,$new_height,$width,$height);
		imagejpeg($new_im,$dest,100);
				  
		return watermarkset($dest,$dest,$overlay_img);		  
	}	
	
	function watermarkset($source,$destination,$watermark)
	{
		$disp_width_max=100;                    // used when displaying watermark choices
		$disp_height_max=100;                    // used when displaying watermark choices
		$edgePadding=0;                        // used when placing the watermark near an edge
		$quality=80;                           // used when generating the final image
		$wm_size =1.0;
		
				 $size=getimagesize($source);
					 if($size[2]==2 || $size[2]==3){
					// it was a JPEG or PNG image, so we're OK so far
					
					$original=$source;
	
					$target=$destination;
					
					$wmTarget=$watermark.'.tmp';
	
					$origInfo = getimagesize($original); 
					$origWidth = $origInfo[0]; 
					$origHeight = $origInfo[1]; 
	
					$waterMarkInfo = getimagesize($watermark);
					$waterMarkWidth = $waterMarkInfo[0];
					$waterMarkHeight = $waterMarkInfo[1];
			
	
						$waterMarkDestWidth=round($origWidth * floatval($wm_size));
						$waterMarkDestHeight=round($origHeight * floatval($wm_size));
	
	
					// OK, we have what size we want the watermark to be, time to scale the watermark image
					resize_png_image($watermark,$waterMarkDestWidth,$waterMarkDestHeight,$wmTarget);
					
					// get the size info for this watermark.
					$wmInfo=getimagesize($wmTarget);
					$waterMarkDestWidth=$wmInfo[0];
					$waterMarkDestHeight=$wmInfo[1];
	
					$differenceX = $origWidth - $waterMarkDestWidth;
					$differenceY = $origHeight - $waterMarkDestHeight;
	
	
					$placementX = $origWidth - $waterMarkDestWidth - $edgePadding;
	
					$placementY = $origHeight - $waterMarkDestHeight - $edgePadding;
	
					$resultImage = imagecreatefromjpeg($original);
					imagealphablending($resultImage, TRUE);
			
					$finalWaterMarkImage = imagecreatefrompng($wmTarget);
					$finalWaterMarkWidth = imagesx($finalWaterMarkImage);
					$finalWaterMarkHeight = imagesy($finalWaterMarkImage);
			
					imagecopy($resultImage,
							  $finalWaterMarkImage,
							  $placementX,
							  $placementY,
							  0,
							  0,
							  $finalWaterMarkWidth,
							  $finalWaterMarkHeight
					);
					
					if($size[2]==3){
						imagealphablending($resultImage,FALSE);
						imagesavealpha($resultImage,TRUE);
						imagepng($resultImage,$target,$quality);
					}else{
						imagejpeg($resultImage,$target,$quality); 
					}
	
					imagedestroy($resultImage);
					imagedestroy($finalWaterMarkImage);
					return true;
					
				}
	
	}
	
	function resize_png_image($img,$newWidth,$newHeight,$target){
		$srcImage=imagecreatefrompng($img);
		if($srcImage==''){
			return FALSE;
		}
		$srcWidth=imagesx($srcImage);
		$srcHeight=imagesy($srcImage);
		$percentage=(double)$newWidth/$srcWidth;
		$destHeight=round($srcHeight*$percentage)+1;
		$destWidth=round($srcWidth*$percentage)+1;
		if($destHeight > $newHeight){
			// if the width produces a height bigger than we want, calculate based on height
			$percentage=(double)$newHeight/$srcHeight;
			$destHeight=round($srcHeight*$percentage)+1;
			$destWidth=round($srcWidth*$percentage)+1;
		}
		$destImage=imagecreatetruecolor($destWidth-1,$destHeight-1);
		if(!imagealphablending($destImage,FALSE)){
			return FALSE;
		}
		if(!imagesavealpha($destImage,TRUE)){
			return FALSE;
		}
		if(!imagecopyresampled($destImage,$srcImage,0,0,0,0,$destWidth,$destHeight,$srcWidth,$srcHeight)){
			return FALSE;
		}
		if(!imagepng($destImage,$target)){
			return FALSE;
		}
		imagedestroy($destImage);
		imagedestroy($srcImage);
		return TRUE;
	}
	function get_ext($key) { 
		$key=strtolower(substr(strrchr($key, "."), 1));
		// Cause there the same right?
		$key=str_replace("jpeg","jpg",$key);
		return $key;
	}

	
?>