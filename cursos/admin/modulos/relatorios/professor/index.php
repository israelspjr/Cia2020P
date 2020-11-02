<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$idioma = new Idioma();
$Professor = new Professor();
$arrItens = array();
$clientepj = new ClientePj();
$Pais = new Pais();
$CertificadoCurso = new CertificadoCurso();


//PADRÃO

$arrItens_padrao[] = array(0 => "nome", 1 => "Nome");
$arrItens_padrao[] = array(0 => "tipoDoc", 1 => "Tipo de documento");
$arrItens_padrao[] = array(0 => "documentoUnico", 1 => "Documento único");
$arrItens_padrao[] = array(0 => "rg", 1 => "RG");
$arrItens_padrao[] = array(0 => "inativo", 1 => "Status");
$arrItens_padrao[] = array(0 => "telefone", 1 => "Telefone");
$arrItens_padrao[] = array(0 => "endereco", 1 => "Endereço");
$arrItens_padrao[] = array(0 => "nivel", 1 => "Nivel");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma");
$arrItens_padrao[] = array(0 => "sotaque", 1 => "Sotaque");

//OPCIONAL
$arrItens_opcional[] = array(0 => "nivelF", 1 => "Fluência");
$arrItens_opcional[] = array(0 => "formacao", 1 => "Formação");
$arrItens_opcional[] = array(0 => "nomeExibicao", 1 => "Nome para exibição");
$arrItens_opcional[] = array(0 => "candidato", 1 => "Contratado");
$arrItens_opcional[] = array(0 => "sexo", 1 => "Sexo");
$arrItens_opcional[] = array(0 => "dataNascimento", 1 => "Data de nascimento");
$arrItens_opcional[] = array(0 => "estadoCivil", 1 => "Estado civil");
$arrItens_opcional[] = array(0 => "dataContratacao", 1 => "Data de contratação");
$arrItens_opcional[] = array(0 => "inss", 1 => "INSS");
$arrItens_opcional[] = array(0 => "ccm", 1 => "CCM");
$arrItens_opcional[] = array(0 => "otimaPerformance", 1 => "Ótima performance");
$arrItens_opcional[] = array(0 => "altaPerformance", 1 => "Alta performance");
$arrItens_opcional[] = array(0 => "vetado", 1 => "Vetado");
$arrItens_opcional[] = array(0 => "indisponivel", 1 => "Indisponível");
$arrItens_opcional[] = array(0 => "pais", 1 => "País");
$arrItens_opcional[] = array(0 => "valorHora", 1 => "Valor hora");

$rsTipoEnderecoVirtual = $TipoEnderecoVirtual->selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsTipoEnderecoVirtual as $valor) $arrItens_opcional[] = array(0 => $valor['tipo'], 1 => $valor['tipo']);

?>

<fieldset>
  <legend>Relatório de Professores</legend>
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
      
  <!--    <p><strong>Filtros</strong></p>
      <div class="linha-inteira">-->
        <div class="esquerda">
          <p>
              <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" value = "1" />
              Professores que não desejam receber email<br />
          </p>
          <p>
              <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" value = "0" />
              Não mostrar professores que não desejam receber email<br />
          </p>
          <p>
                <input type="radio" name="status" id="status" value = "0" checked />Ativo <br />
                <input type="radio" name="status" id="status" value = "1" />Inativos <br /> 
                <input type="radio" name="status" id="status" value = "" /> Ambos <br />          
        </p>
          <p>
            <input type="radio" name="comGrupo" id="comGrupo" value = "1" /> Com Grupos <br /> 
            <input type="radio" name="comGrupo" id="comGrupo" value = "0" /> Sem Grupos <br /> 
            <input type="radio" name="comGrupo" id="comGrupo" value = "" checked /> Ambos  <br />            
        </p>
        
         <p>
            <input type="radio" name="vetado" id="vetado" value = "1" /> Vetado <br /> 
            <input type="radio" name="vetado" id="vetado" value = "0" /> não vetado <br /> 
            <input type="radio" name="vetado" id="vetado" value = "" checked /> Ambos  <br />            
        </p>
         <p>
            <input type="checkbox" name="contratado" id="contratado" value = "1" checked /> Contratado  <br />
            <input type="checkbox" name="candidato" id="candidato" value = "0" /> Candidato  <br />                    
        </p>
        <p>
            <input type="checkbox" name="otima" id="otima" value = "1"  /> Ótima Performance  <br />
            <input type="checkbox" name="alta" id="alta" value = "1" /> Alta Performance <br />                    
        </p>
         <p>
                <label><input type="checkbox" value="1" id="excluido" name="excluido"/>Somente excluido</label>
                </p>
                
                  </p>    
          
        
        </div>
        <div class="direita">
        	<p>
       <label>Filtrar por professor e trazer nome e email de alunos vinculados</label>
       <?php echo $Professor->selectProfessorSelect(); ?>
       </p>
        <p>
          <label>Empresas Ativas:</label>
          <input type="radio" name="status" id="status" value="0" onchange="buscar();" checked="checked">Ativo &nbsp;
          <input type="radio" name="status" id="status" value="1" onchange="buscar();">Inativo &nbsp;
          <input type="radio" name="status" id="status" value="-"  onchange="buscar();">Ambos      
        </p>
        
          <p>
          <label>Empresa:</label>
          <!--<?php echo $clientepj->selectClientePjSelect("","",$and);?>-->
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
         
        <p>
        <label>Idioma: </label>
			<?php echo $idioma->selectIdiomaSelect();?>

        </p>
         <p>
          	<label>Nível do Idioma: </label>
          		<select name="nivelF" id="nivelF">
                	<option value="" >Selecione</option>
          			<option value="1" >Fluente</option>
          			<option value="2" >Nativo</option>
          			<option value="3" >Avançado</option>
          			<option value="4" >Intermediário</option>
          			<option value="5" >Básico</option>
          		</select>
          </p>
          <p>
          <label>Nivel Linguisatico:</label>
           <?php
          $nivel = new NivelLinguistico();
          echo $nivel->selectNivelLinguisticoSelectMult("", 0);
         ?>  
        </p>
        <p>
         <label >Sotaque:</label>
				<p>
				<select id="idSotaqueIdiomaProfessor" name="idSotaqueIdiomaProfessor">	
                <option value="-">Selecione o Idioma primeiro</option>  
                </select>
				</p>
                
                     <p>
          <label for="Pais"> Curso de formação:(Utilizar esse sobrescreve qualquer outro filtro acima)</label>
          <?php echo $CertificadoCurso->selectCertificadoCursoSelect("",""," WHERE formacao = 1"); ?>
   
          </p>    
        </div>
        <p>
        <label>Data contratação de:</label>
        <input type="text" class="data" id="dataContratacao1" name="dataContratacao1"  />
        
          <label>Data contratação até:</label>
        <input type="text" class="data" id="dataContratacao2" name="dataContratacao2"  />
        </p>
        
         <p>
				<label for="terceiros">Terceirizado</label>
				<input type="checkbox" name="terceiro" id="terceiro" value="1" />
				</p>
                
          <p>
          <label for="Pais"> Vivência em Pais:(Utilizar esse sobrescreve qualquer outro filtro acima)</label>
          <?php echo $Pais->selectPaisSelect(); ?>
   
          
	      
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
<!--<script type="text/javascript" src="<?php // echo CAMINHO_RELAT?>rel.js" ></script>-->
<script> 
ativarForm();
function geraRel(){
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
	postForm_relatorio('img_form_rel', 'sel_lista_padrao', 'form_rel', '<?php echo CAMINHO_RELAT."professor/include/resourceHTML/professor.php"?>', '#res_rel')
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
//  grupos();
}

	
function sotaque(){
  var ididioma, retorno;
  $("#idSotaqueIdiomaProfessor").empty();
  $("#idSotaqueIdiomaProfessor").append("<option value='-'>Selecione</option>");
//  status = $("#statusG:checked").val();
  ididioma = $( "#idIdioma" ).val();
 // gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_sotaque.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{ididioma:ididioma}   
  });
  retorno.done(function( html ) {
    $( "#idSotaqueIdiomaProfessor" ).append( html );
  });
  
}

$('#idIdioma').attr('onchange', 'sotaque()');
buscar();
</script> 