<?php
class EnderecoVirtual extends Database {
  // class attributes
  var $idEnderecoVirtual;
  var $professorIdProfessor;
  var $clientePfIdClientePf;
  var $funcionarioIdFuncionario;
  var $contatoAdicionalIdContatoAdicional;
  var $tipoEnderecoVirtual_idTipoEnderecoVirtual;
  var $valor;
  var $ePrinc;

  // constructor
  function __construct() {
    parent::__construct();
    $this -> idEnderecoVirtual = "NULL";
    $this -> professorIdProfessor = "NULL";
    $this -> clientePfIdClientePf = "NULL";
    $this -> funcionarioIdFuncionario = "NULL";
    $this -> contatoAdicionalIdContatoAdicional = "NULL";
    $this -> tipoEnderecoVirtual_idTipoEnderecoVirtual = "NULL";
    $this -> valor = "NULL";
    $this -> ePrinc = "0";

  }

  function __destruct() {
    parent::__destruct();
  }

  // class methods
  function setidEnderecoVirtual($value) {
    $this -> idEnderecoVirtual = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setProfessorIdProfessor($value) {
    $this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setClientePfIdClientePf($value) {
    $this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setFuncionarioIdFuncionario($value) {
    $this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setContatoAdicionalIdContatoAdicional($value) {
    $this -> contatoAdicionalIdContatoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function settipoEnderecoVirtual_idTipoEnderecoVirtual($value) {
    $this -> tipoEnderecoVirtual_idTipoEnderecoVirtual = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setValor($value) {
    $this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
  }

  function setEprinc($value) {
    $this -> ePrinc = ($value) ? $this -> gravarBD($value) : "0";
  }

  /**
   * addEnderecoVirtual() Function
   */
  function addEnderecoVirtual() {
    $sql = "INSERT INTO enderecoVirtual (professor_idProfessor, clientePf_idClientePf, funcionario_idFuncionario, contatoAdicional_idContatoAdicional, tipoEnderecoVirtual_idTipoEnderecoVirtual, valor, ePrinc) VALUES ($this->professorIdProfessor, $this->clientePfIdClientePf, $this->funcionarioIdFuncionario, $this->contatoAdicionalIdContatoAdicional, $this->tipoEnderecoVirtual_idTipoEnderecoVirtual, $this->valor, $this->ePrinc)";
//	echo $sql;
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }

  /**
   * deleteEnderecoVirtual() Function
   */
  function deleteEnderecoVirtual($or = " 1 = 2 ") {
    $sql = "DELETE FROM enderecoVirtual WHERE idEnderecoVirtual = $this->idEnderecoVirtual OR (" . $or . ")";
    $result = $this -> query($sql, true);
  }

  /**
   * updateFieldEnderecoVirtual() Function
   */
  function updateFieldEnderecoVirtual($field, $value) {
    $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
    $sql = "UPDATE enderecoVirtual SET " . $field . " = " . $value . " WHERE idEnderecoVirtual = $this->idEnderecoVirtual";
    $result = $this -> query($sql, true);
  }

  /**
   * updateEnderecoVirtual() Function
   */
  function updateEnderecoVirtual() {
    $sql = "UPDATE enderecoVirtual SET professor_idProfessor = $this->professorIdProfessor, clientePf_idClientePf = $this->clientePfIdClientePf, funcionario_idFuncionario = $this->funcionarioIdFuncionario, contatoAdicional_idContatoAdicional = $this->contatoAdicionalIdContatoAdicional, tipoEnderecoVirtual_idTipoEnderecoVirtual = $this->tipoEnderecoVirtual_idTipoEnderecoVirtual, valor = $this->valor, ePrinc = $this->ePrinc  WHERE idEnderecoVirtual = $this->idEnderecoVirtual";
    $result = $this -> query($sql, true);
  }

  function selectEnderecoVirtual($where = "WHERE 1") {
    $sql = "SELECT SQL_CACHE idEnderecoVirtual, professor_idProfessor, clientePf_idClientePf, funcionario_idFuncionario, contatoAdicional_idContatoAdicional, tipoEnderecoVirtual_idTipoEnderecoVirtual, valor, ePrinc FROM enderecoVirtual " . $where;
    return $this -> executeQuery($sql);
  }

  function selectEnderecoVirtualJoin($where = "", $campos = array("*")) {
    $sql = "SELECT SQL_CACHE " . implode(",", $campos) . " 
		FROM enderecoVirtual AS E 
		INNER JOIN tipoEnderecoVirtual AS T ON T.idTipoEnderecoVirtual = E.tipoEnderecoVirtual_idTipoEnderecoVirtual 
		" . $where;
    return $this -> executeQuery($sql);
  }

  function selectEnderecoVirtualTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

    $sql = "SELECT SQL_CACHE E.idEnderecoVirtual, TEV.tipo, E.valor, E.ePrinc 
		FROM enderecoVirtual AS E 
		INNER JOIN tipoEnderecoVirtual AS TEV ON E.tipoEnderecoVirtual_idTipoEnderecoVirtual = TEV.idTipoEnderecoVirtual " . $where;
    $result = $this -> query($sql);

    if (mysqli_num_rows($result) > 0) {

      $html = "";

      while ($valor = mysqli_fetch_array($result)) {

        $idEnderecoVirtual = $valor['idEnderecoVirtual'];
        $val = $valor['valor'];
        $tipo = $valor['tipo'];
        $Eprinc = $valor['ePrinc'];
		if ($mobile != 1) {
        $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/enderecoVirtual.php?id=$idEnderecoVirtual', '$caminhoAtualizar', '$ondeAtualiza')\" ";
		} else {
		$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/enderecoVirtual.php?id=$idEnderecoVirtual', '$ondeAtualiza');\" ";
		
		}
        if ($tipo == "E-mail") {
          $lin = Uteis::exibirStatus($Eprinc);
        } else {
          $lin = "";
        }
        $html .= "<tr>
				
				<td $onclick >" . $tipo . "</td>				
				<td >" . $val . "</td>
				<td align=\"center\" >" . $lin . "</td>
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/enderecoVirtual.php', '$idEnderecoVirtual', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

      }
    }
    return $html;
  }

}
?>