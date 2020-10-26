<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_log" 
onclick="abrirFormulario('div_log', 'img_log');" />  
    <form id="form_log"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
        <p>
          <label>Usuário:</label>
          <select id="usuario" name="usuario" >
              <option value="0">Todos</option>
              <option value="1">Professor</option>
              <option value="2">ClientePf</option>
              <option value="3">ClientePj</option>
              <option value="4">Funcionário</option>
          </select>
        </p>
        <p>
           <label>Falha:</label>
           <input type="checkbox" id="ativo" name="ativo" value="1"  />
        </p>
        <p>
           <label>Data Inicial:</label>
           <input type="text" id="dataIni" name="dataIni" class="data" />
        </p>
        <p>
           <label>Data Final:</label>
           <input type="text" id="dataFim" name="dataFim" class="data" value="<?=date("d/m/Y");?>"/>
        </p>
      </div> 
      <div class="direita">
                    <label>Ação executado no banco:</label>
                    <select name="acaoexecutada[]" id="acaoexecutada">
                        <option value="">Todos</option>
                        <option value="insert">Login</option>
                        <option value="insert">Logout</option>
                        <option value="insert">Select</option>
                        <option value="insert">Insert</option>
                        <option value="delete">Delete</option>
                        <option value="update">Update</option>
                    </select>
                </div>
      <div class="linha-inteira">
        <button class="button blue" onclick="Enviar()" >Buscar</button>
      </div>
    </form>
 

</fieldset>
<fieldset>
  <legend>LOG</legend>
  <div id="lista_log" class="lista">
  </div>
</fieldset>
<script>
function Enviar(){
    filtro_postForm('img_log', 'form_log', '<?php echo CAMINHO_MODULO . "log/index.php"?>', '', '#lista_log')
}
ativarForm();
</script>