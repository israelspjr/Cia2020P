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
if ($idProfessor == '') {
	$rs = $Professor->selectGrupoProfTr_query(" WHERE PAG.idPlanoAcaoGrupo  = ".$idPlanoAcaoGrupo);	
	Uteis::pr($rs);
	$nomeProf = $Professor -> getNome($rs[0]['idProfessor']);
} else {
	$nomeProf = $Professor -> getNome($idProfessor);
}
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
	if ($mes == '') {
		$mes = date("m");		
	}
$ano = $_REQUEST['ano'];
	if ($ano == '') {
		$ano = date("Y");		
	}



$where = " WHERE folhaFrequencia_idFolhaFrequencia = $idFolhaFrequencia AND integranteGrupo_idIntegranteGrupo IN (
	SELECT idIntegranteGrupo FROM integranteGrupo 
	WHERE clientePf_idClientePf = " . $_SESSION['idClientePf_SS'] . " AND planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo
)";
$rsContestacaoFF = $ContestacaoFF -> selectContestacaoFF($where);
?>

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
   <!--   <div class="modal-footer">
        <button type="button" class="button gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/ff/index.php', '#centro')">Fechar</button>
       </div>-->
    </div>
  </div>
</div>
    
 
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