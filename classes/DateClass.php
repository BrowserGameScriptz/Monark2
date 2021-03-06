<?php 

namespace app\classes;

use Yii;

/**
* Class permettant de formater une date
*/

class DateClass
{

	private $time;
	private $timeElapsed;
	
	/**
	 * 
	 * @param unknown $time
	 */
	public function __construct($time){
		$this->time = $time;
	}
	
	/**
	 * 
	 */
	private function timeElapsedToString()
	{    
	   $periods = array(Yii::t('time', 'Second'), Yii::t('time', 'Minute'), Yii::t('time', 'Hour'), Yii::t('time', 'Day'), Yii::t('time', 'Week'), Yii::t('time', 'Month'), Yii::t('time', 'Year'), Yii::t('time', 'Decade'));
	   $lengths = array("60","60","24","7","4.35","12","10");
	
	   $now = time();
	
	   $difference     = $now - $this->time;
	
	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }
	
	   $difference = round($difference);
	
	   if($difference != 1) {
	       $periods[$j].= "s";
	   }
	
	  $this->timeElapsed = Yii::t('time', 'Before_Ago')." $difference $periods[$j] ".Yii::t('time', 'After_Ago');
	}
	
	/**
	 * 
	 * @return string
	 */
	public function showTimeElapsed(){
		$this->timeElapsedToString();
		return $this->timeElapsed;
	}
	
}

?>