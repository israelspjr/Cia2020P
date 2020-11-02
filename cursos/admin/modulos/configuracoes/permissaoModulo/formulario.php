<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PermissaoModulo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Funcionario.class.php");


$PermissaoModulo = new PermissaoModulo();
$Funcionario = new Funcionario();

$idFuncionario = $_REQUEST["id"]
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Permissão de acesso aos módulos</legend>
    <p><strong><?php echo $Funcionario->getNome($idFuncionario)?></strong> 
    <input type="checkbox" name="tudo" id="tudo" value="1" onchange="marcaTudo('#tudo')" />(marcar/desmarcar tudo)</p>
    <form id="form_PermissaoModulo" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario?>" />
      <?php echo $PermissaoModulo->selectPermissaoModuloSelect($idFuncionario) ?>
      <p>
        <button class="button blue" 
        onclick="postForm('form_PermissaoModulo', '<?php echo CAMINHO_MODULO."configuracoes/permissaoModulo/grava.php?id=".$idPermissaoModulo?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

function marcaTudo(obj){
	if( $(obj).is(':checked') ){
		$('#form_PermissaoModulo input[type=checkbox]').prop('checked', true);
	}else{
		$('#form_PermissaoModulo input[type=checkbox]').prop('checked', false);
	}
}

function selectTree(obj){
	
	var $obj = $(obj);		
	var pai = $obj.attr('pai');
	var val = $obj.val()
		
	if($obj.is(':checked')){
			
		for(var x=1; x>0; x++){
			pai = $('input:checkbox[value='+pai+']').prop('checked', true).attr('pai');
			if(pai == '' || pai == undefined) break;		
		}
		
	}else{

		if( $('input:checkbox[pai='+pai+']').length > 0 || $('input:checkbox[pai='+pai+']:checked').length == 0 ){
			
			var filho, procurar, i, cont = 0;
			var filho_aux = [val];
		
			for(var x=1; x>0; x++){			
				
				if(filho_aux.length == 0){
					
					procurar = '';			
					for(i = 0; i < filho.length; i++){
						procurar += ',[value='+filho[i]+']';
					}
					
					if(procurar != ''){
						procurar = procurar.substring(1,(procurar.length));
						$('input:checkbox'+procurar).each(function(){
							$(this).prop('checked', false);
						});
					}
					break;
					
				}else{
					
					procurar = '';			
					for(i = 0; i < filho_aux.length; i++){
						procurar += ',[pai='+filho_aux[i]+']';
					}
					if(procurar != '') procurar = procurar.substring(1,(procurar.length));

					filho = filho_aux;
					
				}
				
				filho_aux = [];
				$('input:checkbox'+procurar).each(function(){
					filho_aux[cont++] = $(this).prop('checked', false).val();
				});
				cont = 0;
				//alert('1 - '+filho+' - '+filho_aux);
			}
		}
	}
}

</script> 
