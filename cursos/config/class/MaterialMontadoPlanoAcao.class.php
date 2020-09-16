<?php
class MaterialMontadoPlanoAcao extends Database {
	// class attributes
	var $idMaterialMontadoPlanoAcao;
	var $planoAcaoIdPlanoAcao;
	var $nome;
	var $preco;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMaterialMontadoPlanoAcao = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> nome = "NULL";
		$this -> preco = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMaterialMontadoPlanoAcao($value) {
		$this -> idMaterialMontadoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPreco($value) {
		$this -> preco = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addMaterialMontadoPlanoAcao() Function
	 */
	function addMaterialMontadoPlanoAcao() {
		$sql = "INSERT INTO materialMontadoPlanoAcao (planoAcao_idPlanoAcao, nome, preco, obs) VALUES ($this->planoAcaoIdPlanoAcao, $this->nome, $this->preco, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteMaterialMontadoPlanoAcao() Function
	 */
	function deleteMaterialMontadoPlanoAcao() {
		$sql = "DELETE FROM materialMontadoPlanoAcao WHERE idMaterialMontadoPlanoAcao = $this->idMaterialMontadoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMaterialMontadoPlanoAcao() Function
	 */
	function updateFieldMaterialMontadoPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE materialMontadoPlanoAcao SET " . $field . " = " . $value . " WHERE idMaterialMontadoPlanoAcao = $this->idMaterialMontadoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMaterialMontadoPlanoAcao() Function
	 */
	function updateMaterialMontadoPlanoAcao() {
		$sql = "UPDATE materialMontadoPlanoAcao SET planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, nome = $this->nome, preco = $this->preco, obs = $this->obs WHERE idMaterialMontadoPlanoAcao = $this->idMaterialMontadoPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMaterialMontadoPlanoAcao() Function
	 */
	function selectMaterialMontadoPlanoAcao($where = "") {
		$sql = "SELECT SQL_CACHE idMaterialMontadoPlanoAcao, planoAcao_idPlanoAcao, nome, preco, obs FROM materialMontadoPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

	function selectMaterialMontadoPlanoAcaoTr($where = "",$apenasVer) {

		$sql = "SELECT SQL_CACHE idMaterialMontadoPlanoAcao, planoAcao_idPlanoAcao, nome, preco, obs FROM materialMontadoPlanoAcao " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				if ($apenasVer != 1) {
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/include/form/materialMontadoPlanoAcao.php?id=" . $valor['idMaterialMontadoPlanoAcao'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/materialMontadoPlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_materialMontadoPlanoAcao')\" >" . ($valor['nome']) . "</td>";
				} else {
				$html .= "<td>" . ($valor['nome']) . " </td>";
				}
				$html .= "<td  >R$ " . Uteis::formatarMoeda($valor['preco']) . "</td>";
				$html .= "<td  >" . $valor['obs'] . "</td>";
				if ($apenasVer != 1) {
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/materialMontadoPlanoAcao.php', " . $valor['idMaterialMontadoPlanoAcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/materialMontadoPlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_materialMontadoPlanoAcao')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
				$html .= "<td></td>";
				}
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectMaterialMontadoPlanoAcao_itens($where = "") {

		$sql = " SELECT idPlanoAcaoGrupoMaterialMontado, PAMM.nome, PAMM.preco 
		FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoMaterialMontado AS PAMM ON PAMM.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo " .$where;
        return Uteis::executarQuery($sql);

        }
		
   function AcompanhamentoMaterialMontado($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,$relatorio,$semTr,$mobile, $semInicial){
	   
	    $PlanoAcaoGrupo = new PlanoAcaoGrupo();
        $PlanoAcao = new PlanoAcao();
        $pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoacaoGrupo = ".$idPlanoAcaoGrupo);
        $pa = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao = ".$pag[0]['planoAcao_idPlanoAcao']);
        $idIdioma = $PlanoAcao->getIdIdioma($pag[0]['planoAcao_idPlanoAcao']);
        $idNivel = $pa[0]['nivelEstudo_IdNivelEstudo'];
        $idFoco = $pa[0]['focoCurso_idFocoCurso'];
        $sql = "SELECT SQL_CACHE idMaterialMontadoPlanoAcao, planoAcao_idPlanoAcao, nome, preco, obs FROM materialMontadoPlanoAcao WHERE planoAcao_idPlanoAcao = ".$pag[0]['planoAcao_idPlanoAcao'];
		
		 if ($semTr == 1) {
		$sql .= " LIMIT 1";  
			}
		
        // echo $sql;
        $result = $this -> query($sql);
        if (mysqli_num_rows($result) > 0) {

        $html = "";

        while ($valor = mysqli_fetch_array($result)) {
			
//			Uteis::pr($valor);
		//	echo $mobile;
        $Material = new AcompanhamentoMaterial();
        $AM = $Material->selectAcompanhamentoMaterial("WHERE folhaFrequencia_idFolhaFrequencia =".$idFolhaFrequencia);
		// AND kitMaterial_idKitMaterial =".$valor['idKitMaterial']);
		
//		Uteis::pr($AM);
        if ($AM[0]['idAcompanhamentoMaterial']) {
			if ($mobile != 1) {
        $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?id=" . $AM[0]['idAcompanhamentoMaterial'] ."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
			} else {
		$onclick = "onclick=\"zerarPlano();carregarModulo('".$abrir."?id=" . $AM[0]['idAcompanhamentoMaterial'] ."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."', '#div_ff_geral');\" ";
				
			}
        }else{
			if ($mobile != 1) {
        $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?idMontado=".$valor['idMaterialMontadoPlanoAcao']."&idFolhaFrequencia=".$idFolhaFrequencia."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\"";
			} else {
				
		$onclick = "onclick=\"zerarPlano();carregarModulo('".$abrir."?idMontado=".$valor['idMaterialMontadoPlanoAcao']."&idFolhaFrequencia=".$idFolhaFrequencia."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."', '#div_ff_geral')\" ";
			}
        }
		
		if($semTr != 1)
        $html .= "<tr>";
        
		$html .="<td id=\"AcompMat\" $onclick >" . $valor['nome'] . "</td>";
		if ($semInicial ==0) {
        $html .= "<td $onclick> Especial </td>";
		}
		$html .= "<td $onclick> Especial </td>
        <td $onclick>" . (($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente"). "</td>
        <td $onclick>" . $AM[0]['obs'] . "</td>";
		
		if($semTr != 1)
        $html .= "</tr>";
        }
        }
		
		if ($relatorio != 1) {
		
        return $html;
		
		} else {
			return	(($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente");
		}

        }

function selectMaterialMontadoDescricao($where, $padrao = true) {

$sql =
"SELECT SQL_CACHE idMaterialMontadoPlanoAcao, planoAcao_idPlanoAcao, nome, preco, obs FROM materialMontadoPlanoAcao " . $where;

//echo $sql;
$result = $this -> query($sql);
$html = "";
if (mysqli_num_rows($result) > 0) {
$html = "<pre>";
        while ($valor = mysqli_fetch_array($result)) {      
          $html .= $valor['nome']."\n";
        }
        $html .= "</pre>";
    }
    return $html;
  }
}
?>