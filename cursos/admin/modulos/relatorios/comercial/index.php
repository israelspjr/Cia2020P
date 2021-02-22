<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();

//$TipoCliente = new TipoCliente();

$mes = date('m');
$ano = date('Y');

//PADRÃO
$arrItens_padrao[] = array(0 => "nome", 1 => "Nome");
$arrItens_padrao[] = array(0 => "email", 1 => "Email");
$arrItens_padrao[] = array(0 => "empresa", 1 => "Empresa");
$arrItens_padrao[] = array(0 => "nomeGrupo", 1 => "Nome Grupo");
$arrItens_padrao[] = array(0 => "nivel", 1 => "Nível");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma");
$arrItens_padrao[] = array(0 => "valorHora", 1 => "Valor Hora Grupo");
$arrItens_padrao[] = array(0 => "professor", 1 => "Professor");
$arrItens_padrao[] = array(0 => "telefone", 1 => "Telefone(s)");
$arrItens_padrao[] = array(0 => "dataEntrada", 1 => "Data Entrada");
$arrItens_padrao[] = array(0 => "dataSaida", 1 => "Data Saída");
$arrItens_padrao[] = array(0 => "notas", 1 => "Notas");
$arrItens_padrao[] = array(0 => "motivo", 1 => "Motivo(s)");
$arrItens_padrao[] = array(0 => "dataRetorno", 1 => "Data Retorno");

//OPCIONAL




?>

<fieldset>
  <legend>Filtros</legend>
  
	<div class="menu_interno"> 
   
<!--		<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/cadastro.php";?>', 'click', '#bt');" /> 
		
		<img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="Histórico de excluídos" 
	  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/historico.php";?>', 'click', '#bt');" />
	-->  
	</div>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
      
       <p><strong>Campos</strong></p>
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
                    Cliente:<input type="text" name="nome" id="nome" list="nomeList">
                    <datalist id="nomeList">
                    </datalist>    
                </p>
            <p>
            Selecione critério:
            <label>
            Data Retorno:
            <input type="radio" id="dataRS" name="dataRS"  value="1"/>
            </label>
            <label>
            Data Saida:
             <input type="radio" id="dataRS" name="dataRS"  value="2" checked="checked"/>
            </label>
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
   
      <p>    
         <label>Empresa:</label>
            <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select> 
          </p>
           <p>
      <label>Qual área deve entrar em contato?</label>
      <input type="radio" name="area" id="area" value="0" checked/>Comercial
      <input type="radio" name="area" id="area" value="1" />Coordenação
      </p>    
          <p>
          <label>Idiomas</label>
    <?php echo $Idioma->selectIdiomaSelect();?>
        </p>
        
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="geraRel()"  >Buscar</button>
        <!--filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_RELAT."comercial/include/resourceHTML/retorno.php"?>', '', '#lista_res')"-->
      </div>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Retorno cliente pessoa física</legend>
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
   
   function geraRel(){
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
	postForm_relatorio('img_form_Grupos', 'sel_lista_padrao', 'form_filtra_Grupos', '<?php echo CAMINHO_RELAT."comercial/include/resourceHTML/retorno.php"?>', '#lista_res')
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

$('#idGerente').attr('onchange', 'buscar()');
//$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
//grupos();
ativarForm();
</script>
