<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$ItemProva = new ItenProva();
$Gerente = new Gerente();
$mes = date('m');
$ano = date('Y');

$IdClientePj = $_SESSION['idClientePj_SS'];

$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma");
$arrItens_padrao[] = array(0 => "nivel", 1 => "Nível");
$arrItens_padrao[] = array(0 => "inicioEstagio", 1 => "Inicio do estágio");
$arrItens_padrao[] = array(0 => "prova", 1 => "Prova");
$arrItens_padrao[] = array(0 => "itemProva", 1 => "Item da Prova");
$arrItens_padrao[] = array(0 => "nota", 1 => "Nota");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome do Professor");
$arrItens_padrao[] = array(0 => "dataAplicacao", 1 => "Data de Aplicação");
$arrItens_padrao[] = array(0 => "obsProva", 1 => "ObsProva");
$arrItens_padrao[] = array(0 => "anexo", 1 => "Anexo");

//Padrão Opcional
$arrItens_opcional[] = array(0 => "material", 1 => "Material *");
$arrItens_opcional[] = array(0 => "unidadeFinal", 1 => "Unidade Final *");
$arrItens_opcional[] = array(0 => "unidadeAtual", 1 => "Unidade Atual *");
$arrItens_opcional[] = array(0 => "obsMaterial", 1 => "ObsMaterial *");
$arrItens_opcional[] = array(0 => "novaData", 1 => "Nova data Prevista de aplicação");
$arrItens_opcional[] = array(0 => "dataPrevista", 1 => "Data Prevista de aplicação");
?>

<fieldset>
  <legend>Relatório de avaliações</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_rel" 
onclick="abrirFormulario('div_form_rel', 'img_form_rel');" />
  <div class="agrupa" id="div_form_rel">
    <form id="form_rel" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Tipo de relatório</strong></p>
      <div class="linha-inteira">
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
          <label><input type="radio" name="tipoRel" id="tipoRel_item" value="item"  onchange="Oculta(0)" />Por item</label>
          <label><input type="radio" name="tipoRel" id="tipoRel_media" value="media" checked="checked" onchange="Oculta(1)" />Média final</label>
        </p>
      </div>
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
          <p id="item">
               <?php echo $ItemProva->selectItenProvaSelectMulti("","","")?>             
          </p>  
          <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
        </div>
        <div class="direita">
         <p>
            <label>Grupo:</label>
            <?php echo $Grupo->selectGrupoSelectMult("",""," inner join grupoClientePj as GC on G.idGrupo = GC.grupo_idGrupo where GC.clientePj_idClientePj = ".$IdClientePj."")?></p>
        <p>
            <label><input type="radio" name="status" value="1" checked/>Aplicadas</label><br />
            <label><input type="radio" name="status" value="2" />Agendadas</label><br />
            <label><input type="radio" name="status" value="3" />Ambas</label>
        </p>
        </div>
      </div>
      <div class="linha-inteira" >
        <button class="bBlue" id="geraRel2" onclick="geraRel()"> Gerar relatório</button>        
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
    postForm_relatorio('img_form_Grupos', '', 'form_rel', '<?php echo "modulos/provas/provaR.php"?>', 'res_rel');

}
function Oculta(val){
    if(val==0){
        $("#item").show();
    }else{
        $("#item").hide();
    }
} 
Oculta(1);

function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = 0;
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
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
}

</script> 