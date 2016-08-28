<?php 
namespace app\bot;

class BotLog extends \yii\base\Object
{
	private $bot;
	private $print;
	private $result;
	
	public function __construct($bot, $print=null){
		$this->bot = $bot;
		$this->print = $print;
		$this->result = "<pre>";
	}
	
	public function botAddActionBegin($action){
		$this->result .= time()." : ** Begin Action	 ::: ".$action." ** <br>";
	}
	
	public function botAddResult($result, $land_id=null, $gold=null){
		if($land_id != null)
			$this->result .= "Land = ".$land_id." ";
		if($gold != null)
			$this->result .= "Gold = ".$gold." ";
		$this->result .= $result."<br>";
	}
	
	public function botAddEndAction($action){
		$this->result .= time()." : -- End Action	 ::: ".$action." -- <br>";
	}
	
	public function botShowLogs(){
		//if($this->print){
			$this->result .= "</pre>";
			return $this->result;
		/*}
		return "";*/
	}
}
?>