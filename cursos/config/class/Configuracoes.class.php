<?php
class Configuracoes extends Database{
  //atributos
  var $idConfig;
  var $nomeEmpresa;
  var $logo;
  var $whatsApp;
  var $email;
  var $site;
  var $rodape;
  var $cabecalho;
  
  //construtor
  function __construct(){
    parent::__construct();
    $this->idConfig = "NULL";
    $this->nomeEmpresa = "NULL";
    $this->logo = "NULL";
    $this->whatsApp = 0;
    $this->email = "NULL";
	$this->site = "NULL";
	$this->rodape = "NULL";
	$this->cabecalho = "NULL";
  }

  function __destruct(){
    parent::__destruct();
  }
  
   // Method's Set's
   function setIdConfig($value){
    $this -> idConfig = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setNomeEmpresa($value){
    $this -> nomeEmpresa = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setLogo($value){
    $this -> logo = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setWhatsApp($value){
    $this -> whatsApp = ($value) ? $this -> gravarBD($value) : "0";
  }
  
  function setEmail($value){
    $this -> whatsApp = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setSite($value){
    $this -> site = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setRodape($value){
    $this -> rodape = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setCabecalho($value){
    $this -> cabecalho = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
   // Method's Get's
  function getIdConfig(){
    return $this -> idConfig;
  }

  function getNomeEmpresa(){
    return $this -> nomeEmpresa;
  }

  function getLogo(){
    return $this -> logo;
  }
  
  function getWhatsApp(){
    return $this -> whatsApp;
  }
  
   function getEmail(){
    return $this -> email;
  }
  
  function getSite(){
    return $this -> site;
  }
   
  function getRodape(){
    return $this -> rodape;
  }
  
  function getCabecalho(){
    return $this -> cabecalho;
  }
  
  //Add Config
  function addConfig(){
    $sql = "INSERT INTO configuracoes (INSERT INTO `configuracoes` (`nomeEmpresa`, `logo`, `whatsApp`, `email`, `site`, `rodape`, `cabecalho`)
				VALUES ($this->nomeEmpresa, $this->logo, $this->whatsApp, $this->email, $this->site, $this->rodape, $this>cabecalho)";
    $result = $this -> query($sql, true);
    return mysql_insert_id($this -> connect);
  }
  
  //Delete Config
  function deleteConfig(){
    $sql = "UPDATE configuracoes SET excluido = 1 WHERE idConfig = $this->idConfig";
    $result = $this -> query($sql, true);
  }
  
  //update Campos
  function updateConfigField($field, $value){
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE configuracoes SET " . $field . " = " . $value . " WHERE idConfig = $this->idConfig";
    $result = $this -> query($sql, true);
  }
  
  //update Todos os campos
   function updateConfig(){    
    $sql = "UPDATE `configuracoes` SET `nomeEmpresa` = $this->nomeEmpresa, `logo` = $this->logo, `whatsApp` = $this->whatsApp, `email` = $this->email, `site` = $this->site, `rodape` = $this->rodape, `cabecalho` = $this>cabecalho WHERE `idConfig` = $this->idConfig";
    $result = $this -> query($sql, true);
  }
  
  //Select Config
  function selectConfig($where = "WHERE 1"){
    $sql = "SELECT `configuracoes`.`idConfig`, `configuracoes`.`nomeEmpresa`, `configuracoes`.`logo`,`configuracoes`.`whatsApp`, `configuracoes`.`email`, `configuracoes`.`site`, `configuracoes`.`rodape`, `configuracoes`.`cabecalho` FROM `sistemac_bd`.`configuracoes`" . $where;
    return $this -> executeQuery($sql);
  }
  
function selectConfigTr($where = "", $apenasLinha = false){

      $sql = "SELECT `configuracoes`.`idConfig`, `configuracoes`.`nomeEmpresa`, `configuracoes`.`logo`,`configuracoes`.`whatsApp`,`configuracoes`.`email`, `configuracoes`.`site`,  `configuracoes`.`rodape`, `configuracoes`.`cabecalho` FROM `sistemac_bd`.`configuracoes`" . $where;
      $result = $this -> query($sql);
      $html = "";
      

      $caminhoAtualizar_base = CAMINHO_BIBLIOTECA . "Config/index.php";
     
      
      while ($valor = mysql_fetch_array($result)){
        
        $idConfig = $valor['idConfig'];
        $nomeEmpresa = $valor['nomeEmpresa'];
        $logo = $valor['logo'];
        $whatsApp = $valor['whatsApp'];
        $email = $valor['email']; 
		$site = $valor['site']; 
		$rodape = $valor['rodape'];
		$cabecalho = $valor['cabecalho']; 
		    
        $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idConfig=" . $idConfig;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
          
        }
        
        $onclick = " onclick=\"abrirNivelPagina(this, '". CAMINHO_CFG ."/ConfigForm.php?idConfig=$idConfig', '".$caminhoAtualizar."', 'tr')\" ";

     /*   $delete = "<center>
          <img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_CFG . "Config/acao.php?acao=deletar', '" . $idConfig . "', '".$caminhoAtualizar."', 'tr')\" />
        </center>";      */

          $html .= "<tr >";

          $html .= "<td $onclick >" . $nomeEmpresa . "</td>";

          $html .= "<td $onclick align=\"center\" >" . $logo . "</td>";

          $html .= "<td align=\"center\" >" . $whatsApp . "</td>";
          
          $html .= "<td align=\"center\" >" . $email . "</td>";
		  
		  $html .= "<td align=\"center\" >" . $site . "</td>";
          
          $html .= "<td align=\"center\" >" . $rodape . "</td>";         

          $html .= "<td align=\"center\" >".$cabecalho."</td>";

          $html .= "</tr>";     
      
    }
    
    return $html;
  }

  


} 
?>