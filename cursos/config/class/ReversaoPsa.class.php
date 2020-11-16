<?php
class ReversaoPsa extends Database {
	// class attributes
	var $idReversaoPsa;
	var $idPsaNegativa;
	var $idPsaRevertidaCod;
	var $inativo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idReversaoPsa = "NULL";
		$this -> idPsaNegativa = "NULL";
		$this -> idPsaRevertidaCod = "NULL";
		$this -> inativo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdReversaoPsa($value) {
		$this -> idReversaoPsa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdPsaNegativa($value) {
		$this -> idPsaNegativa = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setIdPsaRevertidaCod($value) {
		$this -> idPsaRevertidaCod = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}



	function addReversaoPsa() {
		$sql = "INSERT INTO reversaoPsa (idPsaNegativa, idPsaRevertidaCod, inativo) VALUES ($this->idPsaNegativa, $this->idPsaRevertidaCod, $this->inativo)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}


	function deleteReversaPsa($or = " 1 = 2 ") {
		$sql = "DELETE FROM reversaoPsa WHERE idReversaoPsa = $this->idReversaoPsa OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}


	function updateFieldReversaoPsa($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE reversaoPsa SET " . $field . " = " . $value . " WHERE idReversaoPsa = $this->idReversaoPsa";
		$result = $this -> query($sql, true);
	}


	function updateReversaoPsa() {
		$sql = "UPDATE habilidades SET idPsaNegativa = $this->idPsaNegativa, idPsaRevertidaCod = $this->idPsaRevertidaCod, inativo = $this->inativo WHERE idReversaoPsa = $this->idReversaoPsa";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}


	function selectReversaoPsa($where = "") {
		$sql = "SELECT SQL_CACHE idPsaNegativa, idPsaRevertidaCod, inativo FROM idReversaoPsa " . $where;
		return $this -> executeQuery($sql);
	}

/*	function selectHabilidadesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE T.idHabilidades, T.descricao, T.inativo 
		FROM habilidades AS T ".$where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idHabilidades'];
				$nome = $valor['descricao'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
			
//				$numero = $valor['numero'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . $nome . "</td> 
				
				<td  style=\"text-align:center\">" . $inativo . "</td>";
				
//				<td $onclick >" . $nome . "</td>
				
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "habilidades/include/acao/habilidades.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
		}
		return $html;
	}
	
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