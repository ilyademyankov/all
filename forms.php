<?php
class Forms{
   
    private $atributeName=Null;
	private $atributeValue=Null;   
    private $fieldValueVals=Null;
	private $fieldValueName=Null;
    private $fieldValueSelected=Null;
    private $fieldValue=Null;
    private $fieldLabel=Null;
    private $Value=Null;

  
  	public function setAtrubute($atributeName,$atributeValue){
      //Проверка наличия атрибута   Если есть заменеяем если нет добавляем
      $this->atributeName[]=$atributeName;
      $this->atributeValue[]=$atributeValue;
	} 
  
    public function clearAtrubute(){
      unset($this->atributeName);
      unset($this->atributeValue);
	} 
  
    public function setValue($fieldValue){
      $this->fieldValue=htmlspecialchars($fieldValue);
	} 
  
    public function setMultiValue($valueArray,$nameArray,$selected){
      $this->fieldValueVals=$valueArray;
      $this->fieldValueName=$nameArray;
      $this->fieldValueSelected=$selected;
	} 
  
	private function makeAtrubuteString(){
      for($i=0;$i<sizeof($this->atributeName);$i++){  
      	$atributeString.=$this->atributeName[$i].'="'.$this->atributeValue[$i].'" ';
      }
      return $atributeString;
	} 
  
	private function makeMultiValueString($type){
   	  if($type=='select'){
         for($i=0;$i<sizeof($this->fieldValueVals);$i++){
           if($i== $this->fieldValueSelected){$selected='selected';}else{$selected='';}
           $return.='<option value='.$this->fieldValueVals[$i].' '.$selected.'>'.$this->fieldValueName[$i].'</option>';
         }
      }
      return $return;
    }
  
  
	public function makeField($fieldType){
      $atributeString=$this->makeAtrubuteString();
      switch($fieldType){
          case 'form' :
		  	$return='<form '.$atributeString.'>';
		  break;
           case '/form' :
		  	$return='</form>';
		  break;
		  case 'input' :
		  	$return='<input type=text '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
          case 'textarea' :
		  	$return='<textarea '.$atributeString.'>'.$this->fieldValue.'</textarea>';
		  break;
          case 'submit' :
		  	$return='<input type=submit  '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
          case 'file' :
		  	$return='<input type=file  '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
          case 'password' :
		  	$return='<input type=password  '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
          case 'select' :
		  	$return='<select  '.$atributeString.'>'.$this->makeMultiValueString("select").'</select>';
		  break;
          case 'radio' :
		  	$return='<input type=radio '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
          case 'checkbox' :
		  	$return='<input type=checkbox '.$atributeString.' value="'.$this->fieldValue.'">';
		  break;
      }
      echo  $return; 
    } 
  
}




?>
