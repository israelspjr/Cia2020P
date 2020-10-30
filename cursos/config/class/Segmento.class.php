<?php
class Segmento extends Database {
	// class attributes
	var $idSegmento;
	var $valor;
	var $inativo;
	var $sistema;
	var $bc;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSegmento = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = 0;
		$this -> sistema = 0;
		$this -> bc = 0;

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSegmento($value) {
		$this -> idSegmento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : 0;
	}
	
	function setSistema($value) {
		$this -> sistema = ($value) ? $this -> gravarBD($value) : 0;
	}
	
	function setBc($value) {
		$this -> bc = ($value) ? $this -> gravarBD($value) : 0;
	}

	/**
	 * addEstadocivil() Function
	 */
	function addSegmento() {
		$sql = "INSERT INTO segmento (valor, inativo, sistema, bc) VALUES ($this->valor, $this->inativo, $this->sistema, $this->bc)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

/*	function addEstadocivil_M() {
    $sql = "INSERT INTO estadoCivil (idEstadoCivil, valor, inativo) VALUES ($this->idEstadoCivil, $this->valor, $this->inativo)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }
*/
	/**
	 * deleteEstadocivil() Function
	 */
	function deleteSegmento() {
		$sql = "DELETE FROM segmento WHERE idSegmento = $this->idSegmento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEstadocivil() Function
	 */
	function updateFieldSegmento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE segmento SET " . $field . " = " . $value . " WHERE idSegmento = $this->idSegmento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEstadocivil() Function
	 */
	function updateSegmento() {
		$sql = "UPDATE segmento SET valor = $this->valor, inativo = $this->inativo, sistema = $this->sistema, bc = $this->bc WHERE idSegmento = $this->idSegmento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEstadocivil() Function
	 */
	function selectSegmento($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idSegmento, valor, inativo, sistema, bc FROM segmento " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEstadocivilHtml() Function
	 */
	function selectSegmentoSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idSegmento, valor FROM segmento  WHERE inativo = 0 AND bc = 0 ORDER BY valor";
		$result = $this -> query($sql);
		$html = "<select id=\"segmento_idSegmento\" name=\"segmento_idSegmento\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSegmento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSegmento'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectSegmentoSelectBc($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idSegmento, valor FROM segmento  WHERE inativo = 0 AND bc = 1 ORDER BY valor";
		$result = $this -> query($sql);
		$html = "<select id=\"segmento_idSegmento\" name=\"segmento_idSegmento\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSegmento'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSegmento'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectSegmentoTrBc($where = "", $colunas = array()) {
		$sql = "SELECT SQL_CACHE idSegmento, valor, inativo, sistema FROM segmento WHERE 1 AND bc = 1" . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				$caminhoAtualizar = CAMINHO_CAD . "comunica/index.php";

				$html .= "<tr>";

				$html .= "<td>" . $valor['idSegmento'] . "</td>";
				
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "segmento/formulario.php?id=" . $valor['idSegmento'] . "', '$caminhoAtualizar', '#centro')\" >" . $valor['valor'] . "</td>";

//				

				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";
				
			//	$html .= "<td align=\"center\">" . Uteis::exibirStatus($valor['sistema']) . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "segmento/grava.php', " . $valor['idSegmento'] . ", '$caminhoAtualizar', '#centro')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}
	
		function selectSegmentoTr($where = "", $colunas = array()) {
		$sql = "SELECT SQL_CACHE idSegmento, valor, inativo, sistema FROM segmento WHERE 1 AND bc = 0" . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				$caminhoAtualizar = CAMINHO_CAD . "segmento/index.php";

				$html .= "<tr>";

				$html .= "<td>" . $valor['idSegmento'] . "</td>";
				
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "segmento/formulario.php?id=" . $valor['idSegmento'] . "', '$caminhoAtualizar', '#centro')\" >" . $valor['valor'] . "</td>";

//				

				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";
				
				$html .= "<td align=\"center\">" . Uteis::exibirStatus($valor['sistema']) . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "segmento/grava.php', " . $valor['idSegmento'] . ", '$caminhoAtualizar', '#centro')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}
	
    function getNome($id){
        $sql = "SELECT valor FROM segmento  WHERE idSegmento = ".$id;
       $result = $this -> executeQuery($sql);
        return $result[0]['valor'];
    }
	
	function totalSegmento($where, $soVer) {
		
	//	$Segmento = new Segmento();
		$EmailsMkt = new EmailsMkt();
		
		$sql = "SELECT COUNT(E.valor) AS total, segmento_idSegmento, S.valor
					FROM
    			`emailsMkt` AS E
					INNER JOIN segmento AS S on S.idSegmento = E.segmento_idSegmento";
		$sql .= $where;			
			//	WHERE 1 AND E.inativo = 0";
	//		echo $sql;
		
		$result = Uteis::executarQuery($sql);
		$x = 1;
	if ($x != 1) {
		$html .= "<table>";
		
		
	}
		foreach($result as $valor) {
			
			if ($valor['total'] > 0) {
			
		if ($soVer != 1) {

			if ($x == 3) {
			$html .= "<tr>";
			}
			$html .= "<td><input type=\"checkbox\" value=\"".$valor['segmento_idSegmento']."\" id=\"segmento_idSegmento\" name=\"segmento_idSegmento[]\">".$valor['valor']." -  ".$valor['total']."</td>";
			if ($x == 2) {
			$html .= "</tr>";
			$x = 0;
			}
			$x++;
			
			} else {
				$totalGeral += $valor['total'];
			$html .= "<tr>";
			$html .= "<td>".$valor['valor']."</td>";
			$html .= "<td>".$valor['total']."</td>";
			$html .= "<td align=\"center\" alt=\"Deletar emails deste segmento\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "emailsMkt/delListas.php', " . $valor['segmento_idSegmento'] . ", '".CAMINHO_CAD."/emailsMkt/filtro.php', '#centro')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";
			$html .= "</tr>";	
				
			}
			
		}
		if ($x != 1) {
		$html .= "</table>";
		} else {
			$html .= "<tr>";
			$html .= "<td>Total de Emails:</td>";
			$html .= "<td>".$totalGeral."</td>";
			$html .= "<td></td>";
			$html .= "</tr>";	
			
			}
		
		}
		return $html;
		
	}
	
		function totalSegmentoCheckbox($pago, $idCampanha) {
		
		$Segmento = new Segmento();
		$EmailsMkt = new EmailsMkt();
		$CampanhaLista = new CampanhaLista();
		
		$sql = "SELECT segmento_idSegmento, S.valor FROM `emailsMkt` AS E
    				INNER JOIN
				segmento AS S on S.idSegmento = E.segmento_idSegmento
					WHERE S.bc = 0 GROUP BY E.segmento_idSegmento";
	//	echo $sql;
		
		$result = Uteis::executarQuery($sql);
		$x = 1;
		$html .= "<p>Segmentos avulsos</p>";
		$html .= "<table>";
	
		foreach($result as $valor) {
			
			if ($idCampanha > 0) {
			$rs = $CampanhaLista->selectCampanhaLista(" WHERE lista_idLista = ".$valor['segmento_idSegmento'] ." AND campanha_idCampanha = ".$idCampanha); 
			if ($rs[0]['idCampanhaLista'] > 0) {
				$existe = "checked=\"checked\"";
			} else {
				$existe = "";
			}
				
			}
			
		if ($x == 4) {
			$html .= "<tr>";
		}
			$html .= "<td><input type=\"checkbox\" value=\"".$valor['segmento_idSegmento']."\" id=\"segmento_idSegmento\" $existe name=\"segmento_idSegmento[]\">".$Segmento->getNome($valor['segmento_idSegmento'])." -  ".$valor['total']."</td>";
		if ($x == 3) {
			$html .= "</tr>";
			$x = 0;
		}
			$x++;
		}
		
		$html .= "</table>";
		
		$sql = "SELECT idSegmento, valor FROM `segmento` WHERE sistema = 1 order by valor ";
		
	//	echo $sql;
		
		$result = Uteis::executarQuery($sql);
		$x = 1;
		$html .= "<p>Segmentos do Sistema</p>";
		$html .= "<table>";
	
		foreach($result as $valor) {
			
			if ($idCampanha > 0) {
			$rs = $CampanhaLista->selectCampanhaLista(" WHERE lista_idLista = ".$valor['idSegmento'] ." AND campanha_idCampanha = ".$idCampanha); 
			if ($rs[0]['idCampanhaLista'] > 0) {
				$existe = "checked=\"checked\"";
			} else {
				$existe = "";
			}
				
			}
			
		if ($x == 4) {
			$html .= "<tr>";
		}
			$html .= "<td><input type=\"checkbox\" value=\"".$valor['idSegmento']."\" id=\"segmento_idSegmento\" $existe name=\"segmento_idSegmento[]\">".$valor['valor']." </td>";
		if ($x == 3) {
			$html .= "</tr>";
			$x = 0;
		}
			$x++;
		}
		
		$html .= "</table>";
		
		
				return $html;
		
	}
	
}