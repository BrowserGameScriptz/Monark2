<?php 
use app\models\Land;
use app\models\Color;
use app\models\Map;
use app\classes\ColorUtil;

		$urlSrc = "img/land/";
		$urlTemp = "img/land_temp/";
		$urlRoot = "web/";
        $Colors = Color::findAllColorToArray(null, null);
		$Maps = Map::findAllMap();
        
		foreach ($Maps as $key => $map) {
			
			$Lands = Land::findAllLandsToArray($map['map_id']);
			
	        foreach ($Lands as $key => $land) {
	
	            // Unassigned land
	            /*if($this->mapgamedata[$land['id']-1]['user_id'] == 0){
	                $user_info['color_id'] = 1;
	                $color['name'] = "grey";
	                $color['fr'] = "Gris";
	                $color_explode = array('0x80', '0x80', '0x80');
	            }*/
	
	            foreach ($Colors as $key => $color) {
	            	
	                // Color & image & temp image gestion
	                $imgSrc = $land->getLandImageUrl();
	                $imgTemp = $land->getLandImageTempUrl($color->getColorName2());
	                $colorExplode = explode(';', $color->getColorCode());
	
	                // Folder Temp image gestion
	                if ( !file_exists($urlTemp) ) {
	                  mkdir ($urlTemp, 0744);
	                }
	                
	                // Temp image gestion
	                if(file_exists($imgSrc)){
	                	
	                    // Create temp image
	                    if(!file_exists($imgTemp)){
	                        
	                    	print "Image ".$imgTemp." crée<br>";
	                    	
	                        /* New temp image */
	                        ColorUtil::colorizeBasedOnAplhaChannnel(
	                            $imgSrc,
	                            $colorExplode[0],
	                            $colorExplode[1],
	                            $colorExplode[2],
	                            $imgTemp
	                        );
	                    }
	                }
	            }
	        }
		}
?>