<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$Gerente = new Gerente();
$ClientePj = new ClientePj();
$Grupo = new Grupo();

//$nomeCliente = $ClientePj->getNome($_SESSION['idClientePj_SS']);

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "dataReferencia", 1 => "Data da pesquisa");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome Professor");

$rsPsaProfessor = $PsaProfessor->selectPsaProfessor(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsPsaProfessor as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);

$rsPsaRegular = $PsaRegular->selectPsaRegular(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsPsaRegular as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);

?>

<fieldset>
  <legend>Relatório de psa</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    
      <!--<p><strong>Campos</strong></p>-->
      <p><strong>Filtros</strong></p>
      <div class="esquerda">
     <!--   <label>Selecionados:</label>-->
        <img src="<?php echo CAMINHO_IMG."menos.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        
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
	
          	<?php foreach($arrItens_padrao as $iten){?>
          	    <input type="hidden" name="sel_lista_padrao[]" id="sel_lista_padrao" value="<?php echo $iten[0]?>" /> 
          	    <input type="hidden" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" value="<?php echo $iten[1]?>" />  
            
            <?php }?>                 	
       </div>
        <div class="linha-inteira">
          <p>
            <label>Data da pesquisa:</label>
            de
            <input type="date" name="dataReferencia" id="dataReferencia" class="data" value="2020-01-01"/> <!--01/09/2018" />-->
            a
            <input type="date" name="dataReferencia2" id="dataReferencia2" class="data" value=""  />
          </p>
          <p>
          <Label>Mostrar comentários? </Label>
          <input type="checkbox" value="1" id="mostrarComentarios" name="mostrarComentarios" />
          </p>
                   <p>
          <Label>Mostrar PSA Pendentes </Label>
          <input type="checkbox" value="1" id="psaPendentes" name="psaPendentes" />
          </p>
        </div>
        <div class="direita">
 </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="Bblue" onclick="geraRel()">
        Gerar relatório</button>
      </div>
    </form>
  </div>
  
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> 
function geraRel(){
addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo "modulos/novaPsa/psa.php"?>', 'res_rel');
}

//ativarForm();	
</script> 