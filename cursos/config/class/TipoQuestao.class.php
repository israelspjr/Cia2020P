<?php
class TipoQuestao extends Database {
	// class attributes
	var $idTipoQuestao;
	var $descricao;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoQuestao = "NULL";
		$this -> descricao = "NULL";
		$this -> inativo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoQuestao($value) {
		$this -> idTipoQuestao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDescricao($value) {
		$this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addTelefone() Function
	 */
	function addTipoQuestao() {
		$sql = "INSERT INTO `tipoQuestao`(`descricao`,`inativo`) VALUES ($this->descricao, $this->inativo)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteTipoQuestao($or = " 1 = 2 ") {
		$sql = "DELETE FROM tipoQuestao WHERE idTipoQuestao = $this->idTipoQuestao OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldTipoQuestao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoQuestao SET " . $field . " = " . $value . " WHERE idTipoQuestao = $this->idTipoQuestao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateTipoQuestao() {
		$sql = "UPDATE tipoQuestao SET descricao = $this->descricao, inativo = $this->inativo WHERE idTipoQuestao = $this->idTipoQuestao";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectTipoQuestao($where = "") {
		$sql = "SELECT `tipoQuestao`.`idTipoQuestao`,`tipoQuestao`.`descricao`,`tipoQuestao`.`inativo` FROM `tipoQuestao`" . $where;
		return $this -> executeQuery($sql);
	}

	function selectTipoQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $bc) {
		
//		$Idioma = new Idioma();
		
//		if ($bc == 1)
//		$where .= " AND T.bc = 1";

		$sql = "SELECT `tipoQuestao`.`idTipoQuestao`,`tipoQuestao`.`descricao`,`tipoQuestao`.`inativo` FROM `tipoQuestao` ".$where;
		

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idTipoQuestao'];
	//			$idiomaN = $valor['idioma_idIdioma'];
	//			$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus(!$valor['ativo']);
	//			$bc = Uteis::exibirStatus($valor['bc']);
			
	//			$link = $valor['link'];
				

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . $valor['descricao'] . "</td> ";
//     			<td $onclick >" . $link . "</td>
 //   			<td $onclick >" . $nomeIdioma . "</td>
//				<td $onclick >" . $bc . "</td>
				
		$html .= "<td  style=\"text-align:center\">" . $inativo . "</td>
				

				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "tipoQuestao/grava.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
		}
		return $html;
	}
	
	function selectTipoQuestaoSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT `tipoQuestao`.`idTipoQuestao`,`tipoQuestao`.`descricao`,`tipoQuestao`.`inativo` FROM `tipoQuestao`   WHERE inativo = 0 ORDER BY descricao";
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoQuestao\" name=\"idTipoQuestao\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoQuestao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoQuestao'] . "\">" . $valor['descricao'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
        $rs = $this -> selectTipoQuestao(" WHERE idTipoQuestao = $id");
        return $rs[0]['descricao'];
    }
	/*
	function selectHabilidadesCheckbox($where = "",$idProfessor) {

    $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo FROM habilidades  ";
    $result = $this -> query($sql);
 
    $HabilidadesProfessor = new HabilidadesProfessor();

    if (mysqli_num_rows($result) > 0) {
 
    $Acompanhamento = $HabilidadesProfessor -> selectHabilidadesProfessor($where);

      while ($valor = mysqli_fetch_array($result)) {

        if ($Acompanhamento) {
          $where2 =  $where." AND idHabilidade = " . $valor['idHabilidades'];
		  
          $checked = $HabilidadesProfessor -> selectHabilidadesProfessor($where2) ? " checked " : "";

        } 

        $html .= "<div  >";

        $html .= "<label for=\"check_habilidades_" . $valor['idHabilidades'] . "\">";

        $html .= "<input type=\"checkbox\" id=\"check_habilidade_" . $valor['idHabilidades'] . "\" name=\"check_habilidade_" . $valor['idHabilidades'] . "\" $checked value=\"1\" />";

        $html .= "<strong>" . strtoupper($valor['descricao']) . "</strong> ";

        

        $html .= "<div id=\"div_habilidade_" . $valor['idHabilidades'] . "\" style=\"display:" . ($checked == "" ? "none" : "block") . "</div></div>";
		$html .= "</label>";
      }
    }
    return $html;
  }*/

}
?>