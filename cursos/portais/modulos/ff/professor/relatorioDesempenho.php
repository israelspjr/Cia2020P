<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$RelatorioDesempenho = new RelatorioDesempenho();
$mes = new DateTime($dataReferencia);

if($rsIntegranteGrupo){?>

  <fieldset>
    <legend>Relatório Desempenho</legend>
    <p>Período: <strong><?php echo Uteis::exibirData($dataReferencia)?></strong></p>
    <?php foreach($rsIntegranteGrupo as $aluno){
      
			$idIntegranteGrupo = $aluno['idIntegranteGrupo'];
      $nomeAluno = $IntegranteGrupo->getNomePF($idIntegranteGrupo);
      ?>
      
      <div class="linha-inteira"> 
      
        <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR/FECHAR RELATÓRIO" id="img_<?php echo $idIntegranteGrupo?>" 
        onclick="abrirFormulario('div_relatorioDesempenho_<?php echo $idIntegranteGrupo?>', 'img_<?php echo $idIntegranteGrupo?>');" /> 
        <strong><?php echo $nomeAluno?></strong>
      
        <div class="agrupa" id="div_relatorioDesempenho_<?php echo $idIntegranteGrupo?>">
          <div id="div_lista_relatorioDesempenho_<?php echo $idIntegranteGrupo?>" class="tab2" > 
            <?php 
            echo $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes->format('m'), "","",$idFolhaFrequencia);
            ?>
					</div>
        </div>
      </div>
      
    <?php }?>
    
    <button class="bBlue" onclick="gravarNotas();zerarNotas();">Gravar notas</button>&nbsp;&nbsp;
    <button class="button gray" onclick="zerarNotas()">Fechar</button>	
    
  </fieldset>

<?php }?>

<script>
//ativarForm();

function gravarNotas(){
	
	var gravado = false, nota, notaNova, idForm;	
	
	$.each(idForms_base, function(index) {       
	 
	  idForm = idForms_base[index][0];
	  console.log(idForm);      
	  nota = idForms_base[index][1];
	  obs = idForms_base[index][2];
	  notaNova = $('#' + idForm).find('select:first').val(); 
	  obsNovo = $('#' + idForm).find('textarea:first').val();      
	  	   
	  //VERIFICA SE CAMPO NAO ESTA EM BRANCO E DIFERENTE DO VALOR INICIAL
	  if( (notaNova != nota) || (obsNovo != obs)){			
			gravado = true;
			postForm(idForm, '<?php echo "modulos/ff/professor/gravaRelatorioDesempenhoAcao.php?idFolhaFrequencia=".$idFolhaFrequencia.""?>');				
	  }		
		  
	});
	
	if( !gravado ) alert('Nenhuma nota ou comentário foi alterada..');	
	idForms_base = carregarValorFormsInicial();
}

function carregarValorFormsInicial(){	
	var idForms = new Array()
	$('form.rel').each(function(i) { 		
		idForms[i] = new Array();		
		idForms[i][0] = $(this).attr('id'); 
		idForms[i][1] = $(this).find('select').val();
		idForms[i][2] = $(this).find('textarea').val();
  });	
	return idForms;
}

var idForms_base = carregarValorFormsInicial();

</script>