<?php
class WorkshopPresenca extends Database{
    
  var $idpresenca;
  var $workshop_idWorkshop;
  var $professor_idProfessor;
  var $funcionario_idFuncionario;
  var $dataInscricao;
  var $confirmacao;  
  var $dataConfirmacao;
  var $falta;
  var $justificativa;
  var $duracao;
  var $aprovado;
  
  function __construct() {
    parent::__construct(); 
    $this -> idpresenca = "NULL";
    $this -> workshop_idWorkshop = "NULL";
    $this -> professor_idProfessor = "NULL";
    $this -> funcionario_idFuncionario  = "NULL";
    $this -> dataInscricao = "NULL";
    $this -> confirmacao = 0; 
    $this -> dataConfirmacao = "NULL";
    $this -> falta = "NULL";
    $this -> justificativa = "NULL";
	$this -> duracao = "NULL";
	$this -> aprovado = "0";
  }
  
  function __destruct() {
    parent::__destruct();
  }
  
  function setIdPresenca($value){
    $this -> idpresenca = ($value) ? $this -> gravarBD($value) : "NULL"; 
  }
  
  function setWorkshop_idWorkshop($value){
    $this -> workshop_idWorkshop = ($value) ? $this -> gravarBD($value) : "NULL"; 
  }
  
  function setProfessor_idProfessor($value){
    $this -> professor_idProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setFuncionario_idFuncionario($value){
    $this -> funcionario_idFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setDataInscricao($value){
    $this -> dataInscricao = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
  }
  
  function setConfirmacao($value){
    $this -> confirmacao = ($value) ? $this -> gravarBD($value) : 0;
  }
  
  function setDataConfirmacao($value){
    $this -> dataConfirmacao = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
  }
    
  function setFalta($value){
    $this -> falta = ($value) ? $this -> gravarBD($value) : 0; 
  }
  
  function setJustificativa($value){
    $this -> justificativa = ($value) ? $this -> gravarBD($value) : "NULL";   
  }
  
  function setDuracao($value){
    $this -> duracao = ($value) ? $this -> gravarBD($value) : "NULL";   
  }
  
   function setAprovado($value){
    $this -> aprovado = ($value) ? $this -> gravarBD($value) : "0";   
  }
  
 function getIdPresenca(){
    return $this -> idpresenca; 
  }
  
  function getWorkshop_idWorkshop(){
    return $this -> workshop_idWorkshop; 
  }
  
  function getProfessor_idProfessor(){
    return $this -> professor_idProfessor;
  }
  
  function getFuncionario_idFuncionario(){
    return $this -> funcionario_idFuncionario;
  }
  
  function getDataInscricao(){
    return $this -> dataInscricao;
  }
  
  function getConfirmacao(){
    return $this -> confirmacao;
  }
  
  function getDataConfirmacao(){
    return $this -> dataConfirmacao;
  }
    
  function getFalta(){
    return $this -> falta; 
  }
  
  function getJustificativa(){
    return $this -> justificativa;   
  }
  
  function addPresenca() {
    $sql = "INSERT INTO presenca (workshop_idWorkshop, professor_idProfessor, funcionario_idFuncionario, dataInscricao, confirmacao, dataConfirmacao, falta, justificativa, duracao, aprovado) VALUES ($this->workshop_idWorkshop, $this->professor_idProfessor, $this->funcionario_idFuncionario, $this->dataInscricao, $this->confirmacao, $this->dataConfirmacao, $this->falta, $this->justificativa, $this->duracao, $this->aprovado)";
//	echo $sql;
    $result = $this -> query($sql, true);
    return $this -> connect;
  }

  /**
   * deleteEnderecoVirtual() Function
   */
  function deletePresenca() {
    $sql = "DELETE FROM presenca WHERE idpresenca = $this->idpresenca";
	
    $result = $this -> query($sql, true);
  }

  /**
   * updateFieldEnderecoVirtual() Function
   */
  function updateFieldPresenca($field, $value) {
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE presenca SET " . $field . " = " . $value . " WHERE idpresenca = $this->idpresenca";
    $result = $this -> query($sql, true);
  }

  /**
   * updateEnderecoVirtual() Function
   */
  function updatePresenca() {
    $sql = "UPDATE presenca SET workshop_idWorkshop = $this->workshop_idWorkshop, professor_idProfessor = $this->professor_idProfessor, funcionario_idFuncionario = $this->funcionario_idFuncionario, dataInscricao = $this->dataInscricao, confirmacao = $this->confirmacao, dataConfirmacao = $this->dataConfirmacao, falta = $this->falta, justificativa = $this->justificativa, duracao = $this->duracao, aprovado = $this->aprovado WHERE idpresenca = $this->idpresenca";
    $result = $this -> query($sql, true);
  }

  function selectPresenca($where = "WHERE 1") {
    $sql = "SELECT SQL_CACHE idpresenca, workshop_idWorkshop, professor_idProfessor, funcionario_idFuncionario, dataInscricao, confirmacao, dataConfirmacao, falta, justificativa, duracao, aprovado FROM presenca " . $where;
    return $this -> executeQuery($sql);
  }  

  function selectPresencaTr($where = "", $apenasLinha = false, $professor) {

    $sql = "SELECT SQL_CACHE idpresenca, workshop_idWorkshop, professor_idProfessor, funcionario_idFuncionario, dataInscricao, confirmacao, dataConfirmacao, falta, justificativa, duracao, aprovado  FROM presenca " . $where;
//	echo $sql;
    $result = $this -> query($sql);
    $Professor = new Professor();
    $Funcionario = new Funcionario();
    $WorkShop = new Workshop();
    $html = "";
    $caminhoAtualizar_base = CAMINHO_EVENTOS."inscricao/index.php";    
    if (mysqli_num_rows($result) > 0) {    

    while ($valor = mysqli_fetch_array($result)) {
          $idWorkpresenca = $valor['idpresenca'];
        if($valor['workshop_idWorkshop']!=""){
          $Tema = $WorkShop->selectWorkShop("WHERE idworkshop = ".$valor['workshop_idWorkshop']);
        }
          
        if($valor['funcionario_idFuncionario']!=""){
          $Participante =  $Funcionario->getNome($valor['funcionario_idFuncionario']);
          $pt = "Funcionário"; 
        }else if($valor['professor_idProfessor']!="") {
          $Participante = $Professor->selectProfessor("WHERE idProfessor = ".$valor['professor_idProfessor']);
          $pt = "ADM"; 
        }
        
        $DataEvento = Uteis::exibirData($valor['dataEvento']);        
        $confirmacao = Uteis::exibirStatus($valor['confirmacao']);        
        $DataConfirmacao = Uteis::exibirData($valor['dataConfirmacao']);        
        $Falta = Uteis::exibirStatus($valor['falta']);
        
         $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idWorkpresenca=" . $idWorkpresenca;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
        }
        
        $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_EVENTOS . "inscricao/aba.php?idWorkpresenca=$idWorkpresenca', '$caminhoAtualizar', '$ondeAtualiza')\" ";
              
        $html .= "<tr>        
        <td >" .$Tema. "</td>
        <td >" .$pt."</td>";
	if ($professor != 1) {	
        $html .= "<td >".$Participante."</td>";
	}
     $html .= "   <td >".Uteis::exibirData($DataEvento)."</td>
        <td >".$confirmacao."</td>
        <td >".$DataConfirmacao."</td>
        <td >".$Falta."</td>        
        <td $onclick ><center><img src=\"" . CAMINHO_IMG . "lista.png\"></center></td>
        </tr>";

      }
    }
    return $html;
  }  
  
   function selectPresencaProfessorTr($where = "", $apenasLinha = false) {

    $sql = "SELECT SQL_CACHE idpresenca, workshop_idWorkshop, professor_idProfessor, funcionario_idFuncionario, dataInscricao, confirmacao, dataConfirmacao, falta, justificativa, duracao, aprovado  FROM presenca " . $where;
//	echo $sql;
    $result = $this -> query($sql);
    $Professor = new Professor();
 //   $Funcionario = new Funcionario();
    $WorkShop = new Workshop();
    $html = "";
	
	$ondeAtualiza = "#div_workshop";
//    $caminhoAtualizar_base = CAMINHO_CAD."inscricao/index.php";    
    if (mysqli_num_rows($result) > 0) {    

    while ($valor = mysqli_fetch_array($result)) {
		$caminhoAtualizar_base = CAMINHO_CAD."professor/contratado/include/resourceHTML/workshopPresenca.php?idProfessor=".$valor['professor_idProfessor'];
		
		
          $idWorkpresenca = $valor['idpresenca'];
		  $duracao = Uteis::exibirHoras($valor['duracao']);
		  $tema = $valor['workshop_idWorkshop'];
    //    if($valor['workshop_idWorkshop']!=""){
    //      $valorTema = $WorkShop->selectWorkShop("WHERE idworkshop = ".$valor['workshop_idWorkshop']);
	//	  $Tema = $valorTema[0]['tema'];
     //   }
          
/*        if($valor['funcionario_idFuncionario']!=""){
          $Participante =  $Funcionario->getNome($valor['funcionario_idFuncionario']);
          $pt = "Funcionário"; 
        }else*/ if($valor['professor_idProfessor']!="") {
          $Participante = $Professor->selectProfessor("WHERE idProfessor = ".$valor['professor_idProfessor']);
          $pt = "ADM"; 
        }
        
        $DataEvento = Uteis::exibirData($valor['dataInscricao']);        
       $confirmacao = Uteis::exibirStatus($valor['confirmacao']);        
        $DataConfirmacao = Uteis::exibirData($valor['dataConfirmacao']);        
        $Falta = Uteis::exibirStatus($valor['falta']);
		$aprovado = Uteis::exibirStatus($valor['aprovado']);
        
         $caminhoAtualizar = $caminhoAtualizar_base; /*. "?tr=1&idWorkpresenca=" . $idWorkpresenca;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
        }*/
        
        $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD."professor/contratado/include/form/aba.php?idWorkpresenca=$idWorkpresenca', '$caminhoAtualizar', '$ondeAtualiza')\" ";
              
        $html .= "<tr>
       <td $onclick>" .$tema. "</td>";
//        <td >" .$pt."</td>";
    
	    $html .= "   <td $onclick>".$DataEvento."</td>
       <td >".$duracao."</td>";
/*        <td >".$DataConfirmacao."</td>*/
       $html .= " <td >".$aprovado."</td>  ";      
$html .= " <td onclick=\"deletaRegistro('" . CAMINHO_CAD."professor/contratado/include/acao/inscricao.php', '$idWorkpresenca', '$caminhoAtualizar_base', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
        </tr>";

      }
    }
    return $html;
  }  
  
  
}
?>