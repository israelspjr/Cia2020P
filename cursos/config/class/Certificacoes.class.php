<?php
class Certificacoes extends Database {
	// class attributes
	var $idCertificacoes;
	var $professorIdProfessor;
	var $certificado;
	var $ano;
	var $tipo;
	var $idiomaIdIdioma;
	
	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCertificacoes = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> certificado = "NULL";
		$this -> ano = "NULL";
		$this -> tipo = "NULL";
		$this -> idiomaIdIdioma = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCertificacoes($value) {
		$this -> idCertificacoes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCertificado($value) {
		$this -> certificado = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setAno($value) {
		$this -> ano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}


	/**
	 * addCertificacoes() Function
	 */
	function addCertificacoes() {
		$sql = "INSERT INTO certificacoes (professor_idProfessor, certificado, ano, tipo, idioma_idIdioma) VALUES ($this->professorIdProfessor, $this->certificado, $this->ano, $this->tipo, $this->idiomaIdIdioma)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteCertificacoes() Function
	 */
	function deleteCertificacoes() {
		$sql = "DELETE FROM certificacoes WHERE idCertificacoes = $this->idCertificacoes";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldCertificacoes() Function
	 */
	function updateFieldCertificacoes($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE certificacoes SET " . $field . " = " . $value . " WHERE idCertificacoes = $this->idCertificacoes";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateCertificacoes() Function
	 */
	function updateCertificacoes() {
		$sql = "UPDATE certificacoes SET professor_idProfessor = $this->professorIdProfessor, certificado = $this->certificado, ano = $this->ano, tipo = $this->tipo, idioma_idIdioma = $this->idiomaIdIdioma WHERE idCertificacoes = $this->idCertificacoes";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectCertificacoes() Function
	 */
	function selectCertificacoes($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idCertificacoes, professor_idProfessor, certificado, ano, tipo, idioma_idIdioma FROM certificacoes " . $where;
		return $this -> executeQuery($sql);
	}

	function selectCertificacoesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {
		
		$Idioma = new Idioma();
		$CertificadoCurso = new CertificadoCurso();

	$sql = "SELECT SQL_CACHE idCertificacoes, professor_idProfessor, certificado, ano, tipo, idioma_idIdioma FROM certificacoes " . $where;
	//echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
				
				$nomeCertificado = $CertificadoCurso->getNome($valor['certificado']);
				
				if ($mobile != 1) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/certificacoes.php?id=" . $valor['idCertificacoes'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				
				} else {
				$onclick = " onclick=\"zerarCentro();carregarModulo('" . $caminhoAbrir . "form/certificacoes.php?id=" . $valor['idCertificacoes'] . "', '$caminhoAtualizar', '$ondeAtualiza');\" ";
					
					
				}
				
				if ($valor['tipo'] == 1) {
					$tipo = "Nacional";					
				}
				
				if ($valor['tipo'] == 2) {
					$tipo = "Internacional";	
					
				}
				
				$nomeIdioma = $Idioma->getNome($valor['idioma_idIdioma']);
				
				$html .= "<tr>
				
				<td $onclick >" . $nomeCertificado . "</td>
				
				<td $onclick >" . $valor['ano'] . "</td>
				
				<td $onclick >" . $tipo . "</td>
				
				<td $onclick >" . $nomeIdioma . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/certificacoes.php', " . $valor['idCertificacoes'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}

		return $html;
	}

}
?>