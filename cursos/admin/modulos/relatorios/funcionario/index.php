<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoEnderecoVirtual.class.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "nome", 1 => "Nome");
$arrItens_padrao[] = array(0 => "tipoDoc", 1 => "Tipo de documento");
$arrItens_padrao[] = array(0 => "documentoUnico", 1 => "Documento único");
$arrItens_padrao[] = array(0 => "rg", 1 => "RG");
$arrItens_padrao[] = array(0 => "inativo", 1 => "Status");
$arrItens_padrao[] = array(0 => "admicao", 1 => "Data de admição");
$arrItens_padrao[] = array(0 => "demicao", 1 => "Data de demição");
$arrItens_padrao[] = array(0 => "telefone", 1 => "Telefone");
$arrItens_padrao[] = array(0 => "endereco", 1 => "Endereço");

//OPCIONAL
$arrItens_opcional[] = array(0 => "nomeExibicao", 1 => "Nome para exibição");
$arrItens_opcional[] = array(0 => "sexo", 1 => "Sexo");
$arrItens_opcional[] = array(0 => "dataNascimento", 1 => "Data de nascimento");
$arrItens_opcional[] = array(0 => "estadoCivil", 1 => "Estado civil");
$arrItens_opcional[] = array(0 => "pais", 1 => "País");
$arrItens_opcional[] = array(0 => "cargo", 1 => "Cargo");

$rsTipoEnderecoVirtual = $TipoEnderecoVirtual->selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsTipoEnderecoVirtual as $valor) $arrItens_opcional[] = array(0 => $valor['tipo'], 1 => $valor['tipo']);

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
        <img src="<?php echo CAMINHO_IMG."menos.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
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
        <img src="<?php echo CAMINHO_IMG."mais.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
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
          
        </div>
        <div class="direita">

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
<!--<script type="text/javascript" src="<?php // echo CAMINHO_RELAT?>rel.js" ></script>-->
<script> 
ativarForm();
function geraRel(){
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
	postForm_relatorio('img_form_rel', 'sel_lista_padrao', 'form_rel', '<?php echo CAMINHO_RELAT."funcionario/include/resourceHTML/funcionario.php"?>', '#res_rel')
}	
</script> 