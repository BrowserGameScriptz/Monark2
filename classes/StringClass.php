<?php 

namespace app\classes;

/**
* Class permettant de formater un string
*/

class StringClass
{

	private $string;
	
	/**
	 * 
	 * @param unknown $string
	 */
	public function __construct($string){
		$this->string = $string;
	}
	
	/**
	 * 
	 * @param unknown $count
	 * @return string
	 */
	public function getStringAbstract($count){
		$returned = "";
		for($i = 0; $i < strlen($this->string) && $i < $count; $i++)
			$returned.= $this->string[$i];
		$returned .= "...";
		return $returned;
	}
	
}

?>