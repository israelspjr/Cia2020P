<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoCliente = new TipoCliente();

?>

<fieldset>
  <legend>Filtros</legend>
  
	<div class="menu_interno"> 
   
		<img src="<?php echo CAMINHO_IMG."pre.jpg";?>" width='32px' height='32px'  title="Novo Pré cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/preCadastro.php";?>', 'click', '');" /> 

<img src="<?php echo CAMINHO_IMG."lista.png";?>" width='32px' height='32px'  title="Lista Pré cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/listaPreCadastro.php";?>', 'click', '');" /> 
        
        <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/cadastro.php";?>', 'click', '');" /> 
		
	<!--	<img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="Histórico de excluídos" 
	  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/historico.php";?>', 'click', '');" />-->
	  
	</div>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
      
        <p>
                    Cliente:<input type="text" name="nome" id="nome" list="nomeList"     style="width: 400px;"><span id="nomeEmail" style="display:none"><-Selecione o nome ao lado</span>
                    
                    <datalist id="nomeList">
                    </datalist>    
                </p>
        
                 <p>
                    Email:<input type="text" name="email" id="email" list="nomeListEmail">
                 </p>
                
                <p>
                    CPF:<input type="text" name="cpfP" id="cpfP" list="nomeListCpf" maxlength="14" class="cpf" onkeyup="nomeCpf()">
                </p>
                
                <p>Telefone:(Utilizar somente: XXXX-XXXX) <input type="text" name="telefoneP" id="telefoneP" list="nomeListTelefone" maxlength="14" class="telefone" onkeyup="nomeTelefone()">
                </p>
                
                
     		<p>
          <label>Status :</label>
          <select size="3" name="status" id="status" style="height: 68px;">
          	<option value="-" selected="selected" >Todos</option>
            <option value="0" selected="selected">Ativo</option>
	          <option value="1" >Inativo</option>
               <option value="2" >Excluido</option>
          </select>
          </p>
          <p>
          <input name="grupo1[]" type="checkbox" id="grupo1" checked="checked"   style="display:none;"/>
        </p>
      </div>
      
      <div class="direita">
       <p>
          <label>Tipo de cliente:</label>
          <?php echo $TipoCliente->selectTipoClienteSelectMult("", "")?></p>
               <p>    
         <label>Empresa:</label>
            <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>     
          <p>
          
           <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="2" onchange="grupos();">Ambos      
        </p>
         <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
          
          <input name="pendentes" type="checkbox" id="pendentes" />Pendentes para inativar
        </p>
        <p>
                <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" value="1" class="">
                Não mostrar alunos que não desejam receber email<br>
            </p>
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."clientePf/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Cliente pessoa física</legend>
  <div id="lista_res" class="lista2"> </div>
</fieldset>
<script>
    $(function(){
       $("input[name=nome]").keyup(function(){
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
   
     $(function(){
       $("input[name=email]").keyup(function(){
           var email = $(this).val();
           if(nome != ""){
              var dados = {
                 // tabela:'clientePf',
                  email:email,
                //  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."clientePf/busca_nome_email.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
				//   $('#nomeEmail').show();
               });
           }
        });   
           
   });   
   
   function nomeCpf() {
	var cpf = $("#cpfP").val();
	if(cpf != ""){
              var dados = {
                 // tabela:'clientePf',
                  cpf:cpf,
                //  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."clientePf/busca_nome_cpf.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
			//	   $('#nomeEmail').show();
               });
	}
	   
   }
   
   function nomeTelefone() {
	var telefone = $("#telefoneP").val();
	if(telefone != ""){
              var dados = {
                 // tabela:'clientePf',
                  telefone:telefone,
                //  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."clientePf/busca_nome_telefone.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
			//	   $('#nomeEmail').show();
               });
	}
	   
   }
   
  
   
   
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

function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}

//$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
grupos();
ativarForm();
</script>
