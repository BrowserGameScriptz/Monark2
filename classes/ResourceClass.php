<?php

namespace app\classes;

use Yii;

/**
 * 
 * @author Paul
 *
 */
class ResourceClass{
	
	private $resource_id;
	private $resource_name;
	private $resource_freq;
	private $resource_img;
	private $resource_building_id;
	private $resource_description;
	
	/**
	 *
	 */
	public function __construct($resourceData) {
		$this->resourceId 				= $resourceData['resource_id'];
		$this->resourceName 			= $resourceData['resource_name'];
		$this->resourceFreq 			= $resourceData['resource_freq'];
		$this->resourceImage 			= $resourceData['resource_img'];
		$this->resourceBuildingId 		= $resourceData['resource_building_id'];
		$this->resourceDescription 		= $resourceData['resource_description'];
	}
	
	public function getResourceId(){
		return $this->resourceId;
	}
	
	public function getResourceName(){
		return Yii::t('resource', $this->resourceName);
	}
	
	public function getResourceDescription(){
		return Yii::t('resource', $this->resourceDescription);
	}
	
	public function getResourceFreq(){
		return $this->resourceFreq;
	}

	public function getResourceImage(){
		return $this->resourceImage;
	}
	
	public function getResourceImageUrl(){
		if (strpos($this->resourceImage, '.png') === false)
			return "<i class='".$this->resourceImage."'></i>";
		else
			return "<img src='img/game/".$this->resourceImage."' height='20px' width='20px'>";
		
	}
	
	public function getResourceBuildingId(){
		return $this->resourceBuildingId;
	}
	
}