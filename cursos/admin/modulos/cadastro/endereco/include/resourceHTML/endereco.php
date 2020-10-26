<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Endereco = new Endereco();
if($idClientePf!="")
$param = "idClientePf=$idClientePf";
if($idClientePj!="")
$param = "idClientePj=$idClientePj";
if($idProfessor!="")
$param = "idProfessor=$idProfessor";
if($idFuncionario!="")
$param = "idFuncionario=$idFuncionario";
if($idPlanoAcao!="")
$param = "idPlanoAcao=$idPlanoAcao";

?>

<fieldset>
  <legend>Endereço</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Novo endereço" 
  onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."form/endereco.php?".$param?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" /> </div>
  <div class="lista">
    <table id="tb_lista_endereco<?php echo $_GET['id']?>" class="registros">
      <thead>
        <tr>
          <th>Endereço</th>
          <th>Mapa</th>
          <th>Pricipal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Endereco->selectEnderecoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Endereço</th>
          <th>Mapa</th>
          <th>Pricipal</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_endereco<?php echo $_GET['id']?>', 'simples');</script> 
