<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Modulo = new Modulo();
$Funcionario = new Funcionario();

$idModulo = $_GET['id'];	

if($idModulo!='' && $idModulo>0){
	
	$valorModulo = $Modulo->selectModuloSimples(' WHERE idModulo='.$idModulo);
	
	$idModulo = $valorModulo[0]['idModulo'];
	$descricao = $valorModulo[0]['nome'];
	$link = $valorModulo[0]['link'];
	$ordem = $valorModulo[0]['ordem'];
	$inativo = $valorModulo[0]['inativo'];
	$modulo_idModulo = $valorModulo[0]['modulo_idModulo'];
	$admin = $valorModulo[0]['admin'];
	$aluno = $valorModulo[0]['aluno'];
	$preAluno = $valorModulo[0]['preAluno'];
	$rh = $valorModulo[0]['rh'];
	$professor = $valorModulo[0]['professor'];
	$candidato = $valorModulo[0]['candidato'];

}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  <div class="esquerda">
  <fieldset>
  
    <legend>Modulo</legend>
    <form id="form_Modulo" class="validate" method="post" action="" onsubmit="return false" >
         
      <p>
      <label>Módulo-PAI</label>
      <?php echo $Modulo->selectModuloSelectS("",$modulo_idModulo,"");?>
      </p>               
        <p>
          <label>Descrição:</label>          
          <input type="text" name="descricao" id="descricao"  class="required" onsubmit="return false" value="<?php echo $descricao?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoModulo-->
        </p>
        <p>
        <label>Link</label>
        <input type="text" id="link" name="link" class="required" value="<?php echo $link?>"/>
        <span class="placeholder">Campo Obrigatório</span>
        </p>
        <p>
        <label>Ordem</label>
        <input type="text" id="ordem" name="ordem"  class="required" value="<?php echo $ordem?>"/>
        <span class="placeholder">Campo Obrigatório</span>
        </p>
        
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="admin" id="admin" value="1" <?php if($admin != 0){ ?> checked="checked" <?php } ?> />
            Admin</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="aluno" id="aluno" value="1" <?php if($aluno != 0){ ?> checked="checked" <?php } ?> />
            Aluno</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="preAluno" id="preAluno" value="1" <?php if($preAluno != 0){ ?> checked="checked" <?php } ?> />
            Pré-Aluno</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="rh" id="rh" value="1" <?php if($rh != 0){ ?> checked="checked" <?php } ?> />
            RH</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="professor" id="professor" value="1" <?php if($professor != 0){ ?> checked="checked" <?php } ?> />
            Professor</label>
        </p>
         <p>
          <label>
            <input type="checkbox" name="candidato" id="candidato" value="1" <?php if($candidato != 0){ ?> checked="checked" <?php } ?> />
            Candidato</label>
        </p>
          <p>
        <button class="button blue" onclick="postForm('form_Modulo', '<?php echo CAMINHO_CAD?>modulo/grava.php?id=<?php echo $idModulo?>')">Salvar</button>
        
      </p>
  </form>
 
          </div>
<div class="direita">
   <form id="form_ModuloPermissao" class="validate" method="post" action="" onsubmit="return false" >

	<legend>Permissão de funcionário </legend>
    <?php echo $Funcionario->selectFuncionarioCheckbox($idModulo);  ?>
  
     <p>
        <button class="button blue" onclick="postForm('form_ModuloPermissao', '<?php echo CAMINHO_CAD?>modulo/gravaPermissao.php?id=<?php echo $idModulo?>')">Salvar</button>
        
      </p>
  </form>
  
  </div>
    
   
  </fieldset>
  
</div>

<script>ativarForm();</script> 