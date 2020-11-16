<?php
class ContatoAdicional extends Database {
	// class attributes
	var $idContatoAdicional;
	var $clientePfIdClientePf;
	var $clientePjIdClientePj;
	var $funcionarioIdFuncionario;
	var $professorIdProfessor;
    var $propostaIdProposta;
	var $nome;
	var $contatoCobranca;
	var $contatoRH;
    var $contatoOutro;
    var $contatoObs;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idContatoAdicional = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> professorIdProfessor = "NULL";
        $this -> propostaIdProposta = "NULL";
		$this -> nome = "NULL";
		$this -> contatoCobranca = "0";
		$this -> contatoRH = "0";
        $this -> contatoOutro = "0";
        $this -> contatoObs = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdContatoAdicional($value) {
		$this -> idContatoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setPropostaIdProposta($value) {
    $this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
  }

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setContatoCobranca($value) {
		$this -> contatoCobranca = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setContatoRH($value) {
		$this -> contatoRH = ($value) ? $this -> gravarBD($value) : "0";
	}
  
  function setContatoOutro($value) {
    $this -> contatoOutro = ($value) ? $this -> gravarBD($value) : "0";
  }
  
  function setContatoObs($value) {
    $this -> contatoObs = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addContatoAdicional() Function
	 */
	function addContatoAdicional() {
		$sql = "INSERT INTO contatoAdicional (clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario, professor_idProfessor, proposta_idProposta, nome, contatoCobranca, contatoRH, contatoOutro, contatoObs, obs) 
		VALUES 
		($this->clientePfIdClientePf, $this->clientePjIdClientePj, $this->funcionarioIdFuncionario, $this->professorIdProfessor, $this->propostaIdProposta, $this->nome, $this->contatoCobranca, $this->contatoRH, $this->contatoOutro, $this->contatoObs, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteContatoAdicional() Function
	 */
	function deleteContatoAdicional() {
		//$sql = "DELETE FROM contatoAdicional WHERE idContatoAdicional = $this->idContatoAdicional";
		//$result = $this->query($sql, true);
		$this -> updateFieldContatoAdicional("excluido", "1");

	}

	/**
	 * updateFieldContatoAdicional() Function
	 */
	function updateFieldContatoAdicional($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE contatoAdicional SET " . $field . " = " . $value . " WHERE idContatoAdicional = $this->idContatoAdicional";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateContatoAdicional() Function
	 */
	function updateContatoAdicional() {
		$sql = "UPDATE contatoAdicional SET clientePf_idClientePf = $this->clientePfIdClientePf, clientePj_idClientePj = $this->clientePjIdClientePj, funcionario_idFuncionario = $this->funcionarioIdFuncionario, professor_idProfessor = $this->professorIdProfessor, proposta_idProposta = $this->propostaIdProposta, nome = $this->nome, contatoCobranca = $this->contatoCobranca, contatoRH = $this->contatoRH, contatoOutro = $this->contatoOutro, contatoObs = $this->contatoObs, obs = $this->obs WHERE idContatoAdicional = $this->idContatoAdicional";
		$result = $this -> query($sql, true);
	}

	function selectContatoAdicional($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idContatoAdicional, clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario, professor_idProfessor, proposta_idProposta, nome, contatoCobranca, contatoRH, contatoOutro, contatoObs, obs 
		FROM contatoAdicional 
		WHERE excluido = 0 " . $where;
		return $this -> executeQuery($sql);
	}

	function selectContatoAdicionalTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idContatoAdicional, nome FROM contatoAdicional WHERE excluido = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idContatoAdicional = $valor['idContatoAdicional'];

				$html .= "<tr>
				
				<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/contatoAdicional.php?id=$idContatoAdicional', '$caminhoAtualizar', '$ondeAtualiza')\" >
					" . $valor['nome'] . "
				</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/contatoAdicional.php', '" . $idContatoAdicional . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}

		return $html;
	}
    
    function selectContatoAdcionalCheck($idClientePj, $tipo){
             
        $sql = "SELECT E.valor, E.ePrinc, CA.idContatoAdicional, CA.nome FROM clientePj AS C        
        INNER JOIN contatoAdicional AS CA ON CA.clientePj_idClientePj = C.idClientePj       
        INNER JOIN enderecoVirtual AS E ON E.contatoAdicional_idContatoAdicional = CA.idContatoAdicional AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1
        WHERE E.ePrinc = 1 AND C.idClientePj = ".$idClientePj." AND ".$tipo." = 1";
        //echo $sql;
        $result = $this -> query($sql);
        if (mysqli_num_rows($result) > 0) {

            $html = "";

            while ($valor = mysqli_fetch_array($result)) {
                $email = $valor['valor'];
                $html .= "<p>                
                <label for=\"check_disparoEmail_integranteGrupo_" . $valor['nome'] . "\">              
                <input type=\"checkbox\" id=\"check_disparoEmail_contatoAdd_" . $valor['idContatoAdicional'] . "\" name=\"check_disparoEmail_contatoAdd[]\" value=\"" . $valor['idContatoAdicional'] . "\" " . ($email ? "" : "disabled") . " /> " . $valor['nome'] . ($email ? "" : "(não possui e-mail)") . "</label></p>";
                
            }
        }
        return $html;
    }

	function selectContatoAdicionalTr_PJ($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		$sql = "SELECT SQL_CACHE idContatoAdicional, nome, contatoCobranca FROM contatoAdicional " . $where . " ORDER BY nome";
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idContatoAdicional'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . ($valor['nome']) . "</td>";
				$html .= "<td align=\"center\">" . Uteis::exibirStatus($valor['contatoCobranca']) . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "contatoAdicional/include/acao/contatoAdicional.php', " . $valor['idContatoAdicional'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}
    
    function getNome($id) {
        $rs = $this ->selectContatoAdicional("AND idContatoAdicional = $id");
        return $rs[0]['nome'];
    }

    function getEmail($id) {

        $emails = array();

        $sql = "SELECT E.valor, E.ePrinc, CA.idContatoAdicional, CA.nome FROM clientePj AS C        
        INNER JOIN contatoAdicional AS CA ON CA.clientePj_idClientePj = C.idClientePj       
        INNER JOIN enderecoVirtual AS E ON E.contatoAdicional_idContatoAdicional = CA.idContatoAdicional AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1
        WHERE E.ePrinc = 1 AND CA.idContatoAdicional = " . $id;
        //echo "//".$sql;//exit;
        $result = $this -> query($sql);
        while ($valor = mysqli_fetch_array($result)) {
            $emails = $valor['valor'];
        }
        return $emails;
    }

}
?>