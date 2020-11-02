<?php
class AliquotaTipoImpostoProfessor extends Database {
	// class attributes
	var $idAliquotaTipoImpostoProfessor;
	var $tipoImpostoProfessorIdTipoImpostoProfessor;
	var $de;
	var $ate;
	var $porcentagem;
	var $parcelaDedutiva;
    var $valorMaximo;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAliquotaTipoImpostoProfessor = "NULL";
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = "NULL";
		$this -> de = "0";
		$this -> ate = "NULL";
		$this -> porcentagem = "0";
		$this -> parcelaDedutiva = "0";
        $this -> valorMaximo = "0";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAliquotaTipoImpostoProfessor($value) {
		$this -> idAliquotaTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoImpostoProfessorIdTipoImpostoProfessor($value) {
		$this -> tipoImpostoProfessorIdTipoImpostoProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDe($value) {
		$this -> de = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setAte($value) {
		$this -> ate = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setPorcentagem($value) {
		$this -> porcentagem = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}

	function setParcelaDedutiva($value) {
		$this -> parcelaDedutiva = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
	}
    function setValorMaximo($value) {
        $this -> valorMaximo = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "0";
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

	/**
	 * addAliquotaTipoImpostoProfessor() Function
	 */
	function addAliquotaTipoImpostoProfessor() {
		$sql = "INSERT INTO aliquotaTipoImpostoProfessor (tipoImpostoProfessor_idTipoImpostoProfessor, de, ate, porcentagem, parcelaDedutiva, valorMaximo, inativo, dataCadastro, excluido) VALUES ($this->tipoImpostoProfessorIdTipoImpostoProfessor, $this->de, $this->ate, $this->porcentagem, $this->parcelaDedutiva, $this->valorMaximo, $this->inativo, $this->dataCadastro, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteAliquotaTipoImpostoProfessor() Function
	 */
	function deleteAliquotaTipoImpostoProfessor() {
		$sql = "DELETE FROM aliquotaTipoImpostoProfessor WHERE idAliquotaTipoImpostoProfessor = $this->idAliquotaTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAliquotaTipoImpostoProfessor() Function
	 */
	function updateFieldAliquotaTipoImpostoProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE aliquotaTipoImpostoProfessor SET " . $field . " = " . $value . " WHERE idAliquotaTipoImpostoProfessor = $this->idAliquotaTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAliquotaTipoImpostoProfessor() Function
	 */
	function updateAliquotaTipoImpostoProfessor() {
		$sql = "UPDATE aliquotaTipoImpostoProfessor SET tipoImpostoProfessor_idTipoImpostoProfessor = $this->tipoImpostoProfessorIdTipoImpostoProfessor, de = $this->de, ate = $this->ate, porcentagem = $this->porcentagem, parcelaDedutiva = $this->parcelaDedutiva, valorMaximo = $this->valorMaximo, inativo = $this->inativo WHERE idAliquotaTipoImpostoProfessor = $this->idAliquotaTipoImpostoProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAliquotaTipoImpostoProfessor() Function
	 */
	function selectAliquotaTipoImpostoProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAliquotaTipoImpostoProfessor, tipoImpostoProfessor_idTipoImpostoProfessor, de, ate, porcentagem, parcelaDedutiva, valorMaximo, inativo, dataCadastro, excluido 
		FROM aliquotaTipoImpostoProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectAliquotaTipoImpostoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $caminhoModulo = "") {
			
		$sql = "SELECT SQL_CACHE A.idAliquotaTipoImpostoProfessor, A.tipoImpostoProfessor_idTipoImpostoProfessor, A.de, A.ate, A.porcentagem, A.parcelaDedutiva, A.valorMaximo, A.inativo, T.sigla AS nomeTipoImpostoProfessor 
		FROM aliquotaTipoImpostoProfessor AS A 
		INNER JOIN tipoImpostoProfessor AS T ON A.tipoImpostoProfessor_idTipoImpostoProfessor = T.idTipoImpostoProfessor " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idAliquotaTipoImpostoProfessor = $valor['idAliquotaTipoImpostoProfessor'];				
				$tipoImpostoProfessor_idTipoImpostoProfessor = $valor['nomeTipoImpostoProfessor'];
				$de = Uteis::formatarMoeda($valor['de']);
				$ate = Uteis::formatarMoeda($valor['ate'], true);
				$porcentagem = Uteis::formatarMoeda($valor['porcentagem']);
				$parcelaDedutiva = Uteis::formatarMoeda($valor['parcelaDedutiva']);
                $valorMaximo = Uteis::formatarMoeda($valor['valorMaximo']);
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idAliquotaTipoImpostoProfessor'] . $idPai . "', '" . $caminhoAtualizar .  "', '$ondeAtualiza')\" ";
				
				$html .= "<tr>";
				
				$html .= "<td $onclick>" . $idAliquotaTipoImpostoProfessor . "</td>";
				$html .= "<td $onclick>
					" . $tipoImpostoProfessor_idTipoImpostoProfessor . "
				</td>";
				$html .= "<td $onclick>R$ " . $de . "</td>";
				$html .= "<td $onclick>" .($ate ? "R$ $ate" : "ilimitado"). "</td>";
				$html .= "<td $onclick>" . $porcentagem . "%</td>";
				$html .= "<td $onclick>R$ " . $parcelaDedutiva . "</td>";
                $html .= "<td $onclick>" . (($valorMaximo > 0)? "R$ $valorMaximo":"não se aplica") . "</td>";
				$html .= "<td $onclick>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idAliquotaTipoImpostoProfessor'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectAliquotaTipoImpostoProfessorSelect() Function
	 */
	function selectAliquotaTipoImpostoProfessorSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAliquotaTipoImpostoProfessor, tipoImpostoProfessor_idTipoImpostoProfessor, de, ate, porcentagem, parcelaDedutiva, valorMaximo, inativo, dataCadastro, excluido FROM aliquotaTipoImpostoProfessor " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAliquotaTipoImpostoProfessor\" name=\"idAliquotaTipoImpostoProfessor\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAliquotaTipoImpostoProfessor'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAliquotaTipoImpostoProfessor'] . "\">" . ($valor['idAliquotaTipoImpostoProfessor']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>