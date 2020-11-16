<?php
class TextoEmailPadrao extends Database {
	// class attributes
	var $idtextoEmailPadrao;
	var $texto;
	var $titulo;
	var $excluido;
	var $candidato;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idtextoEmailPadrao = "NULL";
		$this -> texto = "NULL";
		$this -> titulo = "NULL";
		$this -> excluido = "0";
		$this -> candidato = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdtextoEmailPadrao($value) {
		$this -> idtextoEmailPadrao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTexto($value) {
		$this -> texto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setCandidato($value) {
		$this -> candidato = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTextoEmailPadrao() Function
	 */
	function addTextoEmailPadrao() {
		$sql = "INSERT INTO textoEmailPadrao (texto, titulo, excluido, candidato) VALUES ($this->texto, $this->titulo, $this->excluido, $this->candidato)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTextoEmailPadrao() Function
	 */
	function deleteTextoEmailPadrao() {
		$sql = "DELETE FROM textoEmailPadrao WHERE idtextoEmailPadrao = $this->idtextoEmailPadrao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTextoEmailPadrao() Function
	 */
	function updateFieldTextoEmailPadrao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE textoEmailPadrao SET " . $field . " = " . $value . " WHERE idtextoEmailPadrao = $this->idtextoEmailPadrao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTextoEmailPadrao() Function
	 */
	function updateTextoEmailPadrao() {
		//, titulo = $this->titulo
		$sql = "UPDATE textoEmailPadrao SET titulo = $this->titulo, texto = $this->texto, excluido = $this->excluido, candidato = $this->candidato WHERE idtextoEmailPadrao = $this->idtextoEmailPadrao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTextoEmailPadrao() Function
	 */
	function selectTextoEmailPadrao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idtextoEmailPadrao, texto, titulo, excluido, candidato FROM textoEmailPadrao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTextoEmailPadraoTr() Function
	 */
	function selectTextoEmailPadraoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		
		$sql = "SELECT SQL_CACHE idtextoEmailPadrao, texto, titulo, excluido FROM textoEmailPadrao " . $where;
		$result = $this -> query($sql);
		
		if (mysqli_num_rows($result) > 0) {
			
			$html = "";
			
			while ($valor = mysqli_fetch_array($result)) {
				
				$idtextoEmailPadrao = $valor['idtextoEmailPadrao'];				
				$titulo = $valor['titulo'];
        $ativo = $valor['excluido'];
				
				$html .= "<tr>							
				<td onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idtextoEmailPadrao', '$caminhoAtualizar', '$ondeAtualiza')\" >$titulo</td>
				<td>".Uteis::exibirStatus(!$ativo)."</td>
				</tr>";
				
			}
		}
		return $html;
	}


	function getTexto($id) {
		if( $id ){
			$rs = $this->selectTextoEmailPadrao(" WHERE idtextoEmailPadrao = $id");
			return $rs[0]['texto'];	
		}		
	}

}
?>