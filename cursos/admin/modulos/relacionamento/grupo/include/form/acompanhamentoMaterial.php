<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoMaterial.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoCurso.class.php");
$AcompanhamentoMaterial = new AcompanhamentoMaterial();
$idKit = $_REQUEST['idKit'];
$idMontado = $_REQUEST['idMontado'];
$idPlan = $_REQUEST['idPlan'];
$idIdioma= $_REQUEST['idIdioma'];
$idNivel = $_REQUEST['idNivel'];
$idFoco = $_REQUEST['idFoco'];
$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$idAcompanhamentoMaterial = $_REQUEST['id'];
$idKitMaterial = $_REQUEST['idKitMaterial'];

if($idAcompanhamentoMaterial!=''){	
	$valor = $AcompanhamentoMaterial->selectAcompanhamentoMaterial(" WHERE idAcompanhamentoMaterial = ".$idAcompanhamentoMaterial);	
	$idAcompanhamentoMaterial = $valor[0]['idAcompanhamentoMaterial'];
    $idFolhaFrequencia = $valor[0]['folhaFrequencia_idFolhaFrequencia'];
    $idKit = $valor[0]['kitMaterial_idKitMaterial']; 
    $idMontado = $valor[0]['materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao']; 
    $idPlan = $valor[0]['materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao'];  
    $unidade = $valor[0]['unidade'];
    $dataCadastro = $valor[0]['dataCadastro'];
    $obs = $valor[0]['obs'];
    
 // Uteis::pr($valor);
}


if($idKit!=""):
$material = new KitMaterial();
/*
$where = "INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma.
      " AND INF.nivelEstudo_IdNivelEstudo = ".$idNivel.
      " AND INF.focoCurso_idFocoCurso = ".$idFoco.
      " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF AND kitMaterial_idKitMaterial = K.idKitMaterial 
      INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF
      INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMAterialDidatico WHERE K.inativo = 0 
      AND MDINF.unidadeInicial is not null AND MDINF.unidadeFinal is not null AND K.idKitMaterial =".$idKit;

$sql = "SELECT SQL_CACHE K.idKitMaterial, K.nome AS Ordem, K.inativo, MD.nome, MDINF.idMaterialDidaticoINF, MDINF.unidadeInicial, MDINF.unidadeFinal FROM kitMaterial AS K 
      INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma.
      " AND INF.nivelEstudo_IdNivelEstudo = ".$idNivel.
      " AND INF.focoCurso_idFocoCurso = ".$idFoco.
      " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF AND kitMaterial_idKitMaterial = K.idKitMaterial 
      INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF
      INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMAterialDidatico WHERE K.inativo = 0 
      AND MDINF.unidadeInicial is not null AND MDINF.unidadeFinal is not null AND K.idKitMaterial =".$idKit." limit 1";*/
	     $sql = "SELECT SQL_CACHE Distinct (MD.nome), K.idKitMaterial, MD.idMaterialDidatico, K.nome AS Ordem, K.inativo, MDINF.unidadeInicial, MDINF.unidadeFinal FROM kitMaterial AS K " ;
	  $sql .= " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma;
  $sql .= " AND INF.nivelEstudo_IdNivelEstudo = ".$idNivel." AND INF.focoCurso_idFocoCurso = ".$idFoco;
  $sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";  
  $sql .= " AND KMINF.kitMaterial_idKitMaterial = K.idKitMaterial";
  $sql .= " INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = KMINF.kitMaterial_idKitMaterial AND KMD.excluido = 0";
  $sql .= " INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";
  $sql .= " AND MDINF.materialDidatico_idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico";
  $sql .= " INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico";
$sql .= "  AND MDINF.unidadeInicial is not null AND MDINF.unidadeFinal is not null";
  $sql .= " WHERE K.idKitMaterial = " .$idKit." AND MD.idMaterialDidatico = ".$idKitMaterial;
  
	$where = $sql;  
$rs = Uteis::executarQuery($sql);
elseif($idMontado!=""):

$material = new MaterialMontadoPlanoAcao();
$folha = new FolhaFrequencia();
$ff = $folha->selectFolhaFrequencia("WHERE idFolhaFrequencia =".$idFolhaFrequencia);
$planoAcaoGrupo = new PlanoAcaoGrupo();
$idPlanoAcao = $planoAcaoGrupo->getIdPlanoAcao($ff[0]['planoAcaoGrupo_idPlanoAcaoGrupo']); 

elseif($idPlan!=""):

$material = new MaterialDidaticPlanoAcao();
$folha = new FolhaFrequencia();
$ff = $folha->selectFolhaFrequencia("WHERE idFolhaFrequencia =".$idFolhaFrequencia);
$planoAcaoGrupo = new PlanoAcaoGrupo();
$idPlanoAcao = $planoAcaoGrupo->getIdPlanoAcao($ff[0]['planoAcaoGrupo_idPlanoAcaoGrupo']); 

endif;
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Acompanhamento Material </legend>
    <form id="form_AcompanhamentoMaterial" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idAcompanhamentoMaterial" type="hidden" value="<?php echo $idAcompanhamentoMaterial;?>" />
      <input name="idFolhaFrequencia" type="hidden" value="<?php echo $idFolhaFrequencia;?>" />
      <p>
        <?php if($idKit!=""):?>  
        <label>Material: <b></strong><?php echo $rs[0]['nome'];?></b></label>
		<?php //echo $material->selectKitMaterialDescricao($where,false);?></b></label>
        <input type="hidden" name="idKit" id="idKit" value="<?php echo $idKit?>" /></p>
        <?php elseif($idMontado!=""):?> 
        <label>Material: <b></strong><?php echo $material->selectMaterialMontadoDescricao(" WHERE planoAcao_idPlanoAcao =".$idPlanoAcao);?></b></label>
        <input type="hidden" name="idMontado" id="idMontado" value="<?php echo $idMontado?>" /></p>
        <?php elseif($idPlan!=""):?>  
        <label>Material: <b></strong><?php echo $material->selectMaterialDescricao(" WHERE planoAcao_idPlanoAcao =".$idPlanoAcao);?></b></label>
        <input type="hidden" name="idPlan" id="idPlan" value="<?php echo $idPlan?>" /></p>    
        <?php endif;?>            
      <p>
        <?php if($idKit!=""):?>  
        <label>Unidade:</label>
        <select name="unidade" id="unidade">
            <option>Selecione a unidade</option>
            <?php for($i=$rs[0]['unidadeInicial'];$i<=$rs[0]['unidadeFinal'];$i++): ?>
            <option value="<?=$i;?>" <?php if($unidade == $i){echo "SELECTED";}?> >Unidade <?=$i;?></option>
            <?php endfor;?>    
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
        <?php else:?> 
        <label>Unidade:</label>
        <label>Obs:Neste campo digite a ultima pagina estudada ou unidade não esqueça de comentar sobre o material, neste campo coloque apenas o número</label>
        <input type="text" name="unidade" id="unidade" value="<?php echo ($idMontado!="")? $unidade:$unidade;?>">           
        <?php endif;?>           
      <p>
        <label>Comentários:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs;?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      
        <button class="button blue" onclick="postForm('form_AcompanhamentoMaterial', '<?php echo CAMINHO_REL?>grupo/include/acao/acompanhamentoMaterial.php');">Salvar</button>
    
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
