<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Segmento = new Segmento();

?>

<fieldset>
  <legend>Filtros</legend>
  
	<div class="menu_interno"> 
   
 <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."emailsMkt/formulario.php".$param?>', '<?php echo CAMINHO_CAD."emailsMkt/filtro.php"?>', '#centro')" /> </div>
  
  <!--      <img src="<?php //echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php //echo CAMINHO_CAD."clientePf/cadastro.php";?>', 'click', '');" /> 
		
		<img src="<?php //echo CAMINHO_IMG."pasta.png";?>" title="Histórico de excluídos" 
	  onclick="abrirNivelPagina(this, '<?php //echo CAMINHO_CAD."clientePf/historico.php";?>', 'click', '');" />-->
	  
	</div>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
         <!-- <p>
                    Cliente:<input type="text" name="nome" id="nome" list="nomeList">
                    <datalist id="nomeList">
                    </datalist>    
                </p>-->
     		<p>
          <label>Status :</label>
          <select size="3" name="status" id="status">
-          	<option value="" selected="selected" >Todos</option>
            <option value="0" selected="selected">Ativo</option>
	          <option value="1" >Inativo</option>
              <!-- <option value="2" >Excluido</option>-->
          </select>
          </p>
          <p>
          <label>Segmento: </label>
          <?php echo $Segmento->SelectSegmentoSelect("","")?>
          </p>
  <!--     <p>
          <input name="totais" type="checkbox" id="totais" value="1"   />Mostrar Totais
        </p>-->
      </div>
      
 <!--     <div class="direita">
       <p>
          <label>Tipo de cliente:</label>
          <?php //echo $TipoCliente->selectTipoClienteSelectMult("required", "")?></p>
               <p>    
         <label>Empresa:</label>
            <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>     
          <p>
          <input name="pendentes" type="checkbox" id="pendentes" />Pendentes para inativar
        </p>-->
        
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."emailsMkt/index.php"?>', '', 'lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Emails Cadastrados</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>
    $(function(){
       $("input[name=nome").keyup(function(){
           var nome = $(this).val();
           if(nome != ""){
              var dados = {
                  tabela:'clientePf',
                  nome:nome,
                  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."clientePf/busca_nome.php";?>', dados, function(retorno){
                   $("#nomeList").html($.parseJSON(retorno));
               });
           }
        });   
           
   });  
   function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = $("#status:checked").val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  
}

//$('#idGerente').attr('onchange', 'buscar()');
//$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
//grupos();
ativarForm();
</script>
