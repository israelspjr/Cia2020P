<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$Gerente = new Gerente();

$mes = date('m');
$ano = date('Y');

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "empresa", 1 => "Empresa");
$arrItens_padrao[] = array(0 => "parteE", 1 => "Parte Total Empresa R$ / NFe");
$arrItens_padrao[] = array(0 => "parteA", 1 => "Parte Total Aluno R$ / NFe");
$arrItens_padrao[] = array(0 => "vencimento", 1 => "Vencimento");
$arrItens_padrao[] = array(0 => "total", 1 => "Total");


?>

<fieldset>
  <legend>Relatório Faturamento Detalhado</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
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
          <select name="mes" id="mes" >
            <?php for($x=1; $x <= 12; $x++){ ?>
            <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
            <?php }?>
          </select>
          <span class="placeholder"></span>
          <select name="ano" id="ano" >
            <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
            <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
            <?php } ?>
          </select>
          <span class="placeholder"></span></p>
         <p>
          <label>Gerente:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
           
        <p>
          <label>Empresa:</label>       
          <select id="clientePj_idClientePj" name="clientePj_idClientePj" size="5">
            <option value="-">Empresas</option>            
          </select>
        </p>
       <!--  <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo" size="5">
                 <option value="-">Grupos</option>  
            </select>
        </p>-->
        <p>
          <label>Grupos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-"  onchange="grupos();">Ambos      
        </p>
          <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
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
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel2" onclick="geraRel()">Gerar relatório</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script>
function geraRel(){

	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."consolidado/include/resourceHTML/consolidado.php"?>', '#res_rel');

}
function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = 0;
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
  grupos();
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $('input[name=statusG]:checked', '#form_rel_pf').val()
 // status = $( "#statusG option:selected" ).val();
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
ativarForm();
//$('#grupo_idGrupo').attr('onchange','Enviar()');
buscar();
//grupos();

</script> 