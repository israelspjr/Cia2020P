<?php
class NewsProfessor extends Database {
	// class attributes
	var $idNewsProfessor;
	var $link;
	var $portal;
	var $grupo;
	var $inativo;
	var $news;
    var $popup;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idNewsProfessor = "NULL";
		$this -> link = "NULL";
		$this -> portal = "NULL";
		$this -> grupo = 0; 
		$this -> inativo = "0";
		$this -> news = "NULL";
		$this -> popup = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
           

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdNewsProfessor($value) {
		$this -> idNewsProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setlink($value) {
		$this -> link = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPortal($value) {
		$this -> portal = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setGrupo($value) {
		$this -> grupo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
    function setNews($value) {
        $this -> news = ($value) ? $this -> gravarBD($value) : "NULL";
    }
	
	function setPopup($value) {
		$this -> popup = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

     
	/**
	 * addNewsProfessor() Function
	 */
	function addNewsProfessor() {
		$sql = "INSERT INTO newsProfessor (link, portal, grupo, inativo, news, popup, dataCadastro ) VALUES ($this->link, $this->portal, $this->grupo, $this->inativo, $this->news, $this->popup, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteNewsProfessor() Function
	 */
	function deleteNewsProfessor() {
		$sql = "DELETE FROM newsProfessor WHERE idNewsProfessor = $this->idNewsProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAtividadeExtra() Function
	 */
	function updateFieldNewsProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE newsProfessor SET " . $field . " = " . $value . " WHERE idNewsProfessor = $this->idNewsProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAtividadeExtra() Function
	 */
	function updateNewsProfessor() {
		$sql = "UPDATE newsProfessor SET link = $this->link, portal = $this->portal, grupo = $this->grupo, inativo= $this->inativo, news = $this->news, popup = $this->popup WHERE idNewsProfessor = $this->idNewsProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAtividadeExtra() Function
	 */
	function selectNewsProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idNewsProfessor, link, portal, grupo, inativo, news, popup, dataCadastro FROM newsProfessor " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectAtividadeExtraTr() Function
	 */
	function selectNewsProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE a.idNewsProfessor, a.link, a.portal, a.grupo, a.inativo, a.news, a.popup, a.dataCadastro  FROM newsProfessor a " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idAtividadeExtra = $valor['idNewsProfessor'];
//				$tipoAtividadeExtra_idTipoAtividadeExtra = $valor['nomeTipoAtividadeExtra'];
				$link = Uteis::resumir($valor['news'], 100);
				$idPortal = $valor['portal'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$grupo = Uteis::exibirStatus($valor['grupo']);
				
				if ($idPortal == 1) {
					
					$portal = "Portal do Professor";
				} elseif ($idPortal == 2) {
					
					$portal = "Portal do RH";
				} elseif ($idPortal == 3) {
					
					$portal = "Portal do Aluno";
				}

				$html .= "<td>" . $idAtividadeExtra . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idNewsProfessor'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $link . "</td>";
				$html .= "<td>" . $portal . "</td>";
				$html .= "<td>" . $grupo. "</td>";
				$html .= "<td>" . $inativo . "</td>";
               $html .= "<td>" . Uteis::exibirData($valor['dataCadastro']) . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $idAtividadeExtra . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>