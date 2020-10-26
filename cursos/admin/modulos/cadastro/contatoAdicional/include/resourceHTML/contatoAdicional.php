<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ContatoAdicional = new ContatoAdicional();	

$param = "idClientePf=$idClientePf";
$param .= "&idClientePj=$idClientePj";
$param .= "&idProfessor=$idProfessor";
$param .= "&idFuncionario=$idFuncionario";
$param .= "&idProposta=$idProposta";
if($idProposta){
  $tabela = "tb_lista_Intermediario_Proposta";
}else{
  $tabela = "tb_lista_contatoAdicional";
}
?>

<fieldset>
   <legend><?php if($idProposta!=''){?> Intermediário Proposta<?php }else{ ?>Contatos adicionais<?php }?></legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."form/contatoAdicional.php?$param"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" /> </div>
  <div class="lista">
    <table id="<?php echo $tabela;?>" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ContatoAdicional->selectContatoAdicionalTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('<?php echo $tabela;?>', 'simples');</script> 
