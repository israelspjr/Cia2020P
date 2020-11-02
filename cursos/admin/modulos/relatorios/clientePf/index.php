<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$ClientePj = new ClientePj();
$Grupo = new Grupo();
$Idioma = new Idioma();
$Gerente = new Gerente();

$mes = date('m');
$ano = date('Y');
$anoI = "2010";

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "nome", 1 => "Nome");
$arrItens_padrao[] = array(0 => "tipoDoc", 1 => "Tipo de documento");
$arrItens_padrao[] = array(0 => "documentoUnico", 1 => "Documento único");
$arrItens_padrao[] = array(0 => "rg", 1 => "RG");
$arrItens_padrao[] = array(0 => "inativo", 1 => "Status");
$arrItens_padrao[] = array(0 => "empresa", 1 => "Empresa");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma");
$arrItens_padrao[] = array(0 => "telefone", 1 => "Telefone");
$arrItens_padrao[] = array(0 => "endereco", 1 => "Endereço");


//OPCIONAL
$arrItens_opcional[] = array(0 => "nomeExibicao", 1 => "Nome para exibição");
$arrItens_opcional[] = array(0 => "tipoCliente", 1 => "Tipo de Cliente");
$arrItens_opcional[] = array(0 => "dataEntrada", 1 => "Data Entrada");
$arrItens_opcional[] = array(0 => "nivelInicial", 1 => "Nivel Inicial");
$arrItens_opcional[] = array(0 => "nivelAtual", 1 => "Nivel Atual");

$arrItens_opcional[] = array(0 => "sexo", 1 => "Sexo");
$arrItens_opcional[] = array(0 => "dataNascimento", 1 => "Data de nascimento");
$arrItens_opcional[] = array(0 => "estadoCivil", 1 => "Estado civil");
$arrItens_opcional[] = array(0 => "pais", 1 => "País");
$arrItens_opcional[] = array(0 => "cargo", 1 => "Cargo");
$arrItens_opcional[] = array(0 => "naoReceberEmail", 1 => "Não receber e-mail");
$arrItens_opcional[] = array(0 => "dataSaida", 1 => "Data Saída do grupo");
$rsTipoEnderecoVirtual = $TipoEnderecoVirtual->selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0");
foreach($rsTipoEnderecoVirtual as $valor){
    if($valor['tipo']=="E-mail"){
        $arrItens_padrao[] = array(0 => $valor['tipo'], 1 => $valor['tipo']);
    }else{
        $arrItens_opcional[] = array(0 => $valor['tipo'], 1 => $valor['tipo']);
    }
}

?>

<fieldset>
  <legend>Relatório de Cliente p. física</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_rel" 
onclick="abrirFormulario('div_form_rel', 'img_form_rel');" />
  <div class="agrupa" id="div_form_rel">
    <form id="form_rel" class="validate" method="post" action="" onsubmit="return false" >
      
      <p><strong>Campos</strong></p>
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
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
        <p>
        <label>Gerente:</label>
        <?php echo $Gerente->selectGerenteSelect(" WHERE inativo = 0"); ?> 
        </p>
        <p>    
         <label>Empresa:</label>
            <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>     
          <p>
            <label>Grupo:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
            <p>
            <label>Tipo curso:</label>
            <select id="tipoCurso" name="tipoCurso">
            	<option value="-">Selecione</option>
                <option value="0">Presencial</option>
                <option value="1">On-line</option>
                <option value="2">Skype</option>
                <option value="3">ChatClub</option>
            </select>
         	</p>
        <p>    
         <label>Com grupo:</label>
            <input type="radio" id="comgrupo" name="comgrupo" value="1" />          
        </p>
         <p>    
         <label>Sem Grupo:</label>
            <input type="radio" id="comgrupo" name="comgrupo" value="2" />          
        </p>
        <p>    
         <label>Ambos:</label>
            <input type="radio" id="comgrupo" name="comgrupo" value="3" />          
        </p>
      
         
        </div>
        <div class="direita">
        
             <p>
          <strong>Data de entrada no Grupo: </strong>
        
        <select name="mes_ini" id="mes_ini" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        
        <select name="ano_ini" id="ano_ini" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($anoI == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
            <p>
          <strong>Até data saída do grupo:</strong> 
        
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
          <p>
          <label>Ativo:</label><input type="radio" name="status" id="status" value = "0" checked>
          <label>Inativo:</label><input type="radio" name="status" id="status" value = "1">
          <label>Ambos:</label><input type="radio" name="status" id="status" value = "">
          </p>  
           <p>
            <label>Idioma:</label>
            <?php echo $Idioma->selectIdiomaSelectMult("", "", " AND disponivelAula = 1")?></p>
            <p>
                <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" value = "1" />
                Alunos que não desejam receber email<br />
            </p>
            <p>
                <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" value = "0" />
                Não mostrar alunos que não desejam receber email<br />
            </p>
        </div>
      </div>
      <div class="linha-inteira" >
        <button class="button blue" onclick="geraRel()">
        Gerar relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<!--<script type="text/javascript" src="<?php //echo CAMINHO_RELAT?>rel.js" ></script>-->
<script> 

function geraRel(){
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
	postForm_relatorio('img_form_rel', 'sel_lista_padrao', 'form_rel', '<?php echo CAMINHO_RELAT."clientePf/include/resourceHTML/clientePf.php"?>', '#res_rel')
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
function Enviar(){
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_REL."grupo/index.php"?>', '', '#lista_Grupos')
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
grupos();
ativarForm();
</script> 
