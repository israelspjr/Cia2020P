<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Relatorio = new Relatorio();
$idIntegrante = $_REQUEST['idIntegranteGrupo'];
$rsNotas = $Relatorio->MediasProvas($idIntegrante);
?>
<div class="conteudo_nivel">
    <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<fieldset>
  <legend>Médias das Provas</legend>
    <div class="lista">
    <table id="tb_lista_notas" class="registros">
      <thead>
        <tr>
          <th>Prova</th>
          <th>Data prevista</th>
          <th>Data da Aplicação</th>
          <th>Média</th>
       </tr>
      </thead>
      <tbody>
       <?php
            foreach($rsNotas as $valor):
        ?>
            <tr>
                <td><?=$valor['nomeProva']?></td>
                <td><?=Uteis::exibirData($valor['dataPrevistaInicial'])?></td>
                <td><?=Uteis::exibirData($valor['dataAplicacao'])?></td>
                <td><?=round($valor['notaProva'], 2)?></td>
            </tr>
        <?php        
             endforeach;                       
       ?> 
      </tbody>
      <tfoot>
        <tr>
         <th>Prova</th>
          <th>Data prevista</th>
          <th>Data da Aplicação</th>
          <th>Média</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>

<script>
tabelaDataTable('tb_lista_notas', 'simples');
</script>
</div>