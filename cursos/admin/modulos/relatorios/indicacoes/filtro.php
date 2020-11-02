<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$ClientePf = new ClientePf();


$mes = date('m');
$ano = date('Y');

//PADRÃO
$arrItens_padrao[] = array(0 => "clientePf", 1 => "ClientePf");
$arrItens_padrao[] = array(0 => "clientePj", 1 => "ClientePj");
$arrItens_padrao[] = array(0 => "nome", 1 => "Nome Indicação");
$arrItens_padrao[] = array(0 => "produto", 1 => "Produto");
$arrItens_padrao[] = array(0 => "interno", 1 => "Interno");
$arrItens_padrao[] = array(0 => "externo", 1 => "Externo");
$arrItens_padrao[] = array(0 => "potencial", 1 => "Potencial");
$arrItens_padrao[] = array(0 => "influencia", 1 => "Influência");
$arrItens_padrao[] = array(0 => "dataCadastro", 1 => "Data de Cadastro");
$arrItens_padrao[] = array(0 => "acao", 1 => "Ação");
?>

<fieldset>
  <legend>Filtros</legend>
  
	<div class="menu_interno"> 
   

	</div>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
           <label>Selecionados:</label>
        <img src="<?php echo CAMINHO_IMG."menos2.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        <p>
          <select multiple="multiple" name="sel_lista_padrao[]" id="sel_lista_padrao" size="10" >
          	<?php foreach($arrItens_padrao as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
          <select multiple="multiple" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" style="display:none;">          	
          </select>
        </p>         
          <p>
              Cliente:
              <?php echo $ClientePf->selectClientePfSelect(); ?>
          </p>
          <p>    
         <label>Empresa:
            <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select> </label>
          </p>
          <p>
          <strong>De: </strong>
        
        <select name="mes_ini" id="mes_ini" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        
        <select name="ano_ini" id="ano_ini" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
            <p>
          <strong>Até:</strong> 
        
        <select name="mes_fim" id="mes_fim" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        
        <select name="ano_fim" id="ano_fim" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
      </div>
      <div class="direita">
             <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="10" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
        </p>
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="geraRel()" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Relatório de indicações</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>

function geraRel(){

	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_filtra_Grupos', '<?php echo CAMINHO_RELAT."indicacoes/include/resourceHTML/retorno.php"?>', '#lista_res');

}
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

$('#idGerente').attr('onchange', 'buscar()');
//$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
//grupos();
ativarForm();


</script>
