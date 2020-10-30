<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$LocalAula = new LocalAula();
$Endereco = new Endereco();

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Novo dia de frequência permanente</legend>
    <form id="form_AulaPermanenteGrupo" class="validate" method="post" action="" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <div class="esquerda">
        <p>
          <label>Dia da semana:</label>
          <select name="diaSemana" id="diaSemana" class="required" >
            <option value="" >Selecione</option>
            <option value="1" >domingo</option>
            <option value="2" >segunda-feira</option>
            <option value="3" >terça-feira</option>
            <option value="4" >quarta-feira</option>
            <option value="5" >quinta-feira</option>
            <option value="6" >sexta-feira</option>
            <option value="7" >sábado</option>
          </select>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Hora de início:</label>
          <input type="text" name="horaInicio" id="horaInicio" class="required hora"/>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Hora de início:</label>
          <input type="text" name="horaFim" id="horaFim" class="required hora"/>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Início aula em:</label>
          <input type="text" name="dataInicio" id="dataInicio" class="required data"  />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Termina aulas em (opcional):</label>
          <input type="text" name="dataFim" id="dataFim" class="data" />
        </p>
      </div>
      <div class="direita">
        <p>
          <label>Local alternativo de aula:</label>
           
		  <?php echo $LocalAula->selectLocalAulaSelect("", $idLocalAula);?> <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <label>Endereço:</label>
          <select id="idEndereco" name="idEndereco">
                <option value="">Selecione</option>
        </select>
          		  <?php echo $Endereco->selectEnderecoSelectPlanoAcao("", $idEndereco, "0");?> </p>
      </div>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_AulaPermanenteGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/integranteGrupo.php"?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
function buscar(){
  var local;  
  $( "#idLocalAula" ).empty();
  $( "#idLocalAula" ).append("<option value='-'>Endereço da Aula</option>");
  local = $("#idLocalAula option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_local.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#idEndereco" ).append( html );
  });
  
}
$('#idLocalAula').attr('onchange','buscar()');
buscar();
ativarForm();
</script> 