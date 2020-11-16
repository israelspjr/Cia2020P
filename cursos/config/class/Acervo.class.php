<?php
class Acervo extends Database{
  //atributos
  var $idAcervo;
  var $idMaterialAcervo;
  var $disponivelAcervo;
  var $emprestadosAcervo;
  var $inativo;
  var $excluidoAcervo;
  
  //construtor
  function __construct(){
    parent::__construct();
    $this->idAcervo = "NULL";
    $this->idMaterialAcervo = "NULL";
    $this->disponivelAcervo = 0;
    $this->emprestadosAcervo = 0;
    $this->excluidoAcervo = 0;
  }

  function __destruct(){
    parent::__destruct();
  }
  
   // Method's Set's
   function setIdAcervo($value){
    $this -> idAcervo = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setIdMaterialAcervo($value){
    $this -> idMaterialAcervo = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setDisponivelAcervo($value){
    $this -> disponivelAcervo = ($value) ? $this -> gravarBD($value) : "0";
  }
  
  function setEmprestadoAcervo($value){
    $this -> emprestadosAcervo = ($value) ? $this -> gravarBD($value) : "0";
  }
  
  function setInativoAcervo($value){
    $this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
  }
  function setExcluidoAcervo($value){
    $this -> excluidoAcervo = ($value) ? $this -> gravarBD($value) : "0";
  }
  
   // Method's Get's
  function getIdAcervo(){
    return $this -> idAcervo;
  }

  function getIdMaterial(){
    return $this -> idMaterialAcervo;
  }

  function getDisponivel(){
    return $this -> disponivelAcervo;
  }
  
  function getEmprestado(){
    return $this -> emprestadosAcervo;
  }
  
   function getInativoAccervo(){
    return $this -> inativo;
  }
   
  function getExcluidoAccervo(){
    return $this -> excluidoAcervo;
  }
  
  //Add Acervo
  function addAcervo(){
    $sql = "INSERT INTO Acervo (materialDidatico_idMaterialDidatico, disponivel, emprestados, inativo, excluido) VALUES ($this->idMaterialAcervo, $this->disponivelAcervo, $this->emprestadosAcervo, $this->inativo, $this->excluidoAcervo)";
    $result = $this -> query($sql, true);
    return $this -> connect;
  }
  
  //Delete Acervo
  function deleteAcervo(){
    $sql = "UPDATE Acervo SET excluido = 1 WHERE idAcervo = $this->idAcervo";
    $result = $this -> query($sql, true);
  }
  
  //update Campos
  function updateAcervoField($field, $value){
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE Acervo SET " . $field . " = " . $value . " WHERE idAcervo = $this->idAcervo";
    $result = $this -> query($sql, true);
  }
  
  //update Todos os campos
   function updateAcervo(){    
    $sql = "UPDATE Acervo SET materialDidatico_idMaterialDidatico = $this->idMaterialAcervo, disponivel = $this->disponivelAcervo, emprestados = $this->emprestadosAcervo, inativo = $this->inativo, excluido = $this->excluidoAcervo WHERE idAcervo = $this->idAcervo";
    $result = $this -> query($sql, true);
  }
  
  //Select Acervo
  function selectAcervo($where = "WHERE 1"){
    $sql = "SELECT SQL_CACHE idAcervo, materialDidatico_idMaterialDidatico, disponivel, emprestados, inativo,excluido FROM Acervo " . $where;
    return $this -> executeQuery($sql);
  }
  
function selectAcervoTr($where = "", $apenasLinha = false){

      $sql = "SELECT SQL_CACHE A.idAcervo, A.disponivel, A.emprestados, A.inativo, M.nome, I.idioma FROM Acervo AS A 
      INNER JOIN materialDidatico AS M ON A.materialDidatico_idMaterialDidatico = M.idMaterialDidatico 
      INNER JOIN idioma AS I ON M.idioma_idIdioma = I.idIdioma ".$where;
      $result = $this -> query($sql);
      $html = "";
      

      $caminhoAtualizar_base = CAMINHO_BIBLIOTECA . "acervo/index.php";
     
      
      while ($valor = mysqli_fetch_array($result)){
        
        $idAcervo = $valor['idAcervo'];
        $nomeMaterial = $valor['nome'];
        $idioma = $valor['idioma'];
        $inativo = Uteis::exibirStatus(!$valor['inativo']);        
        $valorF = $valor['disponivel'];
        $EmpF = $valor['emprestados'];       
        $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idAcervo=" . $idAcervo;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
          
        }
        
        $onclick = " onclick=\"abrirNivelPagina(this, '". CAMINHO_BIBLIOTECA ."/acervo/acervoForm.php?idAcervo=$idAcervo', '".$caminhoAtualizar."', 'tr')\" ";

        $delete = "<center>
          <img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_BIBLIOTECA . "acervo/acao.php?acao=deletar', '" . $idAcervo . "', '".$caminhoAtualizar."', 'tr')\" />
        </center>";      

          $html .= "<tr >";

          $html .= "<td $onclick >" . $nomeMaterial . "</td>";

          $html .= "<td $onclick align=\"center\" >" . $idioma . "</td>";

          $html .= "<td align=\"center\" >" . $valorF . "</td>";
          
          $html .= "<td align=\"center\" >" . $EmpF . "</td>";
          
          $html .= "<td align=\"center\" >" . $inativo . "</td>";         

          $html .= "<td align=\"center\" >$delete</td>";

          $html .= "</tr>";     
      
    }
    
    return $html;
  }
  function SelectAcervohtml($idAtual = 0, $where = ""){
      $sql = "SELECT SQL_CACHE idAcervo, nome, T.tipo, I.idioma ";
      $sql .= "FROM Acervo AS A ";
      $sql .= "INNER JOIN materialDidatico AS M ON A.materialDidatico_idMaterialDidatico = M.idMaterialDidatico ";
      $sql .= "INNER JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
      $sql .= "INNER JOIN idioma AS I ON M.idioma_ididioma = I.idIdioma ";
      $sql .= $where . " ORDER BY nome";
    
    //echo $sql;
    $result = $this -> query($sql);

    $html = "<select id=\"idAcervo\" name=\"idAcervo\" class=\"required\" >";
    $html .= "<option value=\"\">Selecione</option>";

    while ($valor = mysqli_fetch_array($result)) {
      $selecionado = $idAtual == $valor['idAcervo'] ? "selected=\"selected\"" : "";
      $material = $valor['nome'];
      $material .= ($valor['tipo'] ? " - " . $valor['tipo'] : "");
      $material .= ($valor['idioma'] ? " - " . $valor['idioma'] : "");
      $html .= "<option " . $selecionado . " value=\"" . $valor['idAcervo'] . "\">" . $material . "</option>";
    }
    $html .= "</select>";
    return $html;
  }
  
  function SelectAcervoResgate($idAtual){
        
      $sql = "SELECT SQL_CACHE idAcervo, nome, T.tipo, I.idioma ";
      $sql .= "FROM Acervo AS A ";
      $sql .= "INNER JOIN materialDidatico AS M ON A.materialDidatico_idMaterialDidatico = M.idMaterialDidatico ";
      $sql .= "INNER JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
      $sql .= "INNER JOIN idioma AS I ON M.idioma_ididioma = I.idIdioma ";
      $sql .= "WHERE idAcervo = ".$idAtual;    
      //echo $sql;
      $valor = $this -> executeQuery($sql);
      $html = "";
      $material = $valor[0]['nome'];
      $material .= ($valor[0]['tipo'] ? " - " . $valor[0]['tipo'] : "");
      $material .= ($valor[0]['idioma'] ? " - " . $valor[0]['idioma'] : "");
      $html .= $material;
    return $html;
  }

} 
?>