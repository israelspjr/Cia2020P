<?php
class KitMaterial extends Database {
	// class attributes
	var $idKitMaterial;
	var $nome;
	var $obs;
	var $dataCadastro;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idKitMaterial = "NULL";
		$this -> nome = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdKitMaterial($value) {
		$this -> idKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addKitMaterial() Function
	 */
	function addKitMaterial() {
		$sql = "INSERT INTO kitMaterial (nome, obs, dataCadastro, inativo, excluido) VALUES ($this->nome, $this->obs, '" . date('Y-m-y H:i:s') . "', $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteKitMaterial() Function
	 */
	function deleteKitMaterial() {
		$sql = "DELETE FROM kitMaterial WHERE idKitMaterial = $this->idKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldKitMaterial() Function
	 */
	function updateFieldKitMaterial($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE kitMaterial SET " . $field . " = " . $value . " WHERE idKitMaterial = $this->idKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateKitMaterial() Function
	 */
	function updateKitMaterial() {
		$sql = "UPDATE kitMaterial SET nome = $this->nome, obs = $this->obs, inativo = $this->inativo WHERE idKitMaterial = $this->idKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectKitMaterial() Function
	 */
	function selectKitMaterial($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idKitMaterial, nome, obs, dataCadastro, inativo, excluido FROM kitMaterial " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectKitMaterialTr() Function
	 */
	function selectKitMaterialTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idKitMaterial, nome, obs, dataCadastro, inativo, excluido FROM kitMaterial " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idKitMaterial = $valor['idKitMaterial'];
				$nome = $valor['nome'];
				//$obs = $valor['obs'];
				$dataCadastro = $valor['dataCadastro'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idKitMaterial . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idKitMaterial'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				//$html .= "<td>".$obs."</td>";

				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idKitMaterial'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectKitMaterialSelect() Function
	 */

	function selectKitMaterialSelect($classes = "", $idAtual = 0, $addQuery) {

		$sql = "SELECT SQL_CACHE K.idKitMaterial, K.nome FROM kitMaterial AS K " . $addQuery . " WHERE K.inativo = 0 ORDER BY K.nome";
        //echo $sql;   
		$result = $this -> query($sql);
		$html = "<select id=\"idKitMaterial\" name=\"idKitMaterial\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idKitMaterial'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idKitMaterial'] . "\">" . $valor['nome'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
  function selectKitMaterialDescricao($where, $padrao = true) {

    $sql = "SELECT SQL_CACHE Distinct (MD.nome), K.nome AS Ordem, K.inativo FROM kitMaterial AS K " . $where ." AND K.inativo = 0 ORDER BY Ordem";
    
//   echo $sql;   
    $result = $this -> query($sql);
    $html = "<pre>";
    while ($valor = mysqli_fetch_array($result)) {      
      $html .= $valor['nome']."\n";
    }
    $html .= "</pre>";
    return $html;
  }
  
  function AcompanhamentoPorKit($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,$relatorio,$semTr,$mobile, $semInicial){
	  
      $PlanoAcaoGrupo = new PlanoAcaoGrupo();
      $PlanoAcao = new PlanoAcao();  
      $pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoacaoGrupo = ".$idPlanoAcaoGrupo);
      $pa = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao = ".$pag[0]['planoAcao_idPlanoAcao']);   
      $idIdioma = $PlanoAcao->getIdIdioma($pag[0]['planoAcao_idPlanoAcao']);
      $idNivel = $pa[0]['nivelEstudo_IdNivelEstudo'];
      $idFoco = $pa[0]['focoCurso_idFocoCurso'];
	  
	   $sql = "SELECT SQL_CACHE Distinct (MD.nome), K.idKitMaterial, MD.idMaterialDidatico, K.nome AS Ordem, K.inativo, MDINF.unidadeInicial, MDINF.unidadeFinal FROM kitMaterial AS K " ;
	  $sql .= " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma;
  $sql .= " AND INF.nivelEstudo_IdNivelEstudo = ".$idNivel." AND INF.focoCurso_idFocoCurso = ".$idFoco;
  $sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";  
  $sql .= " AND KMINF.kitMaterial_idKitMaterial = K.idKitMaterial";
  $sql .= " INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = KMINF.kitMaterial_idKitMaterial AND KMD.excluido = 0";
  $sql .= " INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";
  $sql .= " AND MDINF.materialDidatico_idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico";
  $sql .= " INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico";
  $sql .= " WHERE 1 "; //K.idKitMaterial = ".$pa[0]['kitMaterial_idKitMaterial'];
  $sql .= " AND K.inativo = 0 GROUP BY MD.nome ORDER BY Ordem";

	  if ($semTr == 1) {
		$sql .= " LIMIT 1";  
		  
	  }
  //     echo $sql;     
      $result = $this -> query($sql);     
      if (mysqli_num_rows($result) > 0) {
      
          $html = "";
		  
		  while ($valor = mysqli_fetch_array($result)) {
			//  echo $mobile;
                $Material = new AcompanhamentoMaterial();
                $AM = $Material->selectAcompanhamentoMaterial("WHERE folhaFrequencia_idFolhaFrequencia =".$idFolhaFrequencia." AND kitMaterial_idKitMaterial =".$valor['idKitMaterial']);
               if ($AM[0]['idAcompanhamentoMaterial']) {
				   if ($mobile != 1) {
                    $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?idKitMaterial=".$valor['idMaterialDidatico']."&idKit=".$valor['idKitMaterial']."&id=" . $AM[0]['idAcompanhamentoMaterial'] ."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
				   } else {
					$onclick = "onclick=\"zerarPlano();carregarModulo('".$abrir."?idKitMaterial=".$valor['idMaterialDidatico']."&idKit=".$valor['idKitMaterial']."&id=" . $AM[0]['idAcompanhamentoMaterial'] ."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','#planodecurso')\" ";   
					   
				   }
                }else{
					if ($mobile != 1) {
                    $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?idKitMaterial=".$valor['idMaterialDidatico']."&idKit=".$valor['idKitMaterial']."&idFolhaFrequencia=".$idFolhaFrequencia."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\"";
					} else {
					$onclick = "onclick=\"zerarPlano();carregarModulo('".$abrir."?idKitMaterial=".$valor['idMaterialDidatico']."&idKit=".$valor['idKitMaterial']."&idFolhaFrequencia=".$idFolhaFrequencia."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."', '#planodecurso')\" ";	
					}
                }
                
				if ($semTr != 1) {
                $html .= "<tr>";
				}
                $html .= "
				<td id=\"AcompMat\" $onclick >" . $valor['nome'] . "</td>";
				if ($semInicial == 0) {                
                $html .= "<td $onclick>" . $valor['unidadeInicial'] . "</td>";                
				}
                $html .= "<td $onclick>" . $valor['unidadeFinal'] . "</td>                
                <td $onclick>" . (($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente"). "</td>                
                <td $onclick>" . $AM[0]['obs'] . "</td>";               
				if ($semTr != 1) {
                $html .= "</tr>";
				}
				
            }
        }
		
		if ($relatorio != 1) {
		
        return $html; 
		
		} else {
			
		return	(($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente");
		}
        
  }
  
  

}