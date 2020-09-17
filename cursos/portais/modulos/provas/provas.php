<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Relatorio = new Relatorio();	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$CalendarioProva = new CalendarioProva();

$idClientePf = $_SESSION['idClientePf_SS'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$dataAtual = date("Y-m-t");
$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($idClientePf, $idPlanoAcaoGrupo, $dataAtual);

$grupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);

$PAG = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);

$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$PAG.") AND provaOn = 1 AND dataAplicacao IS NULL ORDER BY idCalendarioProva DESC";

$valorProva = $CalendarioProva->selectCalendarioProva($where);

?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  -->
  <fieldset>
  <p>Grupo: <strong><?php echo $grupo?></strong></p>
  
    <legend>Avaliações on-line agendadas:</legend>
    
   <?php if ($valorProva[0]['provaOn'] == 1) { 
   $idCalendarioProva = $valorProva[0]['idCalendarioProva']; ?>
       <p><label>Data Prevista de aplicação: <?php 
	   if ($valor[0]['dataPrevistaNova'] == '') { 
	   	  echo Uteis::exibirData($valorProva[0]['dataPrevistaInicial']);
	   } else {
		  echo Uteis::exibirData($valorProva[0]['dataPrevistaNova']); 
	   }
	   ?></label></p>
       <p><label>Professor irá fornecer o código de liberação da prova:</label></p>
      <button class="Bblue" onclick="acessar(<?php echo $idCalendarioProva; ?> )">Acessar Prova</button>
       <div id="resultado"></div>
       
  <?php } else {
	  $idCalendarioProva = 0;
	  
  }?>

    
  </fieldset>  
    
  <fieldset>
    <legend>Avaliações Feitas</legend>
    
    <div class="lista">
			<?php 		
      echo $Relatorio->relatorioProvaAplicadas(" WHERE PAG.idPlanoAcaoGrupo in ($PAG) AND CPF.idClientePf = $idClientePf", "item","","","",1, 1)
	  
      ?>       
    </div>
  </fieldset>
</div>
<button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/provas/index.php', '#centro');">Fechar</button>
<script>
//tabelaDataTable('tb_lista_res', 'simples');

function acessar(id, cod) {
	
	var x = prompt("Por favor qual é o código de liberação da prova? ");	
	
  $.ajax({
    url:"<?php echo "/cursos/portais/modulos/provas/acessaProva.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{id:id, x:x}	
  })
  .done(function(msg){
	  if(msg == 1) {
			 carregarModulo('/cursos/portais/modulos/provas/provasOn.php?idCalendarioProva=<?php echo $idCalendarioProva?>', '#centro'); 
	  } else {
          $("#resultado").html(msg);
	  }
		
  });
}
</script>