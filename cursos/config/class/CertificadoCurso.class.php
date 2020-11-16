<?php
class CertificadoCurso extends Database {
	// class attributes
	var $idCertificadoCurso;
	var $titulo;
	var $conteudo;
	var $inativo;
	var $dataCadastro;
	var $excluido;
	var $nivel;
	var $area;
	var $certificacao;
	var $formacao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCertificadoCurso = "NULL";
		$this -> titulo = "NULL";
		$this -> conteudo = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";
		$this -> nivel = "0";
		$this -> area = "0";
		$this -> certificacao = "0";
		$this -> formacao = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCertificadoCurso($value) {
		$this -> idCertificadoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setConteudo($value) {
		$this -> conteudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setNivel($value) {
		$this -> nivel = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setArea($value) {
		$this -> area = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setCertificacao($value) {
		$this -> certificacao = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setFormacao($value) {
		$this -> formacao = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addCertificadoCurso() Function
	 */
	function addCertificadoCurso() {
		$sql = "INSERT INTO certificadoCurso (titulo, conteudo, inativo, dataCadastro, excluido, nivel, area, certificacao, formacao) VALUES ($this->titulo, $this->conteudo, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido, $this->nivel, $this->area, $this->certificacao, $this->formacao)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteCertificadoCurso() Function
	 */
	function deleteCertificadoCurso() {
		$sql = "DELETE FROM certificadoCurso WHERE idCertificadoCurso = $this->idCertificadoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCertificadoCurso() Function
	 */
	function updateFieldCertificadoCurso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE certificadoCurso SET " . $field . " = " . $value . " WHERE idCertificadoCurso = $this->idCertificadoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCertificadoCurso() Function
	 */
	function updateCertificadoCurso() {
		$sql = "UPDATE certificadoCurso SET titulo = $this->titulo, conteudo = $this->conteudo, inativo = $this->inativo, nivel = $this->nivel, area = $this->area, certificacao = $this->certificacao, formacao = $this->formacao WHERE idCertificadoCurso = $this->idCertificadoCurso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCertificadoCurso() Function
	 */
	function selectCertificadoCurso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idCertificadoCurso, titulo, conteudo, inativo, dataCadastro, excluido, nivel, area, certificacao, formacao FROM certificadoCurso " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectCertificadoCursoTr() Function
	 */
	function selectCertificadoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idCertificadoCurso, titulo, conteudo, inativo, dataCadastro, excluido, nivel, area, certificacao, formacao FROM certificadoCurso " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idCertificadoCurso = $valor['idCertificadoCurso'];
				$titulo = $valor['titulo'];
				$conteudo = $valor['conteudo'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];
				$nivel = Uteis::exibirStatus($valor['nivel']);
				$area = Uteis::exibirStatus($valor['area']);
				$certificacao = Uteis::exibirStatus($valor['certificacao']);
				$formacao = Uteis::exibirStatus($valor['formacao']);				

				$html .= "<td>" . $idCertificadoCurso . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idCertificadoCurso'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $titulo . "</td>";
				$html .= "<td>" . $conteudo . "</td>";
				$html .= "<td>" . $nivel . "</td>";
				$html .= "<td>" . $area . "</td>";
				$html .= "<td>" . $certificacao . "</td>";
				$html .= "<td>" . $formacao . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idCertificadoCurso'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectCertificadoCursoSelect() Function
	 */
	function selectCertificadoCursoSelect($classes = "", $idAtual = 0, $where = "", $id="") {
		$sql = "SELECT SQL_CACHE idCertificadoCurso, titulo, conteudo, inativo, dataCadastro, excluido FROM certificadoCurso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idCertificadoCurso".$id."\" name=\"idCertificadoCurso".$id."\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCertificadoCurso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idCertificadoCurso'] . "\">" . ($valor['titulo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$rs = $this->selectCertificadoCurso(" WHERE idCertificadoCurso = ".$id);
	 	return $rs[0]['titulo'];
		
	}

}
?>