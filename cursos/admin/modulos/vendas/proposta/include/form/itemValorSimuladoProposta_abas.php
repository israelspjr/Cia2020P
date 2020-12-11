<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idItemValorSimuladoProposta = $_GET['id'];
$valorSimuladoPropostaIdValorSimuladoProposta = $_GET['idValorSimuladoProposta'];
?>

<div id="abas">
  <div id="aba_cadastro_ItemValorSimuladoProposta" divExibir="div_cadastro_ItemValorSimuladoProposta" class="aba_interna ativa">Valores</div>
  <?php if($idItemValorSimuladoProposta != "" && $idItemValorSimuladoProposta > 0){ ?>
  	<div id="aba_cadastro_produtoAdicional" divExibir="div_lista_ProdutoAdicional" class="aba_interna">Produtos adicionais</div>
  <?php } ?>
</div>

<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

<div class="conteudo_nivel">
	<div id="div_cadastro_ItemValorSimuladoProposta" class="div_aba_interna">
    <?php 
	require_once "itemValorSimuladoProposta.php"?>
    </div>
    <?php if($idItemValorSimuladoProposta != "" && $idItemValorSimuladoProposta > 0){ ?>
  	  <div id="div_lista_ProdutoAdicional" style="display:none;" class="div_aba_interna">
      <?php require_once '../resourceHTML/produtoAdicional.php';?>
      </div>
    <?php } ?>
</div>
