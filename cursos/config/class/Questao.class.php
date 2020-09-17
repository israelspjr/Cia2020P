<?php
class Questao extends Database {
	// class attributes
	var $idQuestao;
	var $nivelEstudoIdNivelEstudo;
	var $titulo;
	var $enunciado;
	var $imagem;
	var $inativo;
	var $dataCadastro;
	var $questaoIdQuestao;
	var $tipoQuestaoIdTipoQuestao;
	var $idiomaIdIdioma;
	var $categoria;
	var $subCategoria;
	var $tempo;
	var $audio;
	var $idFocoCurso;
	var $idKitMaterial;
	var $audio2;
	var $audio3;
	var $audio4;
	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idQuestao = "NULL";
		$this -> nivelEstudoIdNivelEstudo = "NULL";
		$this -> titulo = "NULL";		
		$this -> enunciado = "NULL";		
		$this -> imagem = "NULL";
		$this -> inativo = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> questaoIdQuestao = "NULL";
		$this -> tipoQuestaoIdTipoQuestao = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> categoria = "NULL";
		$this -> subCategoria = "NULL";
		$this -> tempo = "NULL";
		$this -> audio = "NULL";
		$this -> idFocoCurso = "NULL";
		$this -> idKitMaterial = "NULL";
		$this -> audio2 = "NULL";
		$this -> audio3 = "NULL";
		$this -> audio4 = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdQuestao($value) {
		$this -> idQuestao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNivelEstudoIdNivelEstudo($value) {
		$this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setEnunciado($value) {
		$this -> enunciado = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setImagem($value) {
		$this -> imagem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }
	
	function setQuestaoIdQuestao($value) {
		$this -> questaoIdQuestao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTipoQuestaoIdTipoQuestao($value) {
		$this -> tipoQuestaoIdTipoQuestao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCategoria($value) {
		$this -> categoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setSubCategoria($value) {
		$this -> subCategoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTempo($value) {
		$this -> tempo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAudio($value) {
		$this -> audio = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdFocoCurso($value) {
		$this -> idFocoCurso = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdKitMaterial($value) {
		$this -> idKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAudio2($value) {
		$this -> audio2 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAudio3($value) {
		$this -> audio3 = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setAudio4($value) {
		$this -> audio4 = ($value) ? $this -> gravarBD($value) : "NULL";
	}


	/**
	 * addTelefone() Function
	 */
	function addQuestao() {
		$sql = "INSERT INTO `questao`(`nivelEstudo_idNivelEstudo`,`titulo`,`enunciado`,`imagem`,`inativo`,`dataCadastro`, `questao_IdQuestao`, `tipoQuestao_idTipoQuestao`, idioma_idIdioma, categoria, subCategoria, tempo, audio, idFocoCurso, idKitMaterial, audio2, audio3, audio4)
VALUES ($this->nivelEstudoIdNivelEstudo, $this->titulo,  $this->enunciado, $this->imagem, $this->inativo, $this->dataCadastro, $this->questaoIdQuestao, $this->tipoQuestaoIdTipoQuestao, $this->idiomaIdIdioma, $this->categoria, $this->subCategoria, $this->tempo, $this->audio, $this->idFocoCurso, $this->idKitMaterial, $this->audio2, $this->audio3, $this->audio4)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteQuestao($or = " 1 = 2 ") {
		$sql = "DELETE FROM questao WHERE idQuestao = $this->idQuestao OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldQuestao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE questao SET " . $field . " = " . $value . " WHERE idQuestao = $this->idQuestao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateQuestao() {
		$sql = "UPDATE questao SET nivelEstudo_idNivelEstudo = $this->nivelEstudoIdNivelEstudo, titulo = $this->titulo, enunciado = $this->enunciado, imagem = $this->imagem, inativo = $this->inativo, questao_idQuestao = $this->questaoIdQuestao, tipoQuestao_idTipoQuestao = $this->tipoQuestaoIdTipoQuestao, idioma_idIdioma = $this->idiomaIdIdioma, categoria = $this->categoria, subCategoria = $this->subCategoria, tempo = $this->tempo, audio = $this->audio, idFocoCurso = $this->idFocoCurso, idKitMaterial = $this->idKitMaterial, audio2 = $this->audio2, audio3 = $this->audio3, audio4 = $this->audio4 WHERE idQuestao = $this->idQuestao";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectQuestao($where = "") {
		$sql = "SELECT `questao`.`idQuestao`,
    `questao`.`nivelEstudo_idNivelEstudo`,
    `questao`.`titulo`,
    `questao`.`enunciado`,
    `questao`.`imagem`,
    `questao`.`inativo`,
    `questao`.`dataCadastro`,
    `questao`.`questao_IdQuestao`, `questao`.`tipoQuestao_idTipoQuestao`, `questao`.`idioma_idIdioma`, `questao`.`categoria`, `questao`.`subCategoria`, `questao`.`tempo`, `questao`.`audio`, idFocoCurso, idKitMaterial, audio2, audio3, audio4
FROM `questao` " . $where;
		return $this -> executeQuery($sql);
	}

	function selectQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $dependentes, $checkbox = 0, $naoCopia = 0) {
		
		$TipoQuestao = new TipoQuestao();
		$Idioma = new Idioma();
		$NivelEstudo = new NivelEstudo();
		$Categoria = new Categoria();
		$SubCategoria = new SubCategoria();
		
		$sql = "SELECT idQuestao, nivelEstudo_idNivelEstudo, titulo, enunciado, imagem, inativo, dataCadastro, questao_IdQuestao, tipoQuestao_idTipoQuestao, idioma_idIdioma, categoria, subCategoria, tempo, audio
FROM questao ".$where;
	//	echo $sql;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idQuestao'];
				$idNivelIdioma = $NivelEstudo->getNome($valor['nivelEstudo_idNivelEstudo']);
				$titulo = $valor['titulo'];
				$enunciado = $valor['enunciado'];
				$nomeTipo = $TipoQuestao->getNome($valor['tipoQuestao_idTipoQuestao']);
				
				$idiomaN = $valor['idioma_idIdioma'];
				$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus(!$valor['ativo']);
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$questao_idQuestao = self::getTitulo($valor['questao_IdQuestao']);
				$categoria = $Categoria->getNome($valor['categoria']);
				$subCategoria = $SubCategoria->getNome($valor['subCategoria']);
				$tempo = Uteis::exibirHoras($valor['tempo']);
				$imagem = $valor['imagem'];
				$audio = $valor['audio'];
				
				if ($audio != '') {
				$audio = "<video controls  name=\"media\"<source src='".CAMINHO_UP."imagem/questoes/".$audio."' type=\"audio/mpeg\"    style= \"height: 150px;\"/></video>";	
					
				}
				
				 if($imagem != ''){
          $imagem = "<img src=\"". CAMINHO_UP."imagem/questoes/miniatura-". $imagem."\" width=\"150\" height=\"100\" />";
           }
				if ($checkbox == 0) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				}
				
				
				if ($checkbox == 1) {
				$input = "<input type=\"checkbox\" value=\"".$idHabilidades."\" name=\"questoes[]\" id=\"questoes[]\"/>";	
					
				} else {
				$input = "";	
					
				}

				$html .= "<tr>
				<td $onclick >" .$input. " ". $idHabilidades . "</td>
				<td $onclick >" . $nomeTipo . "</td>";
				
				if ($dependentes != 1) { 
				$html .= "<td $onclick >" . $nomeIdioma . "</td> 
				<td $onclick >" . $idNivelIdioma . "</td> ";
				} 
				
     			$html .= "<td $onclick >" . $titulo . "</td>";
				if ($dependentes != 1) {
    			$html .= "<td $onclick >" . $enunciado. "</td>
				<td $onclick >" . $imagem  . "</td>
				<td >" . $audio  . "</td>
				<td $onclick >" . $categoria  . "</td>
				<td $onclick >" . $subCategoria  . "</td>
				<td $onclick >" . $tempo  . "</td>
				<td $onclick >" . $dataCadastro . "</td>
				<td $onclick >" . $questao_idQuestao . "</td>";
				} 
				
				$html .= "<td  style=\"text-align:center\">" . $inativo . "</td>";
				
				if ($naoCopia == 0) {
					$copia = "<td onclick=\"copiarRegistro('$idHabilidades')\"><center><img src=\"" . CAMINHO_IMG."copy.png\" title=\"Copiar Questão\"></center></td>"; 
				}
				

//				if ($checkbox == 0) {
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "questoes/grava.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center></td>";
				
//				}
				$html .= $copia;
				
			$html .= "	</tr>";

			}
		}
		return $html;
	}
	
	function selectQuestaoSelect($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT idQuestao, titulo FROM questao where inativo = 0 ".$and;
		
		$result = $this -> query($sql);
		$html = "<select id=\"idQuestao\" name=\"idQuestao\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			
			$titulo = Uteis::resumir($valor['titulo'], 100);
			$selecionado = $idAtual == $valor['idQuestao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idQuestao'] . "\">" . $titulo . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getTitulo($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['titulo']; 	
		
	}
	
	function getEnunciado($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['enunciado']; 	
		
	}
	
	function getImagem($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['imagem']; 	
		
	}
	
	function getAudio($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['audio']; 	
		
	}
	
	function getAudio2($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['audio2']; 	
		
	}
	
	function getAudio3($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['audio3']; 	
		
	}
	
	function getAudio4($id) {
	
	$rs = self::selectQuestao(" WHERE idQuestao = ".$id);
	return $rs[0]['audio4']; 	
		
	}
	

}
?>