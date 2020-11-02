<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$Grupo = new Grupo();
$Idioma = new Idioma();
$gerente = new Gerente();
$Professor = new Professor();


$mes = date('m');
$ano = date('Y');

//PADRÃO
$arrItens_padrao[] = array(0 => "empresa", 1 => "Empresa");
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "ano", 1 => "Ano");
$arrItens_padrao[] = array(0 => "mes", 1 => "Mês");
$arrItens_padrao[] = array(0 => "tipo", 1 => "Tipo");
$arrItens_padrao[] = array(0 => "total", 1 => "Valor | Total Geral");
$arrItens_padrao[] = array(0 => "quemP", 1 => "Quem Paga");

//Opcionais
$arrItens_opcional[] = array(0 => "professor", 1 => "Professor (selecionar o professor)");
?>

<fieldset>
  <legend>Relatório de créditos e débitos</legend>
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
          <label>Coordenador:</label>
          <?php echo $gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
      </p>    
          <p>
          <label><strong>De: </strong></label>
        <label>Mês:
        <select name="mes" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>

        Ano:
        <select name="ano" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select></label>
      </p>
            <p>
          <label><strong>Até:</strong> </label>
        <label>Mês:
        <select name="mes_fim" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        Ano:
        <select name="ano_fim" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select></label>
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
         <p>
            <label>Tipo:</label>
              <input type="radio" name="tipo" id="tipo" value="" />Ambos
              <input type="radio" name="tipo" id="tipo" value="0" />Créditos
              <input type="radio" name="tipo" id="tipo" value="1" />Débitos
          </p>
                <p>
          <label>Empresa:</label>        
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
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
        
        <p>
        <label>Professor:</label>
        <?php echo $Professor->selectProfessorSelect("", "", " AND candidato = 0"); ?>
        </p>
        
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
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."credDeb/index.php"?>', '#res_rel');

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
grupos();
ativarForm();
buscar();
</script> 