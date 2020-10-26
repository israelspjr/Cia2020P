<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

?>

<fieldset>
  <legend>Filtros</legend>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
     		<p>
          <label>Status :</label>
          <select size="3" name="status" id="status">
          	<option value="" >Todos</option>
            <option value="0" selected="selected" >Ativo</option>
	          <option value="1" >Inativo</option>
          </select>
        </p>
      </div>     
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."funcionario/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
<legend>Cadastro de funcionário administrativo</legend>
  <div id="lista_res" class="lista"></div>
</fieldset>

<script>
ativarForm();
eventDestacar(1);
</script>
