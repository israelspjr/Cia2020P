<?php
class QualidadeComunicacaoPlanoAcao extends Database {
	// class attributes
	var $idQualidadeComunicacaoPlanoAcao;
	var $integrantesPlanoAcaoIdIntegrantesPlanoAcao;
	var $itenQualidadeComunicacaoIdItenQualidadeComunicacao;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idQualidadeComunicacaoPlanoAcao = "NULL";
		$this -> integrantesPlanoAcaoIdIntegrantesPlanoAcao = "NULL";
		$this -> itenQualidadeComunicacaoIdItenQualidadeComunicacao = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdQualidadeComunicacaoPlanoAcao($value) {
		$this -> idQualidadeComunicacaoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegrantesPlanoAcaoIdIntegrantesPlanoAcao($value) {
		$this -> integrantesPlanoAcaoIdIntegrantesPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItenQualidadeComunicacaoIdItenQualidadeComunicacao($value) {
		$this -> itenQualidadeComunicacaoIdItenQualidadeComunicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addQualidadeComunicacaoPlanoAcao() Function
	 */
	function addQualidadeComunicacaoPlanoAcao() {
		$sql = "INSERT INTO qualidadeComunicacaoPlanoAcao (integrantesPlanoAcao_idIntegrantesPlanoAcao, itenQualidadeComunicacao_idItenQualidadeComunicacao, dataCadastro, excluido) VALUES ($this->integrantesPlanoAcaoIdIntegrantesPlanoAcao, $this->itenQualidadeComunicacaoIdItenQualidadeComunicacao, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteQualidadeComunicacaoPlanoAcao() Function
	 */
	function deleteQualidadeComunicacaoPlanoAcao($where) {
		$sql = "DELETE FROM qualidadeComunicacaoPlanoAcao WHERE idQualidadeComunicacaoPlanoAcao = $this->idQualidadeComunicacaoPlanoAcao";
		//echo $sql;
		$result = $this -> query($sql);
	}
	
	function deleteQualidadeComunicacaoPlanoAcaoTodo($where) {
		$sql = "DELETE FROM qualidadeComunicacaoPlanoAcao ".$where;
		//echo $sql;
		$result = $this -> query($sql);
	}
	/**
	 * updateFieldQualidadeComunicacaoPlanoAcao() Function
	 */
	function updateFieldQualidadeComunicacaoPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE qualidadeComunicacaoPlanoAcao SET " . $field . " = " . $value . " WHERE idQualidadeComunicacaoPlanoAcao = $this->idQualidadeComunicacaoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateQualidadeComunicacaoPlanoAcao() Function
	 */
	function updateQualidadeComunicacaoPlanoAcao() {
		$sql = "UPDATE qualidadeComunicacaoPlanoAcao SET integrantesPlanoAcao_idIntegrantesPlanoAcao = $this->integrantesPlanoAcaoIdIntegrantesPlanoAcao, itenQualidadeComunicacao_idItenQualidadeComunicacao = $this->itenQualidadeComunicacaoIdItenQualidadeComunicacao WHERE idQualidadeComunicacaoPlanoAcao = $this->idQualidadeComunicacaoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectQualidadeComunicacaoPlanoAcao() Function
	 */
	function selectQualidadeComunicacaoPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idQualidadeComunicacaoPlanoAcao, integrantesPlanoAcao_idIntegrantesPlanoAcao, itenQualidadeComunicacao_idItenQualidadeComunicacao, dataCadastro, excluido FROM qualidadeComunicacaoPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectQualidadeComunicacaoPlanoAcaoTr() Function
	 */
	function selectQualidadeComunicacaoPlanoAcaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE q.idQualidadeComunicacaoPlanoAcao, q.integrantesPlanoAcao_idIntegrantesPlanoAcao, q.itenQualidadeComunicacao_idItenQualidadeComunicacao, q.dataCadastro, q.excluido, i2.nome nomeItenQualidadeComunicacao, c.nome NomeCli FROM qualidadeComunicacaoPlanoAcao q INNER JOIN integrantePlanoAcao i ON q.integrantesPlanoAcao_idIntegrantesPlanoAcao = i.idIntegrantePlanoAcao INNER JOIN itenQualidadeComunicacao i2 ON i2.idItenQualidadeComunicacao = q.itenQualidadeComunicacao_idItenQualidadeComunicacao INNER JOIN clientePf c ON i.clientePf_idClientePf = c.idClientePf " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idQualidadeComunicacaoPlanoAcao = $valor['idQualidadeComunicacaoPlanoAcao'];
				$integrantesPlanoAcao_idIntegrantesPlanoAcao = $valor['NomeCli'];
				$itenQualidadeComunicacao_idItenQualidadeComunicacao = $valor['nomeItenQualidadeComunicacao'];
				$dataCadastro = $valor['dataCadastro'];

				$html .= "<td>" . $idQualidadeComunicacaoPlanoAcao . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idQualidadeComunicacaoPlanoAcao'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $integrantesPlanoAcao_idIntegrantesPlanoAcao . "</td>";
				$html .= "<td>" . $itenQualidadeComunicacao_idItenQualidadeComunicacao . "</td>";
				//$html .= "<td>".$dataCadastro."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idQualidadeComunicacaoPlanoAcao'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectQualidadeComunicacaoPlanoAcaoSelect() Function
	 */
	function selectQualidadeComunicacaoPlanoAcaoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idQualidadeComunicacaoPlanoAcao, integrantesPlanoAcao_idIntegrantesPlanoAcao, itenQualidadeComunicacao_idItenQualidadeComunicacao, dataCadastro FROM qualidadeComunicacaoPlanoAcao " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idQualidadeComunicacaoPlanoAcao\" name=\"idQualidadeComunicacaoPlanoAcao\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idQualidadeComunicacaoPlanoAcao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idQualidadeComunicacaoPlanoAcao'] . "\">" . ($valor['idQualidadeComunicacaoPlanoAcao']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	/**
	 * selectQualidadeComunicacaoPlanoAcaoCheck() Function
	 */
	function selectQualidadeComunicacaoPlanoAcaoCheck($idIntegrante) {
	  
	$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();    
    $integrante = new IntegrantePlanoAcao();
    $Plano = new PlanoAcao();
    $Proposta = new Proposta();
   
    
    $inte = $integrante->selectIntegrantePlanoAcao("WHERE idIntegrantePlanoAcao = ".$idIntegrante);   
    $PA = $Plano->selectPlanoAcao("WHERE idPlanoAcao = ".$inte[0]['planoAcao_idPlanoAcao']);      
    $prop = $Proposta->selectProposta("where idProposta = ".$PA[0]['proposta_idProposta']);    
    $rsTipo = $TipoQualidadeComunicacao -> selectTipoQualidadeComunicacao("WHERE inativo = 0 AND idioma_idIdioma = ".$prop[0]['idioma_idIdioma']);
      foreach($rsTipo as $valor):
     
	       $html .= "<div style='margin:10px'>";
           $html .= "<p style=\"color:#aa0000;\"><strong>".$valor['nome'] ."</strong>     
           </p>";
     
      //verifica se existe qualidade    
      
      $rsIten = $this -> query("SELECT SQL_CACHE idItenQualidadeComunicacao, nome, descricao FROM itenQualidadeComunicacao
      WHERE tipoQualidadeComunicacao_idTipoQualidadeComunicacao = ".$valor['idTipoQualidadeComunicacao']." ORDER BY nome");
      $cont = 1;
      while ($valor2 = mysqli_fetch_assoc($rsIten)){
           $ver[$cont] = $valor2['nome'];
           if($ver[$cont-1]!=$ver[$cont] AND $ver[$cont]!=$valor['nome'])
                $html .= "<p><strong>".$valor2['nome'] ."</strong></p>";           
            
	      $where1 = " WHERE integrantesPlanoAcao_idIntegrantesPlanoAcao = " . $idIntegrante." AND itenQualidadeComunicacao_idItenQualidadeComunicacao = ".$valor2['idItenQualidadeComunicacao'];
          $Qualy = $this -> selectQualidadeComunicacaoPlanoAcao($where1);
	       if($Qualy[0]['idQualidadeComunicacaoPlanoAcao']){
    		$where2 = " WHERE integrantesPlanoAcao_idIntegrantesPlanoAcao = ".$idIntegrante." AND idQualidadeComunicacaoPlanoAcao = ".$Qualy[0]['idQualidadeComunicacaoPlanoAcao'];
    		$qc = $this->selectQualidadeComunicacaoPlanoAcao($where2);
    		$check = ($qc[0]['itenQualidadeComunicacao_idItenQualidadeComunicacao']) ? "checked" : " ";
    				}else{
    		$check="";		    
    				}
              
      	$html .= "<label>";
        //$html .= "<img id=\"img_qualidade_".$valor2['idItenQualidadeComunicacao']. "\" src=\"" . CAMINHO_IMG . ($check == "" ? "mais" : "menos") . ".png\" onclick=\"abrirFormulario('div_qualidade_" . $valor2['idItenQualidadeComunicacao'] . "', 'img_qualidade_" . $valor2['idItenQualidadeComunicacao'] . "')\" style=\"float:left; margin-right:10px;\" />";
        
		$html .= "<input name=\"iten[]\" type=\"checkbox\" value=\"" . $valor2['idItenQualidadeComunicacao'] . "\" " . $check . " />";
        $html .= strip_tags($valor2['descricao'],"<b><strong>") . "</label>";
       // $html .= "<div id=\"div_qualidade_" . $valor2['idItenQualidadeComunicacao'] . "\" style=\"display:" . ($check == "" ? "none" : "block") . "; padding:1em; text-align:justify;\" >" . strip_tags($valor2['descricao'],"<b><strong>") . "</div>";
        $cont++;
        }
		$html .= "</div>";
        
    endforeach;
    return $html;   
   }

}
?>