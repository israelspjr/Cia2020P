<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$ContestacaoFF = new ContestacaoFF();
$ClientePf = new ClientePf();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();
$Relatorio = new Relatorio();
$ClientePj = new ClientePj();
$IntegranteGrupo = new IntegranteGrupo();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();
$NotasTipoNota = new NotasTipoNota();
$Gerente = new Gerente();
$Funcionario = new Funcionario();
$PsaIntegranteGrupo = new PsaIntegranteGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);
$idClientePj = $ClientePj->getIdClientePj_porGrupo($idGrupo);
$rs = $ClientePj->selectClientePj( "WHERE idClientePj = ".$idClientePj);
$rsFreq = $rs[0]['frequenciaMinimaExigida'];

$dataAtual = date("Y-m-d");

$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($_SESSION['idClientePf_SS'], $idPlanoAcaoGrupo, $dataAtual);

$idFuncionario = $IntegranteGrupo->select_gerentePorIdCliente($_SESSION['idClientePf_SS'], "", "", 1);

$email = $Funcionario->getEmail($idFuncionario);
$nome = $Funcionario->getNome($idFuncionario);

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];
$idProfessor = $_REQUEST['idProfessor'];
$nomeProf = $Professor -> getNome($idProfessor);
$where = " WHERE CPF.idClientePf = " . $_SESSION['idClientePf_SS'] . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND FF.idFolhaFrequencia = $idFolhaFrequencia ";

 $result = $Relatorio->relatorioFrequencia_porAula($where, false);
 
// Uteis::pr($result);
 
  foreach($result as $valor){
				
				if ($valor['diaAula'] < 10) {
				$dia = "0".$valor['diaAula'];	
				} else {
				$dia = $valor['diaAula'];		
				}
				
				if ($valor['mes'] < 10) {
				$mes1 = "0".$valor['mes'];	
				} else {
				$mes1 = $valor['mes'];		
				}
				
				$dataAula = $valor['ano']."-".$mes1."-".$dia;
				
				if ($dataAula >= $valor['dataEntrada']) {				
				
				$EmpresaFreq += $valor['horasRealizadasPeloGrupo'];
				$AlunoFreq += $valor['horaRealizadaAluno'];
				
				
				}
				
				
  }

$Freq = $Relatorio->relatorioFrequencia_mensal(" WHERE PJ.idClientePj =".$idClientePj." AND FF.idFolhaFrequencia = ".$idFolhaFrequencia." AND CPF.idClientePf = ".$_SESSION['idClientePf_SS']);

$AlunoJust = $Freq[0]['aulasJustificadas_aluno'];
$nomeAluno = $Freq[0]['aluno'];

if ($AlunoJust > 0) {
	$AlunoFreq = $AlunoFreq + $AlunoJust;
} 


if ($EmpresaFreq > 0 ) {
$AlunoPer = ($AlunoFreq / $EmpresaFreq) * 100;
} else {
$AlunoPer = ($AlunoFreq / 1) * 100;
}

if ($AlunoPer > 100) {
$AlunoPer = 100;	
	
}


$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];

$where = " WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia AND integranteGrupo_idIntegranteGrupo IN (
	SELECT idIntegranteGrupo FROM integranteGrupo 
	WHERE clientePf_idClientePf = " . $_SESSION['idClientePf_SS'] . " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo
)";
$rsContestacaoFF = $ContestacaoFF -> selectContestacaoFF($where);
?>

<form id="form_uploadFile" method="post" enctype="multipart/form-data" action="modulos/ff/gravaJustificativa.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="file" />
    <input type="hidden" id="atestadoDia" name="atestadoDia" value="" />
    <input type="file" id="add_file" name="file" />
  </form>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
-->
    <legend>Folha de frequência</legend>
    
    <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
    <p>Professor: <strong><?php echo $nomeProf?></strong></p>
    <p>Período: <strong><?php echo "$mes/$ano"?></strong></p>
    <p>Utilize essa ícone para Justificar sua falta <img src="/cursos/images/pa.png" title="Justificar Falta"> e essa <img src="/cursos/images/upload_file.png"  title="Anexar atestado"> para subir o seu atestado
    
    <div class="lista">
      <table id="tb_lista_grupos_Mes_Detalhes" class="registros">
        <thead>
          <tr>
            <th>Data Aula</th>
            <th>Horas dadas</th>
            <th>Horas assistidas</th>
          </tr>
        </thead>       
        <tbody>        
				<?php
				$where = " WHERE CPF.idClientePf = " . $_SESSION['idClientePf_SS'] . " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND FF.idFolhaFrequencia = $idFolhaFrequencia ";
				echo $ClientePf->selectGrupoAlunoMesDetalhes($where, false);
				?>
        </tbody>
        
 
      </table>
    </div>
    <div style="width:100%;">
    <?php require_once("tabelaBHf.php"); ?> 
 <!--   <div style="width:50%;float: left;">-->
    <?php if($rsContestacaoFF){ 
			foreach($rsContestacaoFF as $valorsContestacaoFF){			
				$conf = $valorsContestacaoFF["status"] == 1 ? "confirmada" : "contestada";
				$obs = $valorsContestacaoFF["obs"] ? "<br />Comentário: ".$valorsContestacaoFF["obs"] : "";
				$dataCadastroCFF = Uteis::exibirDataHora($valorsContestacaoFF["dataCadastro"]);
				?>            
				
        <p>Folha <strong><?php echo $conf?></strong> pelo aluno em <?php echo $dataCadastroCFF.$obs?></p>
	
				<?php }
		}
 ?>
    
    <form id="form_cconcordoFF" class="validate" action="" method="post"  onsubmit="return false" >
    
      <input type="hidden" name="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <input type="hidden" name="idFolhaFrequencia" value="<?php echo $idFolhaFrequencia?>" />
      <input type="hidden" name="idProfessor" value="<?php echo $idProfessor?>" />
      
      <input type="hidden" name="mes" value="<?php echo $mes?>" />
      <input type="hidden" name="ano" value="<?php echo $ano?>" />
      
      <p><label>Concorda com a folha de frequência?</label>
        <label for="posicao"><br />
          <input name="posicao" id="posicao" type="radio" value="1" <?php if (($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == "")){echo "checked"; } ?> />
          Sim</label>
        <label for="posicao2">
          <input name="posicao" id="posicao2" type="radio" value="2" <?php if ($_SESSION['tipo'] == 2) {echo "checked"; } ?>/>
          Não </label>
      </p>
      <p>
        <label>Envie uma observação para o seu gerente:</label>
        <textarea name="obs" id="obs" cols="40" rows="5"></textarea>
      </p>
      <button class="Bblue" onclick="postForm('form_cconcordoFF', '<?php echo "modulos/ff/gravaAprovacao.php"?>');"> Enviar</button> 
      <button class="button gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/ff/index.php', '#centro')"> Fechar</button>
    </form>
    
    <!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
   <!--     <h5 class="modal-title" id="exampleModalLabel"><center><strong>Campanha Social</strong><center></h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!--  <span aria-hidden="true">&times;</span>-->
        </button>
      </div>
      <div class="modal-body">
 <!--  <div class="conteudo_nivel" style="z-index: 3002;">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  -->
  <fieldset>  
  <center><legend>Pesquisa de satisfação</legend></center>
  
          <form id="form_PSA" class="validate psa" action="" method="POST" onsubmit="return false">                        
            <input type="hidden" name="idGrupo" value="<?php echo $idGrupo?>">
            <input type="hidden" name="nome" value="<?php echo $_SESSION['nome_SS']?>">
            <input type="hidden" name="email" value="<?php echo $email;?>" />
            <input type="hidden" name="gerente" value="<?php echo $nome?>" />
            <input type="hidden" name="mes" value="<?php echo $mes?>" />
 	        <input type="hidden" name="ano" value="<?php echo $ano?>" />
            <input type="hidden" name="idProfessor" value="<?php echo $idProfessor?>" />
            <input type="hidden" name="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo?>" />
      
        <div id="1">    
        
        <p><strong>PROFESSOR</strong></p>					
        <p><strong>Avalie seu dinamismo, pontualidade, foco no resultado, preparação das aulas, nível linguístico e cultural etc</strong></p>
      
            <input type="hidden" name="iten1" value="Professor" />
           <p>
           
              <label>Resposta:</label>
               <select id="idNotasTipoNotaP" name="idNotasTipoNotaP" class="">
               		<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
               </select> 
              </p>
            
                        
            <p><label>Professor :</label>
      <?php echo $IntegranteGrupo->select_professoresIntegranteGrupoPsa($idIntegranteGrupo, $professor_idProfessor, "")?> <!--"required")?>
           <!-- <span class="placeholder">Campo obrigatório</span></p>-->
           </p>
            <p><label>Observação:</label><textarea id="obsP" name="obsP"></textarea></p>              
	
          </div>
				        
   
   <div id="2">
      
      	<p><strong>GESTÃO DE CURSOS</strong></p>					
				<p><strong>Avalie a gestão de seu curso pelas diversas áreas da Companhia de Idiomas (aulas assistidas, avaliações orais por Skype, seleção de material, esclarecimentos de dúvidas quanto à frequência e notas, boletos e etc)</strong></p>

       <input type="hidden" name="iten2" value="Gestão" />
		          
            <p>
              <label>Resposta:</label>
               <select id="idNotasTipoNotaC" name="idNotasTipoNotaC" class="">
               	<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
               </select> 
              </p>
              
              <p><label>Observação:</label>
              <textarea id="obsC" name="obsC" class=""></textarea></p> 
   		</div>
      
		      
   <div id="3">
      
      	<p><strong>QUALIDADE DA AULA</strong></p>					
				<p><strong>Avalie a qualidade de sua aula em relação à abordagem dos livros e áudios do curso, variedade de atividades/recursos extras, utilização do formulário VPG, revisões de conteúdo etc.</strong></p>
				
      <!--  <div class="tab2">-->
        <input type="hidden" name="iten3" value="Qualidade" />
				          
             <p>
              <label>Resposta:</label>
               <select id="idNotasTipoNotaA" name="idNotasTipoNotaA" class="">
               		<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
                </select> 
             
              <p><label>Observação:</label>
              <textarea id="obsA" name="obsA" class=""></textarea></p> 
          	</div>
      
		      
      <div id="4">
      
      	<p><strong>RESULTADO DO CURSO</strong></p>					
				<p><strong>Avalie a contribuição do professor para que tenha um resultado positivo no curso</strong></p>
				
     <!--   <div class="tab2">-->
        <input type="hidden" name="iten4" value="Resultado" />
				          
             <p>
              <label>Resposta:</label>
               <select id="idNotasTipoNotaR" name="idNotasTipoNotaR" class="">
               		<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
              </select> 
              
              <p><label>Observação:</label>
              <textarea id="obsR" name="obsR" class=""></textarea></p> 
                   
           </div>
      
		      
      <div id="5">
      
      	<p><strong>NPS - NET PROMOTER SCORE</strong></p>					
				<p><strong>Considerando apenas a qualidade da Companhia de Idiomas, qual a probabilidade de você nos indicar a um amigo, se tivesse a oportunidade?</strong></p>
				
   <!--     <div class="tab2">-->
        <input type="hidden" name="iten5" value="NPS" />
				          
             <p>
              <label>Resposta:</label>
               <select id="idNotasTipoNotaN" name="idNotasTipoNotaN" class="">
               		<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
               </select> 
             
              <p><label>Observação:</label>
              <textarea id="obsN" name="obsN" class=""></textarea></p> 
       	</div>
        
         <div id="6">
      
      	<p><strong>COMPROMISSO COM O CURSO</strong></p>					
				<p><strong>Faça uma autoavaliação do seu comprometimento com o seu desenvolvimento no idioma (realização de tarefas fora da sala de aula indicadas pelo professor, busca de conteúdos de seu interesse, etc)</strong></p>
				
   <!--     <div class="tab2">-->
        <input type="hidden" name="iten6" value="compromisso" />
				          
              <p>
              <label>Resposta:</label>
               <select id="idNotasTipoNotaComp" name="idNotasTipoNotaComp" class="">
               		<option value="">Selecione</option>
                    <option value="8">1</option>
                    <option value="9">2</option>
                    <option value="10">3</option>
                    <option value="11">4</option>
                    <option value="12">5</option>
                    <option value="13">6</option>
                    <option value="14">7</option>
                    <option value="15">8</option>
                    <option value="16">9</option>
                    <option value="17">10</option>
                    <option value="18">Prefiro Não Avaliar</option>
               </select> 
             
              <p><label>Observação:</label>
              <textarea id="obsComp" name="obsComp" class=""></textarea></p> 
       	</div>
    
      <p align="center"><button class="Bblue" onclick="enviadoPsa();postForm('form_PSA', '<?php echo "modulos/ff/enviaPSA.php"?>', '')">Finalizar pesquisa de satisfação</button></p>
      
      
  </fieldset>

</div>
    	
        
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="button gray" id="fecharPSA" data-dismiss="modal">Fechar</button>
       </div>
    </div>
  </div>
</div>
    
    
<p>&nbsp;</p>

  </div>
  <div >
  <p style="font-size:18px; font-weight:700;">A sua frequência neste mês foi: <?php echo round($AlunoPer, 2)."%"?></p>
  
  <?php if ($AlunoJust > 0) {
	echo '<p style="font-size:18px; font-weight:700;">Total de horas justificadas: '.Uteis::exibirHoras($AlunoJust).'</p>';
  }
  ?>
    
  
  <?php if ($rsFreq != "") { ?>
<p style="font-size:18px; font-weight:700;">  A frequência exigida pela empresa é: <?php echo $rsFreq."%"; ?></p>
<?php if ($AlunoPer < $rsFreq) {
	echo '<p style="font-size:18px; font-weight:700;color: red;">  Atenção aluno sua frequência está abaixo da exigida pela empresa!! </p>';
}?>
	
<?php } ?>
  </div>
  <hr />
  <div>
  <center><label><p style="font-size:18px; font-weight:700;">Nota Mensal - Habilidade e Atitude </p></label></center>
<?php

$dateU = date("Y-m-t", strtotime($ano."-".$mes."-01"));
$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($_SESSION['idClientePf_SS'], $idPlanoAcaoGrupo, "'".$dateU."'");

//Verificando se tem PSA finalizada
$PsaOK = $PsaIntegranteGrupo->psaFinalizada($_SESSION['idClientePf_SS'], $idPlanoAcaoGrupo);
//echo "finalizado:".$PsaOK;

$valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = ".$mes." AND ano = ".$ano);
$idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];

//Buscar se já existe
$rsAcomapanhamentoCurso = $AcompanhamentoCurso->selectAcompanhamentoCurso("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo."  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso. " AND (arquivado = 0 OR arquivado is null) ");

$idAcompanhamentoCurso = $rsAcomapanhamentoCurso[0]['idAcompanhamentoCurso'];

$nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTr(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes, 1);
//Uteis::pr($nota1);


$observacao = $RelatorioDesempenho->selectRelatorioDesempenhoTrObs(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso." AND integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo, $idAcompanhamentoCurso, $idIntegranteGrupo, $mes);

$sql = "SELECT SQL_CACHE TRD.idTipoItenRelatorioDesempenho, TRD.nome,  IRD.orientacao
			FROM tipoItenRelatorioDesempenho AS TRD
			INNER JOIN itenRelatorioDesempenho AS IRD on IRD.tipoItenRelatorioDesempenho_idTipoItenRelatorioDesempenho = TRD.idTipoItenRelatorioDesempenho
			WHERE TRD.inativo = 0 AND (avaliacao = $mes or reavaliacao = $mes)";
//			echo $sql;
		$result = Uteis::executarQuery($sql);

	$habilidade = $result[0]['nome'];
	$textoAtitude = $result[1]['orientacao'];	

$mystring = $nota1;
$findme   = ']';

$texto1 = substr($nota1, 1 , 2);
$texto1 = str_replace(']','',$texto1);

$pos = strripos($mystring, $findme);
$pos = $pos - 2;

$texto2 = substr($nota1, $pos);
$texto2 = str_replace(']','',$texto2);
$texto2 = str_replace('[','',$texto2);

?>

<p><label><strong>1º Nota:</strong> <?php echo $habilidade.": ".$texto1; ?> </label></p>
<p><label><strong>2º Nota: </strong> Atitude <?php echo ": ".$texto2.$textoAtitude; ?> </label></p>
<p><label><strong>Observações: </strong></label></p>
<p><?php echo $observacao;?></p>
 </div> 
  
  
  <script>
	//	tabelaDataTable('tb_lista_grupos_Mes_Detalhes');
	//	ativarForm();
		
		function enviado() {
		alert("Folha confirmada com sucesso!");	
			
		}

        function justificaFalta(idDiaAulaFFIndividual, nomeCampo, obsFaltaJustificada){

            var justificaFalta = prompt("Justificativa da falta", obsFaltaJustificada);
            if(justificaFalta!=null && justificaFalta != 'undefined' ){
                showLoad();
                $.post('modulos/ff/gravaJustificativa.php',
                    {
                        acao:"justificaFalta",
                        idDiaAulaFFIndividual:idDiaAulaFFIndividual,
                        justificaFalta:justificaFalta,
                        nomeCampo:nomeCampo,
                        periodo:"<?php echo $mes.'/'.$ano; ?>",
                        idPlanoAcaoGrupo:<?php echo $idPlanoAcaoGrupo; ?>,
                        nomeGrupo: "<?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo); ?>",
                        nomeAluno:"<?php echo $nomeAluno; ?>",
                        nomeProfessor:"<?php echo $nomeProf; ?>"
                    }, function(e){
                    fecharNivel_load();
                    acaoJson(e);
                });
            }
        }
		
		
function addAtestado(x) {
	$('#atestadoDia').val(x);
	}

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	
	var x = $('#atestadoDia').val();

	$('#visualizarFile_'+x+'').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile_'+x+'' // o callback será no elemento com o id #visualizar
	}).submit();

});
	</script>
   <?php if ($PsaOK == "red") { ?>
   <script>	
	function PsaRand() {
	
	$('#1').hide();
	$('#2').hide();
	$('#3').hide();
	$('#4').hide();
	$('#5').hide();
	$('#6').hide();
	
		var x = Math.floor((Math.random() * 6) + 1);	
	$('#'+x+'').show();	
	}
		
//	PsaRand();	
		
	//$('#exampleModal2').modal('show');
	
	function enviadoPsa() {
		alert("Pesquisa enviada com sucesso!");	
	//		$('#exampleModal2').modal('hide');
		
	}
		
  </script>
<?php }?>
<!--</div>-->