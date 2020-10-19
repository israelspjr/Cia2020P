<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$Gerente = new Gerente();
$ClientePj = new ClientePj();

$nomeCliente = $ClientePj->getNome($_SESSION['idClientePj_SS']);

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "dataReferencia", 1 => "Data da pesquisa");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome Professor");

$rsPsaProfessor = $PsaProfessor->selectPsaProfessor(" WHERE excluido = 0 AND inativo = 0 AND tipo = 4");
foreach($rsPsaProfessor as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);
$arrItens_padrao[] = array(0 => "gestaoCurso", 1 => "GESTÃO DO CURSO");
$arrItens_padrao[] = array(0 => "qualidadeAula", 1 => "QUALIDADE DA AULA");
$arrItens_padrao[] = array(0 => "resultadoCurso", 1 => "RESULTADO DO CURSO");
$arrItens_padrao[] = array(0 => "compromisso", 1 => "COMPROMISSO COM O APRENDIZADO");
$arrItens_padrao[] = array(0 => "nps", 1 => "NPS - Net Promoter Score");

$dataAtual = date("Y-m-d");
?>

<fieldset>
  <legend>Relatório de PSA</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    
     
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
          <label>Empresa:</label>  
          <?php echo $nomeCliente ?>       
         </p>
        <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
         <p>
            <label>Data da pesquisa:</label><br>
            de
            <input type="date" name="dataReferencia" id="dataReferencia" class="required" value="2018-09-01" />
            a
            <input type="date" name="dataReferencia2" id="dataReferencia2" class="required" value="<?php echo $dataAtual?>" />
          </p>
        </div>
        <div class="esquerda">
        <p>  <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="10" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select></p>
        
          <p>
          <Label>Mostrar comentários? </Label>
          <input type="checkbox" value="1" id="mostrarComentarios" name="mostrarComentarios" />
          </p>
        </div>
     <!--   <div class="direita">
         <p>
          <Label>Mostrar PSA Pendentes </Label>
          <input type="checkbox" value="1" id="psaPendentes" name="psaPendentes" />
          </p> </div>
      </div>-->
      
      <div class="linha-inteira" >
        <button class="bBlue" onclick="fecharMenu(0);geraRel()">
        Gerar relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> 

function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = 0;
  clientePj = <?php echo $_SESSION['idClientePj_SS']?>; //$( "#clientePj_idClientePj option:selected" ).val();
  retorno = $.ajax({
    url:"<?php echo "/cursos/portais/modulos/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );    
  });
//  professor();
}
grupos();
//professor();

function geraRel(){
addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo "modulos/psa/psaR.php"?>', 'res_rel');
}
//ativarForm();	
</script> 