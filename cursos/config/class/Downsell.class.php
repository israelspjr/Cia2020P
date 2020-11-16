<?php
class Downsell extends Database {
	// class attributes
	var $idDownsell;
	var $tipo;
	var $dataInicio;
	var $dataTermino;
    var $descricao;
	var $inativo;
	var $dataCadastro;
	var $planoAcaoGrupo_idPlanoAcaoGrupo;
	var $upselling;
	var $cargaAntiga;
	var $cargaNova;
	
	
	// constructor
	function __construct() {
		parent::__construct();
		$this -> idDownsell = "NULL";
		$this -> tipo = "0";
		$this -> dataInicio = "NULL";
		$this -> dataTermino = "NULL";
		$this -> descricao = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo;
		$this -> upselling = "0";
		$this -> cargaAntiga = "NULL";
		$this -> cargaNova = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdDownsell($value) {
		$this -> idDownsell = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataInicio($value) {
		$this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataTermino($value) {
		$this -> dataTermino = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setDescricao($value) {
        $this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
    }
    
    
	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function setPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setUpselling($value) {
		$this -> upselling = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setCargaAntiga($value) {
		$this -> cargaAntiga = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCargaNova($value) {
		$this -> cargaNova = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addDownsell() Function
	 */
	function addDownsell() {
		$sql = "INSERT INTO downsell (tipo, dataInicio, dataTermino, descricao, inativo, dataCadastro, planoAcaoGrupo_idPlanoAcaoGrupo, upselling, cargaAntiga, cargaNova) VALUES ($this->tipo, $this->dataInicio, $this->dataTermino, $this->descricao, $this->inativo, $this->dataCadastro, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->upselling, $this->cargaAntiga, $this->cargaNova)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteDownsell() Function
	 */
	function deleteDownsell() {
		$sql = "DELETE FROM downsell WHERE idDownsell = $this->idDownsell";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldDownsell() Function
	 */
	function updateFieldDownsell($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE downsell SET " . $field . " = " . $value . " WHERE idDownsell = $this->idDownsell";
		$result = $this -> query($sql, true);
	}



	/**
	 * updateDownsell() Function
	 */
	function updateDownsell() {
		$sql = "UPDATE downsell SET tipo = $this->tipo, dataInicio = $this->dataInicio, dataTermino = $this->dataTermino, descricao = $this->descricao, inativo = $this->inativo, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, upselling = $this->upselling, cargaAntiga = $this->cargaAntiga, cargaNova = $this->cargaNova WHERE idDownsell = $this->idDownsell";
//	echo $sql;
		$result = $this -> query($sql, true);
	}
	/**
	 * selectDownsell() Function
	 */
	function selectDownsell($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idDownsell, tipo, dataInicio, dataTermino, descricao, inativo, dataCadastro, planoAcaoGrupo_idPlanoAcaoGrupo, upselling, cargaAntiga, cargaNova FROM downsell " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectDownsellTr() Function
	 */
	function selectDownsellTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "", $idProfessor) {
		
		$Grupo = new Grupo();

		$sql = "SELECT SQL_CACHE idDownsell, tipo, dataInicio, dataTermino, descricao, inativo, dataCadastro, planoAcaoGrupo_idPlanoAcaoGrupo, upselling, cargaAntiga, cargaNova FROM downsell " . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {
	
				$tipo = $valor['tipo'] == 1 ? "Temporario" : "Permanente";

				$html .= "<tr align=\"center\">";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/downsell.php?id=" . $valor['idDownsell'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";

				$html .= "<td $onclick >" . $tipo . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataInicio']). "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataTermino']). "</td>";

				$html .= "<td $onclick >" . $valor['descricao'] . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirHoras($valor['cargaAntiga']) . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirHoras($valor['cargaNova']) . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirStatus($valor['upselling']) . "</td>";
				
				$html .= "<td $onclick >" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";
		
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_REL. "grupo/include/acao/downsell.php', " . $valor['idDownsell'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		
				
		return $html;
	}

}
?>

