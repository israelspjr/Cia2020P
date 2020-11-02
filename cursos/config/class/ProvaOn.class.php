<?php
class ProvaOn extends Database {
	// class attributes
	var $idProvaOn;
	var $nome;
	var $ordem;
	var $obs;
	var $inativo;
	var $excluido;
	var $idomaIdIdioma;
	var $focoCursoIdFocoCurso;
	var $nivelEstudoIdNivelEstudo;
	var $kitMaterialIdKitMaterial;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProvaOn = "NULL";
		$this -> nome = "NULL";
		$this -> ordem = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
		$this -> idiomaIdIdioma = "NULL";
		$this -> focoCursoIdFocoCurso = "0";
		$this -> nivelEstudoIdNivelEstudo = "0";
		$this -> kitMaterialIdKitMaterial = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProvaOn($value) {
		$this -> idProvaOn = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOrdem($value) {
		$this -> ordem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setFocoCursoIdFocoCurso($value) {
		$this -> focoCursoIdFocoCurso = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setNivelEstudoIdNivelEstudo($value) {
		$this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setKitMaterialIdKitMaterial($value) {
		$this -> kitMaterialIdKitMaterial = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	
	/**
	 * addProva() Function
	 */
	function addProvaOn() {
		$sql = "INSERT INTO provaOn (nome, ordem, obs, inativo, excluido, idioma_IdIdioma, focoCurso_IdFocoCurso, nivelEstudo_IdNivelEstudo, kitMaterial_IdKitMaterial) VALUES ($this->nome, $this->ordem, $this->obs, $this->inativo, $this->excluido, $this->idiomaIdIdioma, $this->focoCursoIdFocoCurso, $this->nivelEstudoIdNivelEstudo, $this->kitMaterialIdKitMaterial)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteProva() Function
	 */
	function deleteProvaOn() {
		$sql = "DELETE FROM provaOn WHERE idProvaOn = $this->idProvaOn";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProva() Function
	 */
	function updateFieldProvaOn($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE provaOn SET " . $field . " = " . $value . " WHERE idProvaOn = $this->idProvaOn";
//		echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProva() Function
	 */
	function updateProvaOn() {
		$sql = "UPDATE provaOn SET nome = $this->nome, ordem = $this->ordem, obs = $this->obs, inativo = $this->inativo, idioma_IdIdioma = $this->idiomaIdIdioma, focoCurso_IdFocoCurso = $this->focoCursoIdFocoCurso, nivelEstudo_IdNivelEstudo = $this->nivelEstudoIdNivelEstudo, kitMaterial_IdKitMaterial = $this->kitMaterialIdKitMaterial WHERE idProvaOn = $this->idProvaOn";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProva() Function
	 */
	function selectProvaOn($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProvaOn, nome, ordem, obs, inativo, idioma_IdIdioma, focoCurso_IdFocoCurso, nivelEstudo_IdNivelEstudo, kitMaterial_IdKitMaterial  FROM provaOn " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}


	/**
	 * selectProvaTr() Function
	 */
	function selectProvaOnTrLista($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		
		$Idioma = new Idioma();
		$FocoCurso = new FocoCurso();
		$NivelEstudo = new NivelEstudo();
	//	$KitMaterial = new KitMaterial();
		
		$sql = "SELECT SQL_CACHE idProvaOn, nome, ordem, obs, inativo, excluido, idioma_IdIdioma, focoCurso_IdFocoCurso, nivelEstudo_IdNivelEstudo, kitMaterial_IdKitMaterial FROM provaOn " . $where;
	//	echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idProva = $valor['idProvaOn'];
				$nome = $valor['nome'];
				$ordem = $valor['ordem'];
				$obs = $valor['obs'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				
				$nomeIdioma = $Idioma->getNome($valor['idioma_IdIdioma']);
				
				//Kit Material
				
				 $sql = " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$valor['idioma_IdIdioma'];
  $sql .= " AND INF.nivelEstudo_IdNivelEstudo = ".$valor['nivelEstudo_IdNivelEstudo']." AND INF.focoCurso_idFocoCurso = ".$valor['focoCurso_IdFocoCurso'];
  $sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";  
  $sql .= " AND KMINF.kitMaterial_idKitMaterial = K.idKitMaterial";
  $sql .= " INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = KMINF.kitMaterial_idKitMaterial AND KMD.excluido = 0";
  $sql .= " INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";
  $sql .= " AND MDINF.materialDidatico_idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico";
  $sql .= " INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico";
  $sql .= " WHERE K.idKitMaterial = ".$valor['kitMaterial_IdKitMaterial'];
  
  		//		$nomeMaterial = $KitMaterial->selectKitMaterialDescricao($sql);
	
				$html .= "<td>" . $idProva . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProvaOn'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
		    	$html .= "<td>" . $nomeIdioma . "</td>";
				$html .= "<td>" . $NivelEstudo->getNome($valor['nivelEstudo_IdNivelEstudo']) . "</td>";
				$html .= "<td>" . $FocoCurso->getNome($valor['focoCurso_IdFocoCurso']) . "</td>";
				$html .= "<td>" . $nomeMaterial. "</td>";
				$html .= "<td>".$obs."</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idProvaOn'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}
	
	
/*
	function selectProvaTr_grupo($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $podeExcluir = false, $idPlanoAcaoGrupo,$mobile,$idFolhaFrequencia) {
		
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();
		
//		echo $where;

		$sql = "SELECT SQL_CACHE CP.idCalendarioProva, CP.dataPrevistaInicial, CP.dataPrevistaNova, CP.dataAplicacao, CP.validacao, P.nome 
		FROM calendarioProva AS CP 
		INNER JOIN prova AS P ON P.idProva = CP.prova_idProva "; 
		
		if ($idPlanoAcaoGrupo == '') {
		 $sql = $sql .$where;
		 $sql .= " ORDER BY CP.idCalendarioProva DESC";
		} else {
			
	     		$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);
	
				$valorIdPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_total($idGrupo);
				
				for ($x=0;$x<count($valorIdPlanoAcaoGrupo);$x++) {
					$idPlanoAcaoGrupo2Tmp[] = $valorIdPlanoAcaoGrupo[$x]['idPlanoAcaoGrupo'];
					$idPlanoAcaoGrupo2 = implode(",",$idPlanoAcaoGrupo2Tmp);
				}	
		$sql = "SELECT SQL_CACHE CP.idCalendarioProva, CP.dataPrevistaInicial, CP.dataPrevistaNova, CP.dataAplicacao, CP.validacao, P.nome, NE.nivel
		FROM calendarioProva AS CP 
		INNER JOIN prova AS P ON P.idProva = CP.prova_idProva 
		INNER JOIN planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = CP.planoAcaoGrupo_idPLanoAcaoGrupo
		INNER JOIN planoAcao AS PA on PAG.planoAcao_idPlanoAcao = PA.idPlanoAcao
		INNER JOIN nivelEstudo AS NE on NE.idNivelEstudo = PA.nivelEstudo_idNivelEstudo"; 
				
		$sql .= " WHERE CP.planoAcaoGrupo_idPLanoAcaoGrupo in (".$idPlanoAcaoGrupo2.") ORDER BY CP.idCalendarioProva DESC";
	}
//	echo $sql;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				if ($mobile != 1) {
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/provas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$onclick2 = "onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "resourceHTML/notas.php?id=" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\"";
				} else {
				$onclick = " onclick=\"carregarModulo('" . $caminhoAbrir . "form/provas.php?id=" . $valor['idCalendarioProva'] . "&idFolhaFrequencia=".$idFolhaFrequencia."', '$ondeAtualiza')\" ";	
				$onclick2 = "onclick=\"carregarModulo('" . $caminhoAbrir . "resourceHTML/notas.php?id=" . $valor['idCalendarioProva'] . "&idFolhaFrequencia=".$idFolhaFrequencia."','$ondeAtualiza')\"";
					
				}

				$html .= "<tr>
				
				<td id=\"provaGrupo\" $onclick>" . $valor['nome'] . "</td>
				
				<td $onclick>" . $valor['nivel'] . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataPrevistaInicial']) . ($valor['dataPrevistaNova'] ? " - nova data <strong>" . Uteis::exibirData($valor['dataPrevistaNova']) . "</strong>" : "") . "
				</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataAplicacao']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['validacao']) . "</td>
				
				<td  $onclick2>
					<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Notas\"></center>
				</td>";

				if ($podeExcluir == true) {
					$html .= "
					<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/provas.php', '" . $valor['idCalendarioProva'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
						<center><img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\"></center>
					</td>";
				}

				$html .= "</tr>";

			}
		}
		return $html;
	}

	function selectProvaSelectMult($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idProva, nome, ordem, obs, inativo FROM prova " . $where;
		$result = $this -> query($sql);

		$html = "<select id=\"idProva\" name=\"idProva[]\" multiple=\"multiple\" class=\"" . $classes . "\" >		
		<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProva'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectProvaSelect($classes = "", $idAtual = 0, $where = "") {

		$sql = "SELECT SQL_CACHE idProva, nome, ordem, obs, inativo FROM prova " . $where;
		$result = $this -> query($sql);

		$html = "<select id=\"idProva\" name=\"idProva\" class=\"" . $classes . "\" >		
<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProva'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}*/

}
?>

