<?php
class Resposta extends Database {
	// class attributes
	var $idResposta;
	var $questaoIdQuestao;
	var $correta;
	var $ordem;
	var $resposta;
	var $inativo;
	var $respostaAssociada;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idResposta = "NULL";
		$this -> questaoIdQuestao = "NULL";
		$this -> correta = "NULL";		
		$this -> ordem = "NULL";		
		$this -> resposta = "NULL";
		$this -> inativo = "0";
		$this -> respostaAssociada = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdResposta($value) {
		$this -> idResposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuestaoIdQuestao($value) {
		$this -> questaoIdQuestao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCorreta($value) {
		$this -> correta = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setOrdem($value) {
		$this -> ordem = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setResposta($value) {
		$this -> resposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setRespostaAssociada($value) {
		$this -> respostaAssociada = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	/**
	 * addTelefone() Function
	 */
	function addResposta() {
		$sql = "INSERT INTO `resposta` (`questao_idQuestao`, `correta`, `ordem`, `resposta`, `inativo`, `respostaAssociada`)
VALUES ($this->questaoIdQuestao, $this->correta,  $this->ordem, $this->resposta, $this->inativo, $this->respostaAssociada)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteResposta($or = " 1 = 2 ") {
		$sql = "DELETE FROM resposta WHERE idResposta = $this->idResposta OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldResposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE resposta SET " . $field . " = " . $value . " WHERE idResposta = $this->idResposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateResposta() {
		$sql = "UPDATE resposta SET questao_idQuestao = $this->questaoIdQuestao, correta = $this->correta, ordem = $this->ordem, resposta = $this->resposta, inativo = $this->inativo, respostaAssociada = $this->respostaAssociada WHERE idResposta = $this->idResposta";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectResposta($where = "") {
		$sql = "SELECT idResposta, questao_idQuestao, correta, ordem, resposta, inativo, respostaAssociada
FROM resposta" . $where;
//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectRespostaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {
		
	//	$TipoRespsota = new TipoRespsota();
	//	$Idioma = new Idioma();
	//	$NivelEstudo = new NivelEstudo();
		
		$sql = "SELECT `resposta`.`idResposta`,
    `resposta`.`questao_idQuestao`,
    `resposta`.`correta`,
    `resposta`.`ordem`,
    `resposta`.`resposta`,
    `resposta`.`inativo`,
	`resposta`.`respostaAssociada`
FROM `resposta`" . $where;

		$result = $this -> query($sql);

	//	if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idResposta'];
				$idQuestao = $valor['questao_idQuestao'];
				$correta = Uteis::exibirStatus($valor['correta']);
				$ordem = $valor['ordem'];
			//	$nomeTipo = $TipoRespsota->getNome($valor['tipoRespsota_idTipoRespsota']);
				
				$resposta = $valor['resposta'];
		//		$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus(!$valor['ativo']);
		//		$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$respostaAssociada = $valor['respostaAssociada'];
			
		//		$imagem = $valor['imagem'];
				

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idResposta=$idHabilidades&idQuestao=$idQuestao', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				<td $onclick >" . $idHabilidades . "</td>
				<td $onclick >" . $resposta . "</td>
				<td $onclick >" . $respostaAssociada . "</td> 
				<td $onclick >" . $correta  . "</td> 
				<td $onclick >" . $ordem . "</td> 
     			<td  style=\"text-align:center\">" . $inativo . "</td>
				

				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "resposta/grava.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
	//	}
		return $html;
	}
/*	
	function selectRespsotaSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT idRespsota, titulo FROM Respsota where inativo = 0";
		$result = $this -> query($sql);
		$html = "<select id=\"idRespsota\" name=\"idRespsota\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRespsota'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRespsota'] . "\">" . $valor['titulo'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}*/

}
?>