<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$ClientePf = new ClientePf();
$Gerente = new Gerente();
$Professor = new Professor();

$mes = date('m');
$ano = date('Y');
?>
<!-- <input type="hidden" name="status" id="status" value="0" onchange="buscar();" checked="checked">
   <input type="hidden" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >-->
    
<fieldset>
  <legend>Relatório de frequência</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" name="FME" id="FME" value="" >
       <p><strong>Tipo de relatório</strong></p>
      <div class="linha-inteira">
        <p>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_porAula" value="porAula" />
            Frequência por aula</label>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_mensal" value="mensal" checked="checked" />
            Frequência mensal </label>
        </p>
         <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
        <p>
       <?php $sql = " SELECT DISTINCT(G.idGrupo), G.nome AS grupo, PAG.idPlanoAcaoGrupo FROM professor AS P 
				INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND 
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
				INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
				WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $_SESSION['idProfessor_SS'];
				
				$rsGrupos = Uteis::executarQuery($sql);

				$idsGrupos = array();
				
				for ($x=0;$x<count($rsGrupos);$x++) {
			
			$idGrupos .= $rsGrupos[$x]['idGrupo'].",";
				 
			 }
			 $idGrupos .= '-1';
			 
				?>
				 <p>
            <label>Grupos:</label>
                   <?php 
			 echo $Grupo->selectGrupoSelectMult("",""," WHERE G.idGrupo in (".$idGrupos.") ");
			 ?>    
            </p>
 
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="fecharMenu(0);postForm_relatorio('img_form_Grupos', 'tipoRel', 'form_rel_pf', '<?php echo "modulos/frequencia/frequenciaProf.php"?>', 'res_rel')">Gerar relatório</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script>

// ativarForm();</script> 