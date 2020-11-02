<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente =new Gerente();
$Professor = new Professor();

$mes = 2;
$mes_fim = date('m');
$ano = date('Y');
$anoI = 2015;

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "nome", 1 => "Nome Professor");
$arrItens_padrao[] = array(0 => "valorP", 1 => "Valor Hora Professor");
$arrItens_padrao[] = array(0 => "horaN", 1 => "Horas não realizada");
$arrItens_padrao[] = array(0 => "horaR", 1 => "Horas repostas");
$arrItens_padrao[] = array(0 => "horaE", 1 => "Horas expiradas");
$arrItens_padrao[] = array(0 => "valorA", 1 => "Saldo de Horas");
?>

<fieldset>
  <legend>Relatório de Banco de Horas</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
    <p><strong>Filtros</strong></p>
    <form id="form_rel_banco" class="validate" method="post" action="" onsubmit="return false" >
      <div class="linha-inteira">
        <div class="esquerda">
    <!--      <label>Selecionados:</label>
        <img src="<?php echo CAMINHO_IMG."menos2.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        <p>-->
          <select multiple="multiple" name="sel_lista_padrao[]" id="sel_lista_padrao" size="10" style="display:none;">
          	<?php foreach($arrItens_padrao as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
          <select multiple="multiple" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" style="display:none;">          	
          </select>
     <!--   </p>   -->
        <p>
        <label> Acumulado do início do sistema (01/02/2015)<!-- até o mês anterior a próxima data do filtro:</label>
        </p>
      <!--  <p>
        <label> Variação no bimestre escolhido:</label>
          <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2015; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($anoI == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>-->
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes_fim == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2015; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
        
        <div>
       <p>
      <input type="radio" name="statusC" id="statusC" value="3" >Somente Saldo a compensar &nbsp;</p>
         <p> <input type="radio" name="statusC" id="statusC" value="1" >Somente Saldo a mais</p>
         <p> <input type="radio" name="statusC" id="statusC" value="2" >Somente Saldo zerado</p> 
         <p> <input type="radio" name="statusC" id="statusC" value="4" checked="checked">Todos      </p>
        
        
        
        </div>
        </div>
        
        <div class="esquerda">
    <!--        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="5" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
        </p>    --> 
        <p>
        <label>Professor:</label>
        <?php echo $Professor->selectProfessorSelect("", "", ""); ?>
           
        </p>
        <br />OU
          <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>       
        <p>
          <label>Empresa:</label>         
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
         <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-" onchange="grupos();">Ambos      
        </p>
        <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p> 
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
    postForm_relatorio('img_form_Grupos', '', 'form_rel_banco', '<?php echo CAMINHO_RELAT."banco/include/resourceHTML/banco.php"?>', '#res_rel');
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
  status =  $("#statusG:checked").val();
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
//$('#grupo_idGrupo').attr('onchange','Enviar()');
buscar();
grupos();
ativarForm();
</script> 