<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$inscricao = new WorkshopPresenca();  
$evento = new Workshop();
$idWorkshopPresenca = $_GET['idWorkpresenca']; 
$idProfessor = $_REQUEST['idProfessor'];

$valor = $inscricao->selectPresenca(" WHERE idpresenca = ".$idWorkshopPresenca);

?>

<div id="inscricao_presenca" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_inscricao" divExibir="div__inscricao" class="aba_interna ativa">Inscrição</div>
   </div>
  <div id="modulos_inscricao" class="conteudo_nivel">
    <div id="div_inscricao" class="div_aba_interna">
      <?php 
  //      require_once 'form_inscricao.php';    
       ?>
<fieldset>
    <legend>
      Cadastros de Participação em Capacitação / Workshops
    </legend>
    <form id="form_WorkshopPresenca" class="validate" method="post" onsubmit="return false" >
      <input type="hidden" name="idPresenca" id="idPresenca" value="<?php echo $valor[0]['idpresenca'];?>" />     
      <input type="hidden" name="excluido" id="excluido" value="<?php echo $valor[0]['excluido']?>"/>
      <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor?>"/>
      <input type="hidden" name="acao" id="acao" value="cadastrar"/>      
      <p>
        <label>Evento:</label>
        
		<input type="text" name="evento" id="evento" class="required " value="<?php echo $valor[0]['workshop_idWorkshop']?>"/>
        <span class="placeholder">Campo Obrigatório</span>
      <!-- // $work = new Workshop();
       // echo $work->selectWorkShopSelect($valor[0]['workshop_idWorkshop']);
        -->
      </p>
  <!--    <p>
        <label>Professor:</label>
        <?php
      //    $Professor = new Professor();
      //    echo $Professor->getNome($idProfessor); //selectProfessorSelect();
        ?> 
      </p>
  <!--    <p>
        <label>Funcionário:</label>
        <?php
          //$Funcionario = new Funcionario();
          //echo $Funcionario->selectFuncionarioSelect();
        ?> 
      </p>    -->
      <p>
        <label>Data do Evento:</label>
        <input type="text" name="dataEvento" id="dataEvento" class="required data" value="<?php echo Uteis::exibirData($valor[0]['dataInscricao'])?>"/>
        <span class="placeholder">Campo Obrigatório</span>
      </p>     
      <p> 
        <label>Duração do evento:</label>
        <input type="text" name="duracao" id="duracao" class="required hora" value="<?php echo Uteis::exibirHoras($valor[0]['duracao'])?>"/>
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
      <p>
      <label>Aprovado?
      <input type="checkbox" name="aprovado" id="aprovado" value="1" <?php if ($valor[0]['aprovado'] == 1) { echo "checked='checked'"; } ?> /></label>
    
      <p>
        <button class="button blue" onclick="postForm('form_WorkshopPresenca', '<?php echo CAMINHO_CAD."professor/contratado/include/acao/inscricao.php"?>')">
          Enviar
        </button>
      </p>
    </form>
  </fieldset>
<script>
ativarForm();
</script>
    </div>
 </div>
</div>
<script>  
</script> 
