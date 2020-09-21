<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$NivelEstudo = new NivelEstudo();
$Idioma = new Idioma();
$Gerente = new Gerente();
$GrupoClientePj = new GrupoClientePj();
$Grupo = new Grupo();
$PlanoAcao = new PlanoAcao();
$ClientePj = new ClientePj();
	
$idPlanoAcaoGrupo = $_GET['id'];

$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	$idGrupo = $valorPlanoAcaoGrupo[0]['grupo_idGrupo'];		
	$idPlanoAcao = $valorPlanoAcaoGrupo[0]['planoAcao_idPlanoAcao'];		
	$idNivelEstudo = $valorPlanoAcaoGrupo[0]['nivelEstudo_IdNivelEstudo'];
	$categoria = $valorPlanoAcaoGrupo[0]['categoria'];
	$dataInicioEstagio = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataInicioEstagio']);
	$dataPrevisaoTerminoEstagio = Uteis::exibirData($valorPlanoAcaoGrupo[0]['dataPrevisaoTerminoEstagio']);

$valorGrupo = $Grupo->selectGrupo(" WHERE idGrupo = ".$idGrupo);
$nomeGrupo = $valorGrupo[0]['nome'];

$valorNivelEstudo = $NivelEstudo->selectNivelEstudo(" WHERE IdNivelEstudo = ".$idNivelEstudo);
$valorNivelEstudo = $valorNivelEstudo[0]['nivel'];

$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
$nomeidioma = $Idioma->selectIdioma(" WHERE idIdioma = ".$idIdioma);
$nomeidioma = $nomeidioma[0]['idioma'];

$nomePJ = $GrupoClientePj->getNomePJ($idGrupo);
$idGerente = $Gerente->getIdGerentePorGrupo($idGrupo);
$nomeGerente = $Gerente->getNomeGerente($idGerente);

//$material = $PlanoAcaoGrupo->listaMaterial($idPlanoAcaoGrupo);

$valorPlano = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao = ".$idPlanoAcao);
$NivelAtual = $idNivelEstudo; //$valorPlano[0]['nivelEstudo_IdNivelEstudo'];
$TipoContrato = $valorPlano[0]['tipoContrato'];

if ($TipoContrato == 2) {
	 $tipoContrato = "Prazo determinado (Verificar contrato)";
} elseif($TipoContrato == 1) {
	$tipoContrato = "Pacote de Horas";
} else {
   $tipoContrato = "Prazo indeterminado";
}

$valorFreq = $ClientePj->selectClientePj(" WHERE idClientePj =".$_SESSION['idClientePj_SS']);
$freqMin = $valorFreq[0]['frequenciaMinimaExigida'];

$where = " AND dataInicio <= CURDATE() AND ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";
$where2 = " AND dataInicio <= CURDATE() AND  ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";
$where3 = " AND dataInicio <= CURDATE() AND  ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";
$planoAcao = new PlanoAcao();
$pa = $planoAcao->selectPlanoAcao("WHERE idPlanoAcao=".$idPlanoAcao);
$material = "";
$teste =0;
if($pa[0]['kitMaterial_idKitMaterial']!="") {$KitMaterial = new KitMaterial(); }

 //INFS RECURsOS
   //         $html .= "<p class=\"titulo\" >Informações dos materiais</p>";
            $temMaerial = false;
            $MaterialDidatico = new MaterialDidatico();
            $sql = "SELECT SQL_CACHE 
                    distinct(MD.idMaterialDidatico), MD.editoraMaterialDidatico_idEditoraMaterialDidatico, 
                    MD.materialDidaticoTipo_idMaterialDidaticoTipo, 
                    MD.idioma_idIdioma, MD.isbn, MD.valor, MD.opcional, 
                    MD.dataCadastro, MD.obs, MD.inativo, MD.nome, MD.excluido 
                    FROM materialDidatico AS MD
                    INNER JOIN
                    materialDidaticoINF AS MDINF ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico
                    INNER JOIN
                    relacionamentoINF AS R ON R.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF
                    INNER JOIN
                    kitMaterialDidatico AS K2 ON idMaterialDidatico = K2.materialDidatico_idMaterialDidatico
                    INNER JOIN
                    planoAcao AS PA ON PA.kitMaterial_idKitMaterial = K2.kitMaterial_idKitMaterial
                    AND PA.focoCurso_idFocoCurso = R.focoCurso_idFocoCurso
                    AND PA.nivelEstudo_idNivelEstudo = R.nivelEstudo_idNivelEstudo
                    INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta AND P.idioma_idIdioma = R.idioma_idIdioma
                    WHERE K2.excluido = 0 AND PA.idPlanoAcao =$idPlanoAcao";
					
				//	echo $sql;
			
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

?>
<fieldset>
<legend><strong><?php echo $nomeGrupo?></strong></legend>
<div class="esquerda">
  <p><strong>Idioma: </strong><?php echo $nomeidioma?></p>
  <p><strong>Nivel atual: </strong><?php echo $valorNivelEstudo?></p>
  <p><strong>Cliente Pessoa Jurídica: </strong><?php echo $nomePJ?></p>
   <p><strong>Tipo de contrato: </strong><?php echo $tipoContrato?></p>
    <?php  if ($freqMin > 0) { ?>
    <p><strong>Frequência mínima exigida: </strong><?php echo $freqMin."%" ?> </p>
    <?php } ?>
  <p><strong>Gerente: </strong><?php echo $nomeGerente?></p>
  <p><strong>Inicio do nível: </strong><?php echo $dataInicioEstagio?> - <strong>Término do nível: </strong><?php echo $dataPrevisaoTerminoEstagio ? $dataPrevisaoTerminoEstagio : "não previsto"?></p>
</div>
<div class="direita">
  <p><strong>Material: </strong><?php echo $html; ?></p>
</div>
</fieldset>
