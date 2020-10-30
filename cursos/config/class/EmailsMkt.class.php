<?php
class EmailsMkt extends Database {
	// class attributes
	var $idEmailsMkt;
	var $clientePjIdClientePj;
	var $nome;
	var $valor;
	var $inativo;
	var $segmentoIdSegmento;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEmailsMkt = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> nome = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = 0;
		$this -> segmentoIdSegmento = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEmailsMkt($value) {
		$this -> idEmailsMkt = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
	}
	
	function setSegmentoIdSegmento($value) {
		$this -> segmentoIdSegmento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addEstadocivil() Function
	 */
	function addEmailsMkt() {
		$sql = "INSERT INTO emailsMkt (clientePj_idClientePj, nome, valor, inativo, segmento_idSegmento) VALUES ($this->clientePjIdClientePj, $this->nome, $this->valor, $this->inativo, $this->segmentoIdSegmento)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}


	function deleteEmailsMkt() {
		$sql = "DELETE FROM emailsMkt WHERE idEmailsMkt = $this->idEmailsMkt";
		$result = $this -> query($sql, true);
	}
	
	function deleteEmailsMktSegmento() {
		$sql = "DELETE FROM emailsMkt WHERE segmento_idSegmento = $this->segmentoIdSegmento";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEstadocivil() Function
	 */
	function updateFieldEmailsMkt($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE emailsMkt SET " . $field . " = " . $value . " WHERE idEmailsMkt = $this->idEmailsMkt";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEstadocivil() Function
	 */
	function updateEmailsMkt() {
		$sql = "UPDATE emailsMkt SET clientePj_idClientePj = $this->clientePjIdClientePj, nome = $this->nome, valor = $this->valor, inativo = $this->inativo, segmento_idSegmento = $this->segmentoIdSegmento WHERE idEmailsMkt = $this->idEmailsMkt";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEstadocivil() Function
	 */
	function selectEmailsMkt($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEmailsMkt, clientePj_idClientePj, nome, valor, inativo, segmento_idSegmento FROM emailsMkt " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEstadocivilHtml() Function
	 */
	function selectEmailsMktSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idEmailsMkt, clientePj_idClientePj, nome, valor, inativo, segmento_idSegmento FROM emailsMkt  WHERE inativo = 0 ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"emailsMkt_idEmailsMkt\" name=\"emailsMkt_idEmailsMkt\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEmailsMkt'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEmailsMkt'] . "\">" . $valor['nome'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
		function selectEmailsMktTr($where = "", $colunas = array()) {
		$sql = "SELECT SQL_CACHE idEmailsMkt, clientePj_idClientePj, nome, valor, inativo, segmento_idSegmento FROM emailsMkt AS E".$where;
		
		$total_reg = "10";
		
		 $paginador = new Paginador($sql,25);
		
		$ClientePj = new ClientePj();
		$Segmento = new Segmento();
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor2 = mysqli_fetch_array($result)) {
				
				$nomeCliente = $ClientePj->getNome($valor2['clientePj_idClientePj']);
				
				$nomeSegmento = $Segmento->getNome($valor2['segmento_idSegmento']);

				$caminhoAtualizar = CAMINHO_CAD . "emailsMkt/filtro.php";

				
				$emailPessoa = $valor2['valor'];

				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "emailsMkt/formulario.php?id=" . $valor2['idEmailsMkt'] . "', '$caminhoAtualizar', '#centro')\" >" . $valor2['descricao'] . "</td>";
	//			$html .= "<td></td>";
	//			$html .= "<td></td>";			
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "emailsMkt/formulario.php?id=" . $valor2['idEmailsMkt'] . "', '$caminhoAtualizar', '#centro')\" >" . $nomeCliente . "</td>";

				$html .= "<td>" . $emailPessoa . "</td>";
				
				$html .= "<td>". $nomeSegmento."</td>";

				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor2['inativo']) . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "emailsMkt/grava.php', " . $valor2['idEmailsMkt'] . ", '$caminhoAtualizar', '#centro')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";
		//		$html .= "<td></td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}
	
	function selectEmailsMktTotal() {
		
		$Segmento = new Segmento();
		
	$sql = "SELECT COUNT( valor ) as totalParcial, segmento_idSegmento
			FROM emailsMkt
			GROUP BY segmento_idSegmento";	
			
			$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {
			
			$totalGeral += $valor['totalParcial'];
			
			$html .="<tr>";
			$html .= "<td>";
			$html .= $Segmento->getNome($valor['segmento_idSegmento']);
			$html .= "</td>";
			$html .= "<td>".$valor['totalParcial']."</td>";
			
			$html .= "</tr>";	
				
				
			}
		}
		
		
	}
	/*
    function getEstadoCivil($id){
        $sql = "SELECT SQL_CACHE valor FROM estadoCivil  WHERE inativo = 0 AND idEstadoCivil = ".$id;
        $result = $this -> executeQuery($sql);
        return $result[0]['valor'];
    }*/
}