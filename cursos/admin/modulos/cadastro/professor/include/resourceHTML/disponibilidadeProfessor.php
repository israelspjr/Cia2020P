<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisponibilidadeProfessor = new DisponibilidadeProfessor();

$idProfessor = $_GET['id'];

?>

<fieldset>
  <legend>Disponibilidade do professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/disponibilidadeProfessor.php?idProfessor=".$idProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/disponibilidadeProfessor.php?id=".$idProfessor?>', '#div_disponibilidade_professor');" />
 <?php
 $caminhoAbrir = CAMINHO_CAD."professor/include/acao/disponibilidadeProfessorDeletar.php";
 $caminhoAtualizar = CAMINHO_CAD."professor/include/resourceHTML/disponibilidadeProfessor.php?id=".$idProfessor;
 
 $onclick = " onclick=\"deletaRegistro('" . $caminhoAbrir . "', '" . $idProfessor . "', '$caminhoAtualizar', '#div_disponibilidade_professor')\" ";
 ?>
<a <?php echo $onclick ?>> <img src="<?php echo CAMINHO_IMG."excluir.png";?>" title="Excluir todas as disponibilidades" /></a>
<!-- 
  <a onclick="deletaRegistro('<?php //echo CAMINHO_CAD."professor/include/acao/disponibilidadeProfessor.php"', ' "idProfessor=".$idProfessor."&acao=tudo"?>', '<?php //echo CAMINHO_CAD."professor/include/resourceHTML/disponibilidadeProfessor.php?id=".$idProfessor?>')"> -->
    </div>
  <div class="lista" >Legenda das cores de fundo: 
  <font color="#FF0000" style="font-size:16px">Indisponível</font>&nbsp;&nbsp;<font color="#00FF00" style="font-size:16px;font-weight:bold">Disponível somente presencial</font>&nbsp;&nbsp;<font color="#660000" style="font-size:16px">Disponível somente On-line</font>&nbsp;&nbsp;<font color="#0000FF" style="font-size:16px">Disponível On-line e Presencial</font> <br />
  Legenda das cores dos grupos:
  <font color="#00FF00" style="font-size:16px;font-weight:bold">Curso Presencial</font>&nbsp;&nbsp;<font color="#660000" style="font-size:16px">Curso On-line</font>
  
    <table id="tb_lista_disponibilidadeProfessor" width="100%">
      <thead>
        <tr>
          <th>Horário</th>
          <th>Domingo</th>
          <th>Segunda-feira</th>
          <th>Terça-feira</th>
          <th>Quarta-feira</th>
          <th>Quinta-feira</th>
          <th>Sexta-feira</th>
          <th>Sábado</th>
        </tr>
      </thead>
      <tbody>
        <?php 
		echo $DisponibilidadeProfessor->selectDisponibilidadeProfessorTr(CAMINHO_CAD."professor/include/", CAMINHO_CAD."professor/include/resourceHTML/disponibilidadeProfessor.php?id=".$idProfessor, "#div_disponibilidade_professor", $idProfessor);
		?>
      </tbody>
      <tfoot>
        <tr>
          <th>Horário</th>
          <th>Domingo</th>
          <th>Segunda-feira</th>
          <th>Terça-feira</th>
          <th>Quarta-feira</th>
          <th>Quinta-feira</th>
          <th>Sexta-feira</th>
          <th>Sábado</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> 
tabelaDataTable('tb_lista_disponibilidadeProfessor', 'simples');
</script> 
