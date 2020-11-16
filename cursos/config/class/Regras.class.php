<?php
class Regras extends Database {
	// class attributes
	var $idRegras;
	var $tituloRegra;
    var $id_migracao;
	var $regra;
	var $inativo;
	var $padrao;
	var $dataCadastro;
	var $excluido;
	var $tipoCursoIdCurso;
	var $B2B;
	var $B2C;
	var $planoAcaoIdPlanoAcao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRegras = "NULL";
        $this -> id_migracao = "NULL";
		$this -> tituloRegra = "NULL";
		$this -> regra = "NULL";
		$this -> inativo = "NULL";
		$this -> padrao = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";
        $this -> tipoCursoIdCurso = "NULL";
		$this -> B2B = "0";
		$this -> B2C = "0";
		$this -> planoAcaoIdPlanoAcao = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRegras($value) {
		$this -> idRegras = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
    function setID_migracao($value){
        $this -> id_migracao = ($value) ? $this -> gravarBD($value) : "NULL";
    }
  
	function setTituloRegra($value) {
		$this -> tituloRegra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRegra($value) {
		$this -> regra = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setPadrao($value) {
		$this -> padrao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setTipoCursoIdCurso($value) {
		$this -> tipoCursoIdCurso = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setB2b($value) {
		$this -> B2B = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setB2c($value) {
		$this -> B2C = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addRegras() Function
	 */
	function addRegras() {
		$sql = "INSERT INTO regras (id_migracao, tituloRegra, regra, inativo, padrao, dataCadastro, excluido, tipoCursoIdCurso, B2B, B2C, planoAcao_idPlanoAcao) VALUES ($this->id_migracao, $this->tituloRegra, $this->regra, $this->inativo, $this->padrao, '" . date('Y-m-y H:i:s') . "', $this->excluido, $this->tipoCursoIdCurso, $this->B2B, $this->B2C, $this->planoAcaoIdPlanoAcao)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteRegras() Function
	 */
	function deleteRegras() {
		$sql = "DELETE FROM regras WHERE idRegras = $this->idRegras";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRegras() Function
	 */
	function updateFieldRegras($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE regras SET " . $field . " = " . $value . " WHERE idRegras = $this->idRegras";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRegras() Function
	 */
	function updateRegras() {
		$sql = "UPDATE regras SET tituloRegra = $this->tituloRegra, regra = $this->regra, inativo = $this->inativo, padrao = $this->padrao, tipoCursoIdCurso = $this->tipoCursoIdCurso, B2B = $this->B2B, B2C = $this->B2C, planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao WHERE idRegras = $this->idRegras";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRegras() Function
	 */
	function selectRegras($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRegras, id_migracao, tituloRegra, regra, inativo, padrao, dataCadastro, excluido, tipoCursoIdCurso, B2B, B2C, planoAcao_idPlanoAcao FROM regras " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectRegrasTr() Function
	 */
	function selectRegrasTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		
		$TipoCurso = new TipoCurso();
		
		$sql = "SELECT SQL_CACHE idRegras, tituloRegra, regra, inativo, padrao, dataCadastro, excluido, tipoCursoIdCurso, B2B, B2C, planoAcao_idPlanoAcao FROM regras " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			
			while ($valor = mysqli_fetch_array($result)) {
			//	$TipoCurso = "";
				$html .= "<tr>";

				$idRegras = $valor['idRegras'];
				$tituloRegra = $valor['tituloRegra'];
				$regra = $valor['regra'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$padrao = Uteis::exibirStatus($valor['padrao']);
				//$tipoCursoIdCurso = explode(",",$valor['tipoCursoIdCurso']);
								
				$tipoCursoD = $valor['tipoCursoIdCurso'];
	//			echo $tipoCursoD;
				if ($tipoCursoD == "8") {
					$nomeCurso = " Todos<br>";
				} else {
				$Ncurso = $TipoCurso->selectTipoCurso(" WHERE idTipoCurso in (".$tipoCursoD.")");
			//	Uteis::pr($Ncurso);
				$nomeCurso = "";
				
					foreach ($Ncurso as $v) {
						$nomeCurso .= $v['nome']."<br>";
					}
				}
				
		//		Uteis::pr($nomeCurso);
				/*if (in_array("8", $tipoCursoIdCurso)) {
					$TipoCurso .= " Todos<br>";
				}
				
				if (in_array("0", $tipoCursoIdCurso)) {
					$TipoCurso .= " Presencial<br>";
				}
				
				if (in_array("5", $tipoCursoIdCurso)) {
					$TipoCurso .= " Presencial Premium<br>";
				}
				
				if (in_array("4", $tipoCursoIdCurso)) {
					$TipoCurso .= " Na Tela<br>";
				}
				
				if (in_array("6", $tipoCursoIdCurso)) {
					$TipoCurso .= " Na Tela Premium <br>";
				}
				
				if (in_array("7", $tipoCursoIdCurso)) {
					$TipoCurso .= " Na Tela Trilhas<br>";
				}*/
				
				
				//

				$html .= "<td>" . $idRegras . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idRegras'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $tituloRegra . "</td>";
				$html .= "<td>".$nomeCurso."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td>" . $padrao . "</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['B2B'])."</td>";
				$html .= "<td>" . Uteis::exibirStatus($valor['B2C'])."</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idRegras'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectRegrasSelect() Function
	 */
	function selectRegrasSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idRegras, tituloRegra, regra, inativo, padrao, dataCadastro, excluido FROM regras " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idRegras\" name=\"idRegras\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idRegras'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idRegras'] . "\">" . ($valor['idRegras']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectRegrasCheckbox($idPlanoAcao, $addQuery = "",$apenasVer) {

		$sql = "SELECT SQL_CACHE idRegras, tituloRegra, regra, padrao, tipoCursoIdCurso FROM regras WHERE excluido = 0 AND inativo = 0 " . $addQuery . " ORDER BY tituloRegra ";
		$result = $this -> query($sql);

		$PlanoAcaoRegras = new PlanoAcaoRegras();

		if (mysqli_num_rows($result) > 0) {
			$html = "";

			//CONSULTA SE HÁ ALGUMA REGRA INSERIDA PARA O PLANO
			$where = " WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao;
			$PlanoAcaoRegras -> selectPlanoAcaoRegras($where);
			$regrasParaPlano = $PlanoAcaoRegras -> selectPlanoAcaoRegras($where);

			if (!$regrasParaPlano)
				echo "<center><strong>* Como não há nenhuma regra definida para este plano de ação, as regras padrões vieram checkadas. Para vincular as regras ao plano, clique em \"Enviar\".</strong></center>";

			while ($valor = mysqli_fetch_array($result)) {

				if ($regrasParaPlano) {
					$where = " WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao . " AND regras_idRegras = " . $valor['idRegras'];
					$checked = $PlanoAcaoRegras -> selectPlanoAcaoRegras($where) ? " checked " : "";
				} else {
					$checked = $valor['padrao'] ? " checked " : "";
				}

				$html .= "<div  >";

				$html .= "<img id=\"img_regras_" . $valor['idRegras'] . "\" src=\"" . CAMINHO_IMG . ($checked == "" ? "mais" : "menos") . ".png\" onclick=\"abrirFormulario('div_regras_" . $valor['idRegras'] . "', 'img_regras_" . $valor['idRegras'] . "')\" style=\"float:left; margin-right:10px;\" />";

				$html .= "<label for=\"check_Regras_" . $valor['idRegras'] . "\">";

				if ($apenasVer == 1) {
					$disabled = "disabled = 'disabled'";
				}
					
				$html .= "<input type=\"checkbox\" id=\"check_Regras_" . $valor['idRegras'] . "\" name=\"check_Regras_" . $valor['idRegras'] . "\" $checked value=\"1\" ". $disabled." />";

				$html .= "<strong>" . strtoupper($valor['tituloRegra']) . "</strong> ";

				$html .= "</label>";

				$html .= "<div id=\"div_regras_" . $valor['idRegras'] . "\" style=\"display:" . ($checked == "" ? "none" : "block") . "; padding:1em; text-align:justify;\" >" . strip_tags($valor['regra'],"<b><strong>") . "</div>";
                
                $html .= "</div>";
			}
		}
		return $html;
	}

}
?>