<?php
class Workshop extends Database{
  var $idWorkshop;
  var $tema;
  var $dataEvento;
  var $vagas;
  var $inicio;
  var $termino;
  var $finalizado;
  var $excluido;

  // constructor
  function __construct(){    
    parent::__construct();
    $this -> idWorkshop = "NULL";
    $this -> tema = "NULL";
    $this -> dataEvento = "NULL";
    $this -> vagas = 0;
    $this -> inicio = "NULL";
    $this -> termino = "NULL";
    $this -> finalizado = 0;
    $this -> excluido = 0;
  }

  function __destruct(){
    parent::__destruct();
  }

  // class methods
  function setidWorkshop($value){
    $this -> idWorkshop = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setTema($value){
    $this -> tema = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setDataEvento($value){
    $this -> dataEvento = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
  }
  function setVagas($value){
    $this -> vagas = ($value) ? $this -> gravarBD($value) : "0";
  }

  function setInicio($value){
    $this -> inicio = ($value) ? $this -> gravarBD(Uteis::gravarHoras($value)) : "NULL";
  }

  function setTermino($value){
    $this -> termino = ($value) ? $this -> gravarBD(Uteis::gravarHoras($value)) : "NULL";
  }

  function setFinalizado($value){
    $this -> finalizado = ($value) ? $this -> gravarBD($value) : "0";
  }
  function setExcluido($value){
    $this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
  }
  
  function getidWorkshop(){
    return $this -> idWorkshop;
  }

  function getTema(){
    return $this -> tema;
  }

  function getDataEvento(){
    return $this -> dataEvento;
  }
  function getVagas(){
    return $this -> vagas;
  }

  function getInicio(){
    return $this -> inicio;
  }

  function getTermino(){
    return $this -> termino;
  }

  function getFinalizado(){
    return $this -> finalizado;
  }
  function getExcluido(){
    return $this -> excluido;
  }
  
  function addWorkShop(){
    $sql = "INSERT INTO workshop (tema, dataEvento, vagas, inicio, termino, finalizado, excluido) VALUES ($this->tema, $this->dataEvento, $this->vagas, $this->inicio, $this->termino, $this->finalizado, $this->excluido)";
    $result = $this -> query($sql, true);
    return $this -> connect;
  }

  function deleteWorkShop(){
    $sql = "DELETE FROM workshop WHERE idworkshop = $this->idWorkshop";
    $result = $this -> query($sql, true);
  }

  function updateFieldWorkShop($field, $value){
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE workshop SET " . $field . " = " . $value . " WHERE idworkshop = $this->idWorkshop";
    $result = $this -> query($sql, true);
  }

  function updateWorkShop(){
    $sql = "UPDATE workshop SET tema = $this->tema, dataEvento = $this->dataEvento, vagas = $this->vagas, inicio = $this->inicio, termino = $this->termino, finalizado = $this->finalizado, excluido = $this->excluido WHERE idworkshop = $this->idWorkshop";
    $result = $this -> query($sql, true);
  }

  function selectWorkShop($where = "WHERE 1"){
    $sql = "SELECT SQL_CACHE idworkshop, tema, dataEvento, vagas, inicio, termino, finalizado, excluido FROM workshop " . $where;
    return $this -> executeQuery($sql);
  }  

  function selectWorkShopTr($where = "", $apenasLinha = false){

    $sql = "SELECT SQL_CACHE idworkshop, tema, dataEvento, vagas, inicio, termino, finalizado, excluido FROM workshop " . $where;
    $result = $this -> query($sql);
    
    $html = "";
    $caminhoAtualizar_base = CAMINHO_EVENTOS."evento/evento.php";
    $ondeAtualiza = "#centro";
    
    while ($valor = mysqli_fetch_array($result)){

        $idWorkshop = $valor['idworkshop'];
        $Tema = $valor['tema'];
        $Data = Uteis::exibirData($valor['dataEvento']);
        $Vagas = $valor['vagas'];
        $horaIn = Uteis::exibirHoras($valor['inicio']);
        $horaFi = Uteis::exibirHoras($valor['termino']);
        $final = Uteis::exibirStatus($valor['finalizado']);
        
        $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idWorkshop=" . $idWorkshop;
        if($apenasLinha){
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        }else{
          $caminhoAtualizar .= "&ordem=" . ($cont++);
        }               
        $html .= "<tr>        
        <td >".$Tema."</td>        
        <td >". $Data."</td>
        <td >". $Vagas."</td>
        <td >". $horaIn."</td>
        <td >". $horaFi."</td>        
        <td align=\"center\" >".$final."</td>
        <td onclick=\"abrirNivelPagina(this, '".CAMINHO_EVENTOS."evento/form_evento.php?idWorkshop=$idWorkshop', '$caminhoAtualizar', '$ondeAtualiza')\" >
          <center><img src=\"" . CAMINHO_IMG . "editar.png\"></center>
        </td>
        <td onclick=\"deletaRegistro('" .CAMINHO_EVENTOS. "evento/acao.php', '$idWorkshop', '$caminhoAtualizar', '$ondeAtualiza')\" >
          <center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
        </td>
        </tr>";

      }    
    return $html;
  }
    function selectWorkShopSelect($idAtual = 0) {
    $data = Uteis::gravarData(Date("d/m/Y"));
     
    $sql = "SELECT SQL_CACHE idworkshop, tema, dataEvento FROM workshop 
    WHERE excluido = 0 AND dataEvento >= $data ORDER BY tema";
    $result = $this -> query($sql);
    //echo $sql;
    
    $html = "<select id=\"idworkshop\" name=\"idworkshop\"  class=\"required\" >
    <option value=\"\">Selecione</option>";
    
    while ($valor = mysqli_fetch_array($result)) {
      $selecionado = $idAtual == $valor['idworkshop'] ? "selected=\"selected\"" : "";
      $html .= "<option " . $selecionado . " value=\"" . $valor['idworkshop'] . "\">" . ($valor['tema']) . "</option>";
    }
    
    $html .= "</select>";
    return $html;
  }
}
?>