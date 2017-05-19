<?php

/**
 * SafeQuery Class
 *
 * @category  Database Safe query
 * @author    Alexeev-Demiankov Ilya <job@ialexeev.ru>
 * @version   1.0
 
types vars 
?iN?:integer
?dN?:double
?sN?:string
N - number of var 1..N

functions:
  Query - return array of vars
  NumRows - return number rows in result
  LastInsertID
  

Using example
SetQuery("INSERT INTO products(...) values(?s1?,?s2?,?i3?,?d4?) ",array('text1','text2',5,'3,45'));

*/


class SafeQuery{  
	public $sqlConnect=Null;
  	public $typeResult="row";
  	private $sqlResult=Null;
	private $stringQuery;	
  
    public function MakeQuery(){
    	$this->sqlResult=$this->sqlConnect->query($this->stringQuery);
      	return $this->sqlResult->fetch_all();
      
    }
  
  	public function SetQuery($stringQuery,$arrayVals){     
          preg_match_all("/\?.[0-9]*\?/", $stringQuery, $matches);
          $i=0;
          foreach($matches[0] as $match){
            $value=$this->CheckValue($match[1],$arrayVals[$i]); 
            $stringQuery=str_replace($match,$value,$stringQuery);
            $i++;  
          }
           $this->stringQuery=$stringQuery;   	 
    }
  
	public function NumRows(){
    	return $this->sqlResult->num_rows;
    }
  
 	 public function LastInsertID(){
    	return $this->sqlResult->insert_id;
   	 }
  

  	
  	private function InjectWarning($value){
      	$warningArray=array('INSERT','UPDATE','DROP','DELETE','SELECT'); 
      	foreach($warningArray as $warningValue){
			if(preg_match("/".$warningValue."/i",$value)){print "<p>Подозрительное значение $warningValue в переменной $value</p>";}
        }
    }
  		
  
	private function CheckValue($type,$value){
      	    $this->InjectWarning($value); 
		switch($type){
			case 'i' :
            	$return=preg_replace('/[^0-9]/', '', $value);
            break;
            case 'd' :
            	$value=str_replace(',','.',$value);
            	$return=preg_replace('/[^0-9.]/', '', $value);
            break;
            case 's' :
            	$return=htmlspecialchars("$value", ENT_QUOTES);
            	$return="'".$return."'";
            break;
        }
        	 return $return;
        }
  
 

}
?>
