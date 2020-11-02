<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$idworkshop = $_REQUEST['idWorkshop'];
$work = new Workshop();
if($idworkshop!=""){
$valor = $work->selectWorkShop("WHERE idworkshop = ".$idworkshop);  
  Uteis::pr($valor);  
}
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>
      Cadastros de Workshops
    </legend>
    <form id="form_workshop" class="validate" method="post" onsubmit="return false" >
      <input type="hidden" name="idworkshop" id="idworkshop" value="<?php echo $valor[0]['idworkshop'];?>" />      
      <input type="hidden" name="excluido" id="excluido" value="<?php echo $valor[0]['excluido']?>"/>
      <input type="hidden" name="acao" id="acao" value="cadastrar"/>      
      <p>
        <label>Tema do Evento:</label>
        <input type="text" id="tema" name="tema" class="required" value="<?php echo $valor[0]['tema']?>" />
        <span class="placeholder">Campo Obrigatório</span>
      </p>
      <p>
        <label>Total de Vagas:</label>
        <input type="text" name="vagas" id="vagas" class="required numero" value="<?php echo $valor[0]['vagas']?>" />
        <span class="placeholder">Campo Obrigatório</span>
      </p>    
      <p>
        <label>Data do Evento:</label>
        <input type="text" name="dataEvento" id="dataEvento" class="required data" value="<?php echo Uteis::exibirData($valor[0]['dataEvento'])?>" />
        <span class="placeholder">Campo Obrigatório</span>
      </p>     
      <p> 
        <label>Horário de Início:</label>
        <input type="text" name="inicio" id="inicio" class="required hora" value="<?php echo Uteis::exibirHoras($valor[0]['inicio'])?>" />
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
      <p> 
        <label>Horário de Término:</label>
        <input type="text" name="termino" id="termino" class="required hora" value="<?php echo Uteis::exibirHoras($valor[0]['termino'])?>" />
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
      <p>
        <label>Finalizado:</label>
        <input type="checkbox" name="finalizado" id="finalizado" value="1" <?php ($valor[0]['finalizado'])? "Checked":""; ?> />
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_workshop', '<?php echo CAMINHO_EVENTOS?>evento/acao.php')">
          Enviar
        </button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script>
