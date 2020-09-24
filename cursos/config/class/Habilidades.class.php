<?php
class Habilidades extends Database {
	// class attributes
	var $idHabilidades;
	var $descricao;
	var $inativo;
	var $habilidadeIdHabilidade;
	var $pergunta;
	var $tipo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idHabilidades = "NULL";
		$this -> descricao = "NULL";
		$this -> inativo = "0";
		$this -> habilidadeIdHabilidade = 0;
		$this -> pergunta = "NULL";
		$this -> tipo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdHabilidades($value) {
		$this -> idHabilidades = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDescricao($value) {
		$this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setHabilidadeIdHabilidade($value) {
		$this -> habilidadeIdHabilidade = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPergunta($value) {
		$this -> pergunta = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addTelefone() Function
	 */
	function addHabilidades() {
		$sql = "INSERT INTO habilidades (descricao, inativo, habilidade_idHabilidade, pergunta, tipo) VALUES ($this->descricao, $this->inativo, $this->habilidadeIdHabilidade, $this->pergunta, $this->tipo)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteHabilidades($or = " 1 = 2 ") {
		$sql = "DELETE FROM habilidades WHERE idHabilidades = $this->idHabilidades OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldHabilidades($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE habilidades SET " . $field . " = " . $value . " WHERE idHabilidade = $this->idHabilidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateHabilidades() {
		$sql = "UPDATE habilidades SET descricao = $this->descricao, inativo = $this->inativo, habilidade_idHabilidade = $this->habilidadeIdHabilidade, pergunta = $this->pergunta, tipo = $this->tipo WHERE idHabilidades = $this->idHabilidades";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectHabilidades($where = "") {
		$sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo, habilidade_idHabilidade, pergunta, tipo FROM habilidades " . $where;
		return $this -> executeQuery($sql);
	}

	function selectHabilidadesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE T.idHabilidades, T.descricao, T.inativo, T.habilidade_idHabilidade, T.pergunta, T.tipo 
		FROM habilidades AS T ".$where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idHabilidades'];
				$nome = $valor['descricao'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$idPai = $valor['habilidade_idHabilidade'];
				$nomePai = $this -> getNome($idPai);
				$pergunta = $valor['pergunta'];
				$tipo = $valor['tipo'];
				
				if ($tipo == 1) {
					$nomeTipo = "Não / Sim mas sem experiência / Sim com experiência.";	
					
				} elseif($tipo == 2) {
					$nomeTipo = "Não / Sim Qual?";
					
				} elseif ($tipo == 3) {
					$nomeTipo = "Não / Sim mas sem experiência / Sim com experiência (escolas).";	
				} elseif ($tipo == 0) {
					$nomeTipo = "Habilidade";	
				}
			
//				$numero = $valor['numero'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . $nome . "</td> 
				
				<td $onclick >" . $nomePai ."</td>
				
				<td $onclick >" . $pergunta . "</td>
				
    			<td $onclick >" . $nomeTipo . "</td>
				
					<td  style=\"text-align:center\">" . $inativo . "</td>
				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "habilidades/include/acao/habilidades.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
		}
		return $html;
	}
	
	function selectHabilidadesCheckbox($where = "",$idProfessor) {

    $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo, tipo, pergunta FROM habilidades ".$where." ORDER BY descricao";
//	echo $sql;
	// WHERE habilidade_idHabilidade = 0 ORDER BY descricao";
    $result = $this -> query($sql);
 
    $HabilidadesProfessor = new HabilidadesProfessor();

    if (mysqli_num_rows($result) > 0) {
 
    $Acompanhamento = $HabilidadesProfessor -> selectHabilidadesProfessor($where);
	
	$html .= "<table>";

      while ($valor = mysqli_fetch_array($result)) {
		  
		if ($Acompanhamento) {
          $where2 =  $where." AND idHabilidade = " . $valor['idHabilidades'];
		  
          $checked = $HabilidadesProfessor -> selectHabilidadesProfessor($where2) ? " checked " : "";

        } 

        $html .= "<tr><td>";

        $html .= "<input type=\"checkbox\" id=\"check_habilidade_" . $valor['idHabilidades'] . "\" name=\"check_habilidade_" . $valor['idHabilidades'] . "\" $checked $onclick value=\"1\" />";

        $html .= "<strong $onclick>" . strtoupper($valor['descricao']) . "</strong> &nbsp;&nbsp;&nbsp;";

         $sql2 = "SELECT SQL_CACHE idHabilidades, descricao, inativo FROM habilidades WHERE habilidade_idHabilidade = ".$valor['idHabilidades']." ORDER BY descricao";
		 
		  $result2 = $this -> query($sql2);
		  
		   while ($valor2 = mysqli_fetch_array($result2)) {
			   
			$where2 =  $where." AND idHabilidade = " . $valor2['idHabilidades'];
		  
          $checked = $HabilidadesProfessor -> selectHabilidadesProfessor($where2) ? " checked " : "";
			   
		 $html .= "<input type=\"checkbox\" id=\"check_habilidade_" . $valor2['idHabilidades'] . "\" name=\"check_habilidade_" . $valor2['idHabilidades'] . "\" $checked $onclick value=\"1\" />";

        $html .= "<strong $onclick>" . strtoupper($valor2['descricao']) . "</strong> &nbsp;&nbsp;&nbsp;";
			   
			   
		   }
		$html .= "</td></tr>";
      }
    }
	$html .= "</table>";
	
    return $html;
  }
  
  function getNome($idHabilidade) {
	   $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo FROM habilidades WHERE idHabilidades =".$idHabilidade;
    $result = Uteis::executarQuery($sql);
	  return $result[0]['descricao'];
  }
  
 	function selectHabilidadesSelect($classes = "", $idAtual = 0, $where = "") {
		$Habilidades = new Habilidades();
	   $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo FROM habilidades ".$where;
		$result = $this -> query($sql);
		$html = "<select id=\"habilidade_idHabilidade\" name=\"habilidade_idHabilidade\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$moduloPai = $Habilidades->getNome($valor['habilidades_idHabilidades']);
			$selecionado = $idAtual == $valor['idHabilidades'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idHabilidades'] . "\">" . ($valor['descricao']) . " - Pai: ".$moduloPai."</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectInteressePerguntas($where = "",$idProfessor) {
	
    $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo, tipo, pergunta FROM habilidades ".$where." AND pergunta IS NOT NULL ORDER BY idHabilidades";
    $result = $this -> query($sql);
 
    $HabilidadesProfessor = new HabilidadesProfessor();

    if (mysqli_num_rows($result) > 0) {
	
	$html .= "<p><legend style=\"margin-bottom: -16px;\">Perguntas (Tipos de alunos e aulas)</legend></p>";
	
	$html .= "<table>";

      while ($valor = mysqli_fetch_array($result)) {

          $where2 =  " WHERE idHabilidade = " . $valor['idHabilidades']." AND idProfessor = ".$idProfessor;
		  
          $valorHabilidade = $HabilidadesProfessor -> selectHabilidadesProfessor($where2);
		  
		  $resposta = $valorHabilidade[0]['resposta'];
		  $anos = $valorHabilidade[0]['anos'];
		  $obs = $valorHabilidade[0]['obs'];
		  $escolas = $valorHabilidade[0]['escolas'];
	
		$tipo = $valor['tipo'];
		$id = $valor['idHabilidades'];
		
		if (!$valorHabilidade) $semResposta = 1; 
		
        $html .= "<tr><td><hr><p><strong>".$valor['pergunta']."</strong></p>";
		
		$html .= $this->resposta($tipo,$id, $anos, $obs, $escolas, $resposta);

		$html .= "</td></tr>";
      }
    }
	$html .= "</table>";
	
    return $html;	
		
		
	}
	
	function resposta($tipo, $id, $anos, $obs, $escolas, $semResposta = 0) {
		
	
	$html = "";
	
	if ($tipo == 1) {
		
		$html .= '<input type="radio" name="pergunta'.$id.'" id="tipo'.$id.'" value="1" ';
			if ($semResposta == 1) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= ' /> Não tenho interesse.<br />';
		$html .= '<input type="radio" name="pergunta'.$id.'" id="pergunta'.$id.'" value="2"';
		   if ($semResposta == 2) { 
		   	$html .=  "checked=\'checked\'"; 
			    } 
		$html .= "/> Tenho interesse, mas não tenho experiência.<br />";
		$html .= '<input type="radio" name="pergunta'.$id.'" id="pergunta'.$id.'" value="3" ';
			if ($semResposta == 3) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= '/> Tenho interesse e tenho experiência de <input type="text" name="perguntaA'.$id.'" id="perguntaA'.$id.'" value="'.$anos.'"/> anos.';
		
	} elseif ($tipo == 2) {
	
		$html .= '<input type="radio" name="pergunta'.$id.'" id="tipo'.$id.'" value="1" ';
			if ($semResposta == 1) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= ' /> Não .<br />';
		$html .= '<input type="radio" name="pergunta'.$id.'" id="pergunta'.$id.'" value="3" ';
			if ($semResposta == 3) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= '/> Sim. Qual ? <input type="text" name="obsA'.$id.'" id="obsA'.$id.'" value="'.$obs.'"/>';
		
	} elseif ($tipo == 3) {
		$html .= '<input type="radio" name="pergunta'.$id.'" id="tipo'.$id.'" value="1" ';
			if ($semResposta == 1) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= ' /> Não tenho interesse.<br />';
		$html .= '<input type="radio" name="pergunta'.$id.'" id="pergunta'.$id.'" value="2"';
		   if ($semResposta == 2) { 
		   	$html .=  "checked=\'checked\'"; 
			    } 
		$html .= "/> Tenho interesse, mas não tenho experiência.<br />";
		$html .= '<input type="radio" name="pergunta'.$id.'" id="pergunta'.$id.'" value="3" ';
			if ($semResposta == 3) { 
				$html .= "checked=\'checked\'"; 
				} 
		$html .= '/> Tenho interesse e tenho experiência de <input type="text" name="perguntaA'.$id.'" id="perguntaA'.$id.'" value="'.$anos.'"/> anos. Escolas <input type="text" name="perguntaE'.$id.'" id="perguntaE'.$id.'" value="'.$escolas.'"/>';
	
	
	}
	
		
	return $html;	
	}

}
?>