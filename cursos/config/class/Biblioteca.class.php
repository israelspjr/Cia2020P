<?php
class Biblioteca extends Database{

  var $idBiblioteca;
  var $idAcervo;
  var $idProfessor;
  var $idFuncionario_emp;
  var $idFuncionario_dev;
  var $dataEmprestimo;
  var $dataDevolucao;
  var $inativo;

function __construct(){
    parent::__construct();
    $this->idBiblioteca = "NULL";
    $this->idAcervo = "NULL";
    $this->idProfessor = "NULL";
    $this->idFuncionario_emp = "NULL";
    $this->idFuncionario_dev = "NULL";
    $this->dataEmprestimo = "NULL";
    $this->dataDevolucao = "NULL";
    $this->inativo = 0;
 }

  function __destruct(){
    parent::__destruct();
  }

  // class methods
  function setIdBiblioteca($value){
    $this -> idBiblioteca = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setIdAcervo($value){
    $this -> idAcervo = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setidProfessor($value){
    $this -> idProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setidFuncionario_emp($value){
    $this -> idFuncionario_emp = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setidFuncionario_dev($value){
    $this -> idFuncionario_dev = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function setDataEmprestimo($value){
    $this -> dataEmprestimo = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
  }
  
  function setDataDevolucao($value){
    $this -> dataDevolucao = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
  }
  
  function setInativo($value){
    $this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
  }
  
  function getIdBiblioteca(){
    return $this -> idBiblioteca;
  }

  function getIdMaterial(){
    return $this -> idAcervo;
  }

  function getidProfessor(){
    return $this -> idProfessor;
  }
  
  function getidFuncionario_emp(){
    return $this -> idFuncionario_emp;
  }
  
  function getidFuncionario_dev(){
    return $this -> idFuncionario_dev;
  }
  
  function getDataEmprestimo(){
    return $this -> dataEmprestimo;
  }
  
  function getDataDevolucao(){
    return $this -> dataDevolucao;
  }
    
  function getInativo(){
    return $this -> inativo;
  }
  
  function addBiblioteca(){
    $sql = "INSERT INTO Biblioteca (idAcervo, idProfessor, idFuncionario_emp, idFuncionario_dev, dataEmprestimo, dataDevolucao, inativo) VALUES ($this->idAcervo, $this->idProfessor, $this->idFuncionario_emp, $this->idFuncionario_dev, $this->dataEmprestimo, $this->dataDevolucao, $this->inativo)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }

  function deleteBiblioteca(){
    $sql = "UPDATE Biblioteca SET inativo = 1 WHERE idBiblioteca = $this->idBiblioteca";
    $result = $this -> query($sql, true);
  }

  function updateBibliotecaField($field, $value){
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE Biblioteca SET " . $field . " = " . $value . " WHERE idBiblioteca = $this->idBiblioteca";
    $result = $this -> query($sql, true);
  }


  function updateBiblioteca(){    
    $sql = "UPDATE Biblioteca SET 
    idAcervo = $this->idAcervo, 
    idProfessor = $this->idProfessor, 
    idFuncionario_emp = $this->idFuncionario_emp, 
    idFuncionario_dev = $this->idFuncionario_dev,
    dataEmprestimo = $this->dataEmprestimo,
    dataDevolucao = $this->dataDevolucao,
    inativo = $this->inativo
    WHERE idBiblioteca = $this->idBiblioteca";
    $result = $this -> query($sql, true);
  }


  function selectBiblioteca($where = "WHERE 1"){
    $sql = "SELECT SQL_CACHE idAcervo, idProfessor, idFuncionario_emp, idFuncionario_dev, dataEmprestimo, dataDevolucao, inativo FROM Biblioteca " . $where;
    return $this -> executeQuery($sql);
  }
  
  function selectEmprestimo($where = "", $apenasLinha = false){
    
      $sql = "SELECT SQL_CACHE B.idBiblioteca, B.dataEmprestimo, B.dataDevolucao, M.nome, I.idioma, P.Nome AS Professor, FE.nome AS EMP FROM Biblioteca AS B 
      INNER JOIN Acervo AS A ON B.idAcervo = A.idAcervo 
      INNER JOIN materialDidatico AS M ON A.materialDidatico_idMaterialDidatico = M.idMaterialDidatico 
      INNER JOIN idioma AS I ON M.idioma_idIdioma = I.idIdioma
      INNER JOIN professor AS P ON B.idProfessor = P.idProfessor 
      INNER JOIN funcionario AS FE on B.idFuncionario_emp = FE.idFuncionario WHERE B.dataDevolucao IS NULL  AND B.inativo = 0";
      $result = $this -> query($sql);
      $html = "";
      
      $caminhoAtualizar_base = CAMINHO_BIBLIOTECA."emprestimos/index.php";
      
      while ($valor = mysqli_fetch_array($result)){
          
        $idBiblioteca = $valor['idBiblioteca'];
        $nomeMaterial = $valor['nome'];
        $idioma = $valor['idioma'];
        $prof = $valor['Professor'];
        $emprestimo = Uteis::exibirData($valor['dataEmprestimo']);
        $emp = $valor['EMP']; 
        
        $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idBiblioteca=" . $idBiblioteca;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
          
        }     
        $devo = "<center>
          <img src=\"" . CAMINHO_IMG . "devol.png\" onclick=\"abrirNivelPagina(this, '". CAMINHO_BIBLIOTECA . "devolucoes/devolucoesForm.php?idBiblioteca=$idBiblioteca', '".$caminhoAtualizar."', 'tr')\" />
        </center>"; 
        
          $html .= "<tr >";
          $html .= "<td>" . $nomeMaterial . "</td>";
          $html .= "<td>" . $idioma . "</td>";
          $html .= "<td>" . $prof . "</td>";          
          $html .= "<td>" . $emprestimo . "</td>"; 
          $html .= "<td>" . $emp . "</td>"; 
          $html .= "<td>" . $devo . "</td>";         
          $html .= "</tr>";     
      
    }
    
    return $html;
  }
  
   function selectDevolucao($where = "", $apenasLinha = false){
    
      $sql = "SELECT SQL_CACHE B.idBiblioteca, B.dataEmprestimo, B.dataDevolucao, M.nome, I.idioma, P.Nome AS Professor, FE.nome AS EMP, FD.nome AS DEV FROM Biblioteca AS B 
      INNER JOIN Acervo AS A ON B.idAcervo = A.idAcervo 
      INNER JOIN materialDidatico AS M ON A.materialDidatico_idMaterialDidatico = M.idMaterialDidatico 
      INNER JOIN idioma AS I ON M.idioma_idIdioma = I.idIdioma
      INNER JOIN professor AS P ON B.idProfessor = P.idProfessor 
      INNER JOIN funcionario AS FE on B.idFuncionario_emp = FE.idFuncionario
      INNER JOIN funcionario AS FD on B.idFuncionario_dev = FD.idFuncionario WHERE B.dataDevolucao IS NOT NULL AND B.inativo = 0";
      $result = $this -> query($sql);
      $html = "";
      

      while ($valor = mysqli_fetch_array($result)){

        $nomeMaterial = $valor['nome'];
        $idioma = $valor['idioma'];
        $prof = $valor['Professor'];
        $emprestimo = Uteis::exibirData($valor['dataEmprestimo']);
        $emp = $valor['EMP']; 
        $devolvido = Uteis::exibirData($valor['dataDevolucao']);
        $dev = $valor['DEV'];
              
        $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idBiblioteca=" . $idBiblioteca;
        if ($apenasLinha) {
          $caminhoAtualizar .= "&ordem=" . $apenasLinha;
        } else {
          $caminhoAtualizar .= "&ordem=" . ($cont++);
          
        } 
           
          $html .= "<tr >";
          $html .= "<td>" . $nomeMaterial . "</td>";
          $html .= "<td>" . $idioma . "</td>";
          $html .= "<td>" . $prof . "</td>";          
          $html .= "<td>" . $emprestimo . "</td>"; 
          $html .= "<td>" . $emp . "</td>"; 
          $html .= "<td>" . $devolvido . "</td>"; 
          $html .= "<td>" . $dev . "</td>";
          $html .= "</tr>";     
      
    }
    
    return $html;
  }
 } 
 

?>