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
	
	public function botAddResult($result){
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