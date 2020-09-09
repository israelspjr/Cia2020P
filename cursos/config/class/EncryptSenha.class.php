<?php
Class EncryptSenha{
	 	
	function __construct() {
  }

  	function __destruct() {
  }

	static function B64_Encode($value){
		if(($value!="")||($value!=null)||($value=NULL)){
			
			$resp = base64_encode($value);
			
		} else {
			
			$resp = null;
		}
		
		
		return $resp;
	}
    static function B64_Decode($value){
    if(($value!="")||($value!=null)||($value=NULL)){
      
      $resp = base64_decode($value);
      
    } else {
      
      $resp = null;
    }
    
    
    return $resp;
  }
	
}
?>