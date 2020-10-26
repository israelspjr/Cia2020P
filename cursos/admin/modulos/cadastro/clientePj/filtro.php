<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoCliente = new TipoCliente();
?>

<fieldset>
  <legend>Filtros</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePj/cadastro.php";?>', 'click', '#bt');" /> 
  </div>
  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
          <p>
                    Razão Social:<input type="text" name="razaoSocial" id="razaoSocial" list="razaoSocialList">
                    <datalist id="razaoSocialList">
                    </datalist>    
                </p>
     		<p>
          <label>Status :</label>
          <select multiple="multiple" size="3" name="status[]" id="status">
          	<option value="" selected="selected" >Todos</option>
            <option value="0" >Ativo</option>
	          <option value="1" >Inativo</option>
          </select>
        </p>
      </div>
      
      <div class="direita">
       <p>
          <label>Tipo de cliente:</label>
          <?php echo $TipoCliente->selectTipoClienteSelectMult("", 0)?></p>
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."clientePj/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Cliente pessoa jurídica</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>
    $(function(){
       $("input[name=razaoSocial]").keyup(function(){
           var razaoSocial = $(this).val();
           if(razaoSocial != ""){
              var dados = {
                  tabela:'clientePj',
                  razaoSocial:razaoSocial,
                  campo:'razaoSocial',
               }
               $.post('<?php echo CAMINHO_CAD."clientePj/busca_nome.php";?>', dados, function(retorno){
                   $("#razaoSocialList").html($.parseJSON(retorno));
               });
           }
        });   
           
   });  
ativarForm();
//$('#bt').click();
</script> 
