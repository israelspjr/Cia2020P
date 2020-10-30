<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Grupo = new Grupo();
$IntegranteGrupo = new IntegranteGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

if($idPlanoAcaoGrupo != '' && is_numeric($idPlanoAcaoGrupo)){
    
	$valor = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	
	$grupo_idGrupo = $valor[0]['grupo_idGrupo'];
	$dataInicioEstagio = Uteis::exibirData($valor[0]['dataInicioEstagio']);
	$DataPrevisaoTerminoEstagio = Uteis::exibirData($valor[0]['dataPrevisaoTerminoEstagio']);	
	$Categoria = $valor[0]['categoria'];
	
	$valor2 = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	
//	$dataInativacao = Uteis::exibirData($valor2[0]['dataSaida']);
	$dRetorno = Uteis::exibirData($valor2[0]['dataRetorno']);
	$motivo = $valor2[0]['motivo'];
    
	if($Categoria[0] == '0' or $Categoria==""):  
        $cat[0] = 0;  
    else:  
        $cat = explode(",",$Categoria);
    endif;

	
	$valorGrupo = $Grupo->selectGrupo(" WHERE idGrupo = ".$grupo_idGrupo);
//	Uteis::pr($valorGrupo);
	$nomeGrupo = $valorGrupo[0]['nome']; 
	$inativoGrupo = $valorGrupo[0]['inativo']; 
	$inativo = $valor[0]['inativo'];
	$naoBancoHoras = $valorGrupo[0]['naoBancoHoras'];
//	echo $naoBancoHoras;
    $dataInativacao = Uteis::exibirData($valorGrupo[0]['dataInativado']);    
	
	$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
	$valor2 = $PlanoAcao->selectPlanoAcao(" WHERE idPlanoAcao =". $idPlanoAcao);
	$tipoContrato = $valor2[0]['tipoContrato'];
	
	if ($tipoContrato == 0) {
    $nomeContrato = "Prazo indeterminado";
} elseif($tipoContrato == 1) {
	$nomeContrato = "Pacote de horas ";
} elseif($tipoContrato == 2) {
	$nomeContrato = "Prazo Determinado (Verificar Contrato)";
	
}
//	echo $tipoContrato;
}

//Uteis::pr($cat);

?>

<div class="conteudo_nivel">
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<fieldset>
  <legend> <?php echo $nomeGrupo?> </legend>
  <form id="form_PlanoAcaoGrupo" class="validate" method="post" action="" onsubmit="return false" >
  	<input type="hidden" value="<?php echo $grupo_idGrupo?>" name="grupo_idGrupo" id="grupo_idGrupo" />
  	<div class="esquerda">
      <p>
        <label>Nome do grupo:</label>
        <input type="text" name="nomeGrupo" id="nomeGrupo" class="required" value="<?php echo $nomeGrupo?>" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Ínicio do estágio:</label> 
        <input type="text" name="dataInicioEstagio" id="dataInicioEstagio" class="data" value="<?php echo $dataInicioEstagio?>" />
        
      <p>
        <label>Previsão de término do estágio:</label>
        <input type="text" name="dataPrevisaoTerminoEstagio" id="dataPrevisaoTerminoEstagio" class="data" value="<?php echo $DataPrevisaoTerminoEstagio?>" />
      </p>
      
      <p>
        <label>Inativar Grupo:</label>
        <input type="checkbox" name="inativoGrupo" id="inativoGrupo" onclick="mensagem();" value="1" <?php  echo $inativoGrupo ? "checked" : ""?> />
      </p>
      <p>
        <label>Inativar Alunos:</label>
        <input type="checkbox" name="inativoAlunos" id="inativoAlunos" value="1" />
      </p>
      <p>
        <label>Data de inativação do(s) Aluno(s):</label>
        <input type="text" name="dataInativacaoA" id="dataInativacaoA" class="data" value="<?php  //echo $dataInativacao?>" /> 
      </p>
      <p>
         <label>Selecione os integrantes que serão inativados:</label>
        <?php echo $PlanoAcaoGrupo->selectIntegrantesGrupoCheckBox($idPlanoAcaoGrupo,1,1); ?>
        </p>
        </div>
       <div class="direita">
        <p>
        <label>Tipo de contrato: <?php echo $nomeContrato?></label>
       <!--
        <input type="radio" id="tipoContrato" name="tipoContrato" value="0" <?php if ($tipoContrato == 0) {echo 'checked';} ?>>Prazo Indeterminado</option>
        <input type="radio" id="tipoContrato" name="tipoContrato"  value="1" <?php if ($tipoContrato == 1) {echo 'checked';} ?>>Pacote de horas</option>
        -->
      </p>
      <p>
      <label>Grupo não participa do relátorio de banco de horas</label>
      <input type="checkbox" id="naoBancoHoras" name="naoBancoHoras" value="1" <?php  echo $naoBancoHoras ? "checked" : ""?>  />
      <p>
        <label>Data de inativação do Grupo:</label>
        <input type="text" name="dataInativacao" id="dataInativacao" class="data" value="<?php  echo $dataInativacao?>" /> 
      </p>
      
       <p>
        <label>Data para Retorno:</label>
        <input type="text" name="dretorno" id="dretorno" class="data" value="<?php  echo $dretorno?>" /> 
      </p>
      
     <p>
        <label>Motivo:</label>
        <textarea  name="motivo" id="motivo" value="<?php  echo $motivo?>" />
      </p>
     
      
    </div>
    <div class="direita">
  <!--      <p>
        <label>Categoria:</label>
        
        <input type="checkbox" id="sem_estrela" <?php if (in_array("0", $cat)) {echo  "checked"; } ?> />
        <img src="<?php echo CAMINHO_IMG."estrela_branco.gif"?>"> Grupo sem nehuma estrela<br>
        <input type="checkbox" name="categoria[]" id="estrela_1" value="1" <?php if (in_array("1", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> é aluno há mais de 3 anos(Lealdade)<br>
        <input type="checkbox" name="categoria[]" id="estrela_2" value="2" <?php if (in_array("2", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> ele ou alguém de seu grupo indica alunos (registrar quem indica) ou é RH (PROMOTOR)<br>
        <input type="checkbox" name="categoria[]" id="estrela_3" value="3" <?php if (in_array("3", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> há um mínimo de três grupos nessa empresa (PROPAGAÇÃO DA MARCA)<br>
        <input type="checkbox" name="categoria[]" id="estrela_4" value="4" <?php if (in_array("4", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> paga valor máximo atual e/ou realiza mais de três horas semanais (LUCRO)<br>
        <input type="checkbox" name="categoria[]" id="estrela_5" value="5" <?php if (in_array("5", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> tem aulas individuais (ALUNO É FORMADOR DE OPINIÃO,TEM PODER)<br>
      </p>-->
    </div>
    <div class="linha-inteira">
    <p>
      <button class="button blue" onclick="postForm('form_PlanoAcaoGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupo.php?id=".$idPlanoAcaoGrupo?>')">Salvar</button>
    </p>
    </div>
  </form>
  </div>
</fieldset>
</div>
<script>
ativarForm();
 $(document).ready(function() {
    $('#sem_estrela').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('#estrela_1').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_2').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_3').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_4').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_5').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_1').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_2').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_3').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_4').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_5').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
});

function mensagem() {
confirm("Atenção coordenador os alunos já foram inativados ?");	
	
}
</script>