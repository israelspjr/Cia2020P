<?php
class RepresentanteIdioma extends Database {
	// class attributes
	var $idRepresentanteIdioma;
	var $dataCadastro;
	var $representanteIdRepresentante;
	var $idiomaIdIdioma;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRepresentanteIdioma = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> representanteIdRepresentante = "NULL";
		$this -> idiomaIdIdioma = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRepresentanteIdioma($value) {
		$this -> idRepresentanteIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setRepresentanteIdRepresentante($value) {
		$this -> representanteIdRepresentante = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addRepresentanteIdioma() Function
	 */
	function addRepresentanteIdioma() {
		$sql = "INSERT INTO representanteIdioma (dataCadastro, representante_idRepresentante, idioma_idIdioma) VALUES ($this->dataCadastro, $this->representanteIdRepresentante, $this->idiomaIdIdioma)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteRepresentanteIdioma() Function
	 */
	function deleteRepresentanteIdioma() {
		$sql = "DELETE FROM representanteIdioma WHERE idRepresentanteIdioma = $this->idRepresentanteIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRepresentanteIdioma() Function
	 */
	function updateFieldRepresentanteIdioma($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE representanteIdioma SET " . $field . " = " . $value . " WHERE idRepresentanteIdioma = $this->idRepresentanteIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRepresentanteIdioma() Function
	 */
	function updateRepresentanteIdioma() {
		//dataCadastro = $this->dataCadastro,
		$sql = "UPDATE representanteIdioma SET representante_idRepresentante = $this->representanteIdRepresentante, idioma_idIdioma = $this->idiomaIdIdioma WHERE idRepresentanteIdioma = $this->idRepresentanteIdioma";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRepresentanteIdioma() Function
	 */
	function selectRepresentanteIdioma($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRepresentanteIdioma, dataCadastro, representante_idRepresentante, idioma_idIdioma FROM representanteIdioma " . $where;
		return $this -> executeQuery($sql);
	}

	function selectRepresentanteIdiomaTr($where = "") {
		$sql = "SELECT SQL_CACHE ri.idRepresentanteIdioma, i.idioma, ri.representante_idRepresentante idRepresentante 
		FROM representanteIdioma ri 
		INNER JOIN idioma i ON i.idIdioma = ri.idioma_idIdioma " . $where;
		 //echo $sql;
        //exit;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr >";
				$html .= "<td>" . $valor['idioma'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "representante/include/acao/idioma.php', " . $valor['idRepresentanteIdioma'] . ", '" . CAMINHO_CAD . "representante/include/resourceHTML/idioma.php?id=" . $valor['idRepresentante'] . "', '#div_cadastro_idioma')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function exibeIdiomas($id) {

		$sql = "SELECT SQL_CACHE I.idioma
		FROM representanteIdioma AS RI 
		INNER JOIN idioma AS I ON I.idIdioma = RI.idioma_idIdioma 
		WHERE RI.representante_idRepresentante = $id";
		$result = $this -> query($sql);
		$html = "";
		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<div class=\"destacaLinha\">
					" . $valor['idioma'] . "	
				</div>";
			}
		}
		return $html;
	}

}
?>

