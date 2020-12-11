<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();
$ClientePj = new ClientePj();
$Gestor = new Gestor();
$StatusAprovacao = new StatusAprovacao();
$Empresa = new ClientePj();
?>
<fieldset>
  <legend>Filtros</legend>
  <div class="menu_interno"> 
  
	  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro"  
	onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/cadastro.php";?>', '', '#bt');" /> 
	
		<img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="Histórico de excluídos" 
	  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/historico.php";?>', '', '#bt');" /> 
  
  </div>
  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
         <p>
          <label>Id Proposta:</label>          
          <input type="text" name="idProposta" id="idProposta" class="numeric" />         
          <span class="placeholder"></span>
        </p>       
        <p>
          <label>Data de abertura:</label>
          de
          <input type="text" name="dataCadastro" id="dataCadastro" class="data" value="" onblur="buscar()" />
          a
          <input type="text" name="dataCadastro2" id="dataCadastro2" class="data" value="" onblur="buscar()" />
          <span class="placeholder"></span></p>
        <p>
          <label>Idioma:</label>
          <?php echo $Idioma->selectIdiomaSelect("", "", " AND disponivelAula = 1")?></p>
        <p>
          <label>Empresa:</label>
         <?php 
            echo $Empresa->selectClientePjSelect("","");
         ?>
        </p>
      </div>
      <div class="direita">
        <p>
          <label>Data de aprovação:</label>
          de
          <input type="text" name="dataAprovacao" id="dataAprovacao" class="data" value="" />
          a
          <input type="text" name="dataAprovacao2" id="dataAprovacao2" class="data" value="" />
          <span class="placeholder"></span></p>
        <p>
          <label>Gestor:</label>
          <?php echo $Gestor->selectGestorSelect("","","");?>
          </p>    
        <p>    
          <label>Status da aprovação:</label>
          <?php echo $StatusAprovacao->selectStatusAprovacaoSelectMult("", "", " WHERE inativo = 0")?></p>
      </div>
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_VENDAS."proposta/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Propostas</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>
ativarForm();
</script>
