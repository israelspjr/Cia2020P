<?php
class Modulo extends Database {
	// class attributes
	var $idModulo;
	var $moduloIdModulo;
	var $nome;
	var $link;
	var $ordem;
	var $inativo;
	var $admin;
	var $aluno;
	var $preAluno;
	var $rh;
	var $professor;
	var $candidato;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idModulo = "NULL";
		$this -> moduloIdModulo = "NULL";
		$this -> nome = "NULL";
		$this -> link = "NULL";
		$this -> ordem = "NULL";
		$this -> inativo = 0;
		$this -> admin = 0;
		$this -> aluno = 0;
		$this -> preAluno = 0;
		$this -> rh = 0;
		$this -> professor = 0;
		$this -> candidato = 0;
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdModulo($value) {
		$this -> idModulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setModuloIdModulo($value) {
		$this -> moduloIdModulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLink($value) {
		$this -> link = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOrdem($value) {
		$this -> ordem = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setInativo($value) {
        $this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setPreAluno($value) {
        $this -> preAluno = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setAdmin($value) {
        $this -> admin = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setAluno($value) {
        $this -> aluno = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setRh($value) {
        $this -> rh = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setProfessor($value) {
        $this -> professor = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setCandidato($value) {
        $this -> candidato = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	/**
	 * addModulo() Function
	 */
	function addModulo() {
		$sql = "INSERT INTO modulo (modulo_idModulo, nome, link, ordem, inativo, admin, aluno, preAluno, professor, candidato) VALUES ($this->moduloIdModulo, $this->nome, $this->link, $this->ordem, inativo, $this->admin, $this->aluno, $this->preAluno, $this->professor, $this->candidato)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteModulo() Function
	 */
	function deleteModulo() {
		$sql = "DELETE FROM modulo WHERE idModulo = $this->idModulo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldModulo() Function
	 */
	function updateFieldModulo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE modulo SET " . $field . " = " . $value . " WHERE idModulo = $this->idModulo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateModulo() Function
	 */
	function updateModulo() {
		$sql = "UPDATE modulo SET modulo_idModulo = $this->moduloIdModulo, nome = $this->nome, link = $this->link, ordem = $this->ordem, inativo = $this->inativo, admin = $this->admin, aluno = $this->aluno, preAluno = $this->preAluno, professor = $this->professor, candidato = $this->candidato WHERE idModulo = $this->idModulo";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	function selectModulo($where = "") {

		$sql = "SELECT SQL_CACHE idModulo, modulo_idModulo, nome, link, ordem, admin, aluno, preAluno, professor, candidato 
		FROM modulo AS M 
		WHERE inativo = 0 " . $where . " ORDER BY ordem, nome";
	//	echo "<br>".$sql;

		return $this -> executeQuery($sql);
	}
	
	function selectModuloSimples($where = "1") {

		$sql = "SELECT SQL_CACHE idModulo, modulo_idModulo, nome, link, ordem, admin, aluno, preAluno, professor, candidato 
		FROM modulo "
		. $where . " ORDER BY ordem, nome";
	//	echo "<br>".$sql;

		return $this -> executeQuery($sql);
	}

	function selectModulo_permissao($where = "") {

		$sql = "SELECT SQL_CACHE M.idModulo, M.modulo_idModulo, M.nome, M.link, M.ordem, M.admin, M.aluno, M.preAluno, M.professor, M.candidato
		FROM modulo AS M
		INNER JOIN permissaoModulo AS PM ON PM.modulo_idModulo = M.idModulo
		INNER JOIN funcionario AS F ON F.idFuncionario = PM.funcionario_idFuncionario 
		WHERE M.inativo = 0 " . $where . " ORDER BY ordem ASC, nome ASC";
	//	echo "<br>".$sql;

		return $this -> executeQuery($sql);
	}

	/**
	 * selectModuloTr() Function
	 */
	function selectModuloTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$Modulo = new Modulo();
		$sql = "SELECT SQL_CACHE idModulo, modulo_idModulo, nome, link, ordem, admin, aluno, preAluno, professor, candidato FROM modulo " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				
				$nome = $Modulo->getNome($valor['modulo_idModulo']);
				$ativo = Uteis::exibirStatus(!$valor['inativo']);
				
				$html .= "<tr>";

				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idModulo'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idModulo'] . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $valor['nome'] . "</td>";
				$html .= "<td>" . $valor['link'] . "</td>";
				$html .= "<td>" . $valor['ordem'] . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['admin']) . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['aluno']) . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['preAluno']) . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['professor']) . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['candidato']) . "</td>";
				$html .= "<td>" .$ativo."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "modulo/grava.php', " . $valor['idModulo'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectModuloSelect() Function
	 */
	function selectModuloSelect($classes = "", $idAtual = 0, $where = "") {
		
		$sql = "SELECT SQL_CACHE idModulo, modulo_idModulo, nome, link, ordem, admin, aluno, preAluno, professor, candidato FROM modulo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idModulo\" name=\"idModulo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			
			$selecionado = $idAtual == $valor['idModulo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idModulo'] . "\">" . ($valor['idModulo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectModuloSelectS($classes = "", $idAtual = 0, $where = "") {
		$Modulo = new Modulo();
		$sql = "SELECT SQL_CACHE idModulo, modulo_idModulo, nome, link, ordem, admin, aluno, preAluno, professor, candidato FROM modulo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idModulo\" name=\"idModulo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$moduloPai = $Modulo->getNome($valor['modulo_idModulo']);
			$selecionado = $idAtual == $valor['idModulo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idModulo'] . "\">" . ($valor['nome']) . "(" . $valor['idModulo'] . ") - Pai: ".$moduloPai."(".$valor['modulo_idModulo'].")</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function getNome($value) {
		$sql .= "SELECT SQL_CACHE nome 
		FROM modulo WHERE idModulo = ".$value;
		$result = Uteis::executarQuery($sql);
		return $result[0]['nome'];
		
	}

}
?>