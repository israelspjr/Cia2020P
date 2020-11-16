<?php
class AtividadeExtra extends Database {
	// class attributes
	var $idAtividadeExtra;
	var $tipoAtividadeExtraIdTipoAtividadeExtra;
	var $nome;
	var $inativo;
	var $excluido;
    var $ativar;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAtividadeExtra = "NULL";
		$this -> tipoAtividadeExtraIdTipoAtividadeExtra = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
        $this -> ativar = 0;    

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAtividadeExtra($value) {
		$this -> idAtividadeExtra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoAtividadeExtraIdTipoAtividadeExtra($value) {
		$this -> tipoAtividadeExtraIdTipoAtividadeExtra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
    function setAtivar($value) {
        $this -> ativar = ($value) ? $this -> gravarBD($value) : "0";
    }
     
	/**
	 * addAtividadeExtra() Function
	 */
	function addAtividadeExtra() {
		$sql = "INSERT INTO atividadeExtra (tipoAtividadeExtra_idTipoAtividadeExtra, nome, inativo, excluido, ativar) VALUES ($this->tipoAtividadeExtraIdTipoAtividadeExtra, $this->nome, $this->inativo, $this->excluido, $this->ativar)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteAtividadeExtra() Function
	 */
	function deleteAtividadeExtra() {
		$sql = "DELETE FROM atividadeExtra WHERE idAtividadeExtra = $this->idAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAtividadeExtra() Function
	 */
	function updateFieldAtividadeExtra($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE atividadeExtra SET " . $field . " = " . $value . " WHERE idAtividadeExtra = $this->idAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAtividadeExtra() Function
	 */
	function updateAtividadeExtra() {
		$sql = "UPDATE atividadeExtra SET tipoAtividadeExtra_idTipoAtividadeExtra = $this->tipoAtividadeExtraIdTipoAtividadeExtra, nome = $this->nome, inativo = $this->inativo, ativar = $this->ativar WHERE idAtividadeExtra = $this->idAtividadeExtra";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAtividadeExtra() Function
	 */
	function selectAtividadeExtra($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAtividadeExtra, tipoAtividadeExtra_idTipoAtividadeExtra, nome, inativo, excluido, ativar FROM atividadeExtra " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectAtividadeExtraTr() Function
	 */
	function selectAtividadeExtraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE a.idAtividadeExtra, a.tipoAtividadeExtra_idTipoAtividadeExtra, a.nome, a.inativo, a.excluido, a.ativar, t.nome as nomeTipoAtividadeExtra  FROM atividadeExtra a  INNER JOIN  tipoAtividadeExtra t ON t.idTipoAtividadeExtra = a.tipoAtividadeExtra_idTipoAtividadeExtra " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idAtividadeExtra = $valor['idAtividadeExtra'];
				$tipoAtividadeExtra_idTipoAtividadeExtra = $valor['nomeTipoAtividadeExtra'];
				$nome = $valor['nome'];
				$ativar = Uteis::exibirStatus($valor['ativar']);
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idAtividadeExtra . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idAtividadeExtra'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tipoAtividadeExtra_idTipoAtividadeExtra . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
                $html .= "<td>" . $ativar . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idAtividadeExtra'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectAtividadeExtraSelect() Function
	 */
	function selectAtividadeExtraSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAtividadeExtra, tipoAtividadeExtra_idTipoAtividadeExtra, nome, inativo, excluido FROM atividadeExtra " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAtividadeExtra\" name=\"idAtividadeExtra\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAtividadeExtra'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAtividadeExtra'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectAtividadeextraCheckbox($idClientePf) {

		//echo "##$this->tipoAtividadeExtraIdTipoAtividadeExtra";
		$sql = "SELECT SQL_CACHE idAtividadeExtra, nome, ativar FROM atividadeExtra WHERE inativo = 0 AND tipoAtividadeExtra_idTipoAtividadeExtra = " . ($this -> tipoAtividadeExtraIdTipoAtividadeExtra);

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";

			$OpcaoAtividadeExtraClientePf = new OpcaoAtividadeExtraClientePf();
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<div style=\"float:left;width:20%;\">";
				$html .= "<label for=\"check_Atividadeextra_" . $valor['idAtividadeExtra'] . "\">";
				$html .= "<input type=\"checkbox\" id=\"check_Atividadeextra_" . $valor['idAtividadeExtra'] . "\" name=\"check_Atividadeextra_" . $valor['idAtividadeExtra'] . "\"";
				$where = " WHERE clientePf_idClientePf = " . $idClientePf . " AND atividadeExtra_idAtividadeExtra = " . $valor['idAtividadeExtra'];
				$op = $OpcaoAtividadeExtraClientePf -> selectopcaoAtividadeExtraClientePf($where);
				$html .= $op[0]['idopcaoAtividadeExtraClientePf'] ? " checked " : "";
                 if($valor['ativar']==1){
                            $extra = "Complemento:<textarea name=\"obs_Atividadeextra_" . $valor['idAtividadeExtra']."\" id=\"obs_Atividadeextra_" . $valor['idAtividadeExtra']."\" >".$op[0]['obs']."</textarea>";    
                    }else{
                        $extra ="";
                    }
				$html .= " value=\"1\" />" . $valor['nome'] ." ".$extra."</label>";
				$html .= "</div>";
			}
		}
		return $html;
	}

}
?>