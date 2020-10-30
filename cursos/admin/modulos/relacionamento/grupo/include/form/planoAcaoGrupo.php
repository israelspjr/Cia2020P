<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$NivelEstudo = new NivelEstudo();
$Idioma = new Idioma();
$Gerente = new Gerente();
$GrupoClientePj = new GrupoClientePj();
$Grupo = new Grupo();
$PlanoAcaoGrupoNaoFaturar = new PlanoAcaoGrupoNaoFaturar();
$ClientePj = new ClientePj();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();
$CalendarioProva = new CalendarioProva();
$Prova = new Prova();
$TipoCurso = new TipoCurso();
	
$idPlanoAcaoGrupo = $_GET['id'];

$valorNivelEstudo = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo, true);

$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	$idGrupo = $valorPlanoAcaoGrupo[0]['grupo_idGrupo'];		
	$idPlanoAcao = $valorPlanoAcaoGrupo[0]['planoAcao_idPlanoAcao'];		
//	$idNivelEstudo = $valorPlanoAcaoGrupo[0]['nivelEstudo_IdNivelEstudo'];
	
//	echo $idNivelEstudo;
	$categoria = explode(",",$valorPlanoAcaoGrupo[0]['categoria']);
	
	if ($categoria[0] == 0 or $categoria[0] == "") {
	$cat = 0;
	} else {
	$cat = count($categoria);	
	}
	

// Calendário de prova
 $valorProvas = $CalendarioProva->selectCalendarioProva("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
 
 if ($valorProvas != '') {
 
  foreach ($valorProvas as $valor2) {
			  
			$dataAplicacao =  $valor2['dataAplicacao'];
			
			$dataPrevistaNova = $valor2['dataPrevistaNova'];
			
			$dataPrevistaInicia = $valor2['dataPrevistaInicial'];
			
			$valorProva = $Prova->selectProva("WHERE idProva = ".$valor2['prova_idProva']);
    		$nomeProva = $valorProva[0]['nome'];
			
		//	$html2 .= "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Prova\" ".$cor." onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/provas.php?id=" . $valor2['idCalendarioProva'] . "', '', '')\">";
			
			$html2 .= "Prova: ".$nomeProva." ";
			
			if ($dataAplicacao > 0) {
				
				$html2 .= "Prova aplicada em ".Uteis::exibirData($dataAplicacao)." ";
				
			} elseif ($dataPrevistaNova >0) {
				
				$html2 .= "Nova data prevista:  ".Uteis::exibirData($dataPrevistaNova)." ";
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)." ";
				
			} else {
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)." ";
			}
			
			
			
			
		  }
 } else {
	 $html2 .= "<strong><span style=\"color:red\" >ATENÇÃO!!! não existem avaliações cadastradas para este estágio</span></strong>";
 }


$valorPlano = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$idPlanoAcao);
//$NivelAtual = $idNivelEstudo; //$valorPlano[0]['nivelEstudo_IdNivelEstudo'];
$TipoContrato = $valorPlano[0]['tipoContrato'];
$tipoCursoD = $valorPlano[0]['tipoCurso'];
$tipoAval = $valorPlano[0]['tipoAval'];

if ($TipoContrato == 2) {
	 $tipoContrato = "Prazo determinado (Verificar contrato)";
} elseif($TipoContrato == 1) {
	$tipoContrato = "Pacote de Horas";
} else {
   $tipoContrato = "Prazo indeterminado";
}

	if ($tipoCursoD == '') {
		$nomeCurso = "Presencial";
	} else {
		$Ncurso = $TipoCurso->selectTipoCurso(" WHERE idTipoCurso in (".$tipoCursoD.")");
		$nomeCurso = "";
			foreach ($Ncurso as $v) {
					$nomeCurso .= $v['nome']."<br>";
			}
		}
/*if ($tipoCurso == 0 || $tipoCurso == '') {
	$nomeCurso = "Presencial";
} elseif ($tipoCurso == 1) {
	$nomeCurso = "On-line";
} elseif ($tipoCurso == 2) {
	$nomeCurso = "Skype";	
} elseif ($tipoCurso == 3) {
	$nomeCurso = "ChatClub";	
} elseif ($tipoCurso == 4) {
	$nomeCurso = "Na Tela";	
} elseif($tipoCurso == 5) {
	$nomeCurso = "Presencial Premium";
}  elseif($tipoCurso == 6) {
	$nomeCurso = "Na Tela Premium";
}  elseif($tipoCurso == 7) {
	$nomeCurso = "Na Tela Trilhas";
}*/


if ($tipoAval == 0) {
	$textoAval = $html2;	
} else {
	$textoAval = "Não tem avaliação no programa";	
}
	
    $dataInicioEstagio = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataInicioEstagio']);
	$dataPrevisaoTerminoEstagio = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataPrevisaoTerminoEstagio']);
    

//$valorGrupo = $Grupo->selectGrupo(" WHERE idGrupo = ".$idGrupo);
//$nomeGrupo = $valorGrupo[0]['nome'];

//$valorNivelEstudo = $NivelEstudo->selectNivelEstudo(" WHERE IdNivelEstudo = ".$idNivelEstudo);
//$valorNivelEstudo = $valorNivelEstudo[0]['nivel'];

$idIdioma = $PlanoAcao->getIdIdioma($idPlanoAcao);

$nomeidioma = $Idioma->selectIdioma(" WHERE idIdioma = ".$idIdioma);
$nomeidioma = $nomeidioma[0]['idioma'];

$nomePJ = $GrupoClientePj->getNomePJ($idGrupo);
//$idFuncionario = $GerenteTem->selectGerenteTem_porGrupo($idPlanoAcaoGrupo);
//$nomeGerente = $Funcionario->getNome($idFuncionario);

//$idGerente = $Gerente->getIdGerentePorGrupo($idGrupo);
//$nomeGerente = $Gerente->getNomeGerente($idGerente);

$valorClientePj = $GrupoClientePj->selectGrupoClientePj(" WHERE grupo_idGrupo =".$idGrupo);
$idClientePj = $valorClientePj[0]['clientePj_idClientePj'];
$idGerente = $GerenteTem->selectGerenteTem(" WHERE clientePj_idClientePj = ".$idClientePj." AND (dataExclusao is null or dataExclusao >= CURDATE())");
$nomeGerente = $Gerente->getNomeGerente($idGerente[0]['gerente_idGerente']);
//Uteis::pr( $idGerente); 

$valorFreq = $ClientePj->selectClientePj(" WHERE idClientePj =".$idClientePj);
$freqMin = $valorFreq[0]['frequenciaMinimaExigida'];


$where = " AND dataInicio <= CURDATE() AND ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";
$where2 = " AND dataInicio <= CURDATE() AND  ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";
$where3 = " AND dataInicio <= CURDATE() AND  ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";

$pa = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao=".$idPlanoAcao);
$material = "";
$teste =0;
if($pa[0]['kitMaterial_idKitMaterial']!="") {$KitMaterial = new KitMaterial(); }

 //INFS RECURsOS
   //         $html .= "<p class=\"titulo\" >Informações dos materiais</p>";
            $temMaerial = false;
            $MaterialDidatico = new MaterialDidatico();
            $sql = "SELECT SQL_CACHE DISTINCT
    (MD.idMaterialDidatico),
    MD.editoraMaterialDidatico_idEditoraMaterialDidatico,
    MD.materialDidaticoTipo_idMaterialDidaticoTipo,
    MD.idioma_idIdioma,
    MD.isbn,
    MD.valor,
    MD.opcional,
    MD.dataCadastro,
    MD.obs,
    MD.inativo,
    MD.nome,
    MD.excluido
FROM
    materialDidatico AS MD
        INNER JOIN
    materialDidaticoINF AS MDINF ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico
        INNER JOIN
    relacionamentoINF AS R ON R.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF
  /*      INNER JOIN
    kitMaterialDidatico AS K2 ON idMaterialDidatico = K2.materialDidatico_idMaterialDidatico*/
        INNER JOIN
    planoAcao AS PA /*ON PA.kitMaterial_idKitMaterial = K2.kitMaterial_idKitMaterial*/
		ON PA.focoCurso_idFocoCurso = R.focoCurso_idFocoCurso
        AND PA.nivelEstudo_idNivelEstudo = R.nivelEstudo_idNivelEstudo
        INNER JOIN
    proposta AS P ON P.idProposta = PA.proposta_idProposta
        AND P.idioma_idIdioma = R.idioma_idIdioma
                    WHERE MD.excluido = 0 AND MD.inativo = 0 AND PA.idPlanoAcao =$idPlanoAcao";
					
	//				echo $sql;
			
            $rsMaterial = Uteis::executarQuery($sql);
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor) {
                    $html .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico']) . "</p>";
                }

            }

            //MATERIAL AVULSO
            $rsMaterial = $MaterialDidatico -> selectMaterialDidatico(" WHERE idMaterialDidatico IN (
                SELECT materialDidatico_idMaterialDidatico FROM materialDidaticPlanoAcao AS M2 WHERE M2.planoAcao_idPlanoAcao = $idPlanoAcao
            )");
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor)
                    $html .= "<p>" . $MaterialDidatico -> montaMaterial($valor['idMaterialDidatico'],false) . "</p>";
            }

            //MATERIAL MONTADO/PERSONALIZADO/APOSTILAS
            $MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();
            $rsMaterial = $MaterialMontadoPlanoAcao -> selectMaterialMontadoPlanoAcao(" WHERE planoAcao_idPlanoAcao = $idPlanoAcao");
            if ($rsMaterial) {
                $temMaerial = true;
                foreach ($rsMaterial as $valor)
                    $html .= "<p>" . $valor['nome'] . " - R$ " . Uteis::formatarMoeda($valor['preco']) . "</p>";
                    $html .= "<p>" . $valor['obs'] . "</p>";
            }

            if (!$temMaerial)
                $html .= "<p>Não foi solicitado material.</p>";
				
				
				 $where2 = " WHERE PA.dataExcluido IS NULL AND PA.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
//				 echo $where2;
                $rsPlanoAcaoGrupoNaoFaturar = $PlanoAcaoGrupoNaoFaturar -> selectPlanoAcaoGrupoStatus($where2);
                if ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 1) {
					$grupoStatus .= "<strong>Status Financeiro: <font color=\"#FF0000\" size=\"3\">não faturar apartir de " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['data']) . " Grupo em fechamento falar com o coordenador</strong></font>";
				} elseif ($rsPlanoAcaoGrupoNaoFaturar[0]['tipo'] == 2) {
	$grupoStatus .= "<strong>Status Financeiro: <font color=\"#008000\" size=\"3\">Grupo revertido em " . Uteis::exibirData($rsPlanoAcaoGrupoNaoFaturar[0]['data']) . " </strong></font>";					
					
				}


?>

<fieldset>
  <img src="<?php echo CAMINHO_IMG."cad.png"?>" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/grupo.php?id=$idPlanoAcaoGrupo"?>', '<?php echo CAMINHO_REL."grupo/include/form/planoAcaoGrupo.php?id=$idPlanoAcaoGrupo"?>', '#div_cadastro_Grupo')"/>
  <legend>Dados gerais</legend>
  <div class="esquerda">
<!--    <p><strong>Idioma: </strong><?php echo $nomeidioma?></p>-->
    <p><strong>Idioma: </strong><?php echo $nomeidioma?></p>
    <p><strong>Nivel atual: </strong><?php echo $valorNivelEstudo?></p>
    <p><strong>Cliente Pessoa Jurídica: </strong><?php echo $nomePJ?></p>
    <p><strong>Tipo de contrato: </strong><?php echo $tipoContrato?></p>
    <p><strong>Tipo de curso: </strong><?php echo $nomeCurso?></p>
    <p><strong>Avaliação do programa: </strong><?php echo $textoAval?></p>
    <?php  if ($freqMin > 0) { ?>
    <p><strong>Frequência mínima exigida: </strong><?php echo $freqMin."%" ?> </p>
    <?php } ?>
    <p><strong>Coordenador Pedagógico: </strong><?php echo $nomeGerente?></p>
    <p><strong>Inicio do nível: </strong><?php echo $dataInicioEstagio?> - <strong>Término do nível: </strong><?php echo $dataPrevisaoTerminoEstagio ? $dataPrevisaoTerminoEstagio : "não previsto"?></p>
    <p><?php echo $grupoStatus?></p>
      
  </div>
  <div class="direita">    
    <p><strong> Informações dos materiais: </strong><?php echo $html; ?></p>    
    <p><strong ><img src="<?php echo CAMINHO_IMG."pa.png"?>" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/cadastro.php?id=$idPlanoAcao"?>', '<?php echo CAMINHO_REL."grupo/include/form/planoAcaoGrupo.php?id=$idPlanoAcaoGrupo"?>', '#div_cadastro_Grupo')" />Plano de ação</strong> <?php if ($pa[0]['statusAprovacao_idStatusAprovacao'] == 2) { ?> <button id="liberarPA" class="button blue" onclick="editarPA(<?php echo $pa[0]['idPlanoAcao']?>)">Editar PA </button> <?php } ?></p><div id="msg"></div>
  <!--  <p><strong>Categoria: </strong><img src="<?php echo CAMINHO_IMG.$cat."estrela.gif"?>"></p>-->
  </div> 
</fieldset>

<script>
function editarPA(x) {

$.ajax({
    url: "<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupo.php"?>",
    type: "POST",
    data: "idPlanoAcao="+x+"&acao=liberarPA",
    dataType: "html"

}).done(function(resposta) {
    console.log(resposta);
	$('#msg').html(resposta);
	$('#liberarPA').hide();
});
	
	
}
</script>