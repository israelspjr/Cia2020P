<!-- JQuery -->
<script src="<?php echo CAMINHO_CFG?>js/jquery.min.js" language="javascript" type="text/javascript"></script>
<script src="<?php echo CAMINHO_CFG?>js/login.js" language="javascript" type="text/javascript"></script>

<!-- JQuery Ui -->
<script src="<?php echo CAMINHO_CFG?>js/jquery-ui.min.js" language="javascript" type="text/javascript"></script>

<!-- Editor -->
<!--<script src="<?php echo CAMINHO_CFG?>tinymce/tinymce.min.js" language="javascript" type="text/javascript" ></script>-->
<script src="<?php echo CAMINHO_CFG?>tinymce2/tinymce.min.js" language="javascript" type="text/javascript" ></script>

<!-- data Tables -->
<script src="<?php echo CAMINHO_CFG?>js/jquery.dataTables.min.js" language="javascript" type="text/javascript" ></script>
<script src="<?php echo CAMINHO_CFG?>js/dataTables.fixedHeader.min.js" language="javascript" type="text/javascript" ></script>

<!-- Atualização para sortear data -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.7/sorting/datetime-moment.js"></script>

<!-- Funções form -->
<script src="<?php echo CAMINHO_CFG?>js/form.js" language="javascript" type="text/javascript"></script>

<!-- Funções uteis -->
<script src="<?php echo CAMINHO_CFG?>js/uteis.js" language="javascript" type="text/javascript"></script>

<!-- Eventos gerais-->
<script src="<?php echo CAMINHO_CFG?>js/eventos.js" language="javascript" type="text/javascript"></script>

<!-- Mask-->
<script src="<?php echo CAMINHO_CFG?>/js/jquery.mask.min.js" type="text/javascript"></script>

<!-- Validação -->
<script src="<?php echo CAMINHO_CFG?>js/jquery.validate.js" language="javascript" type="text/javascript"></script>

<!-- PRINT ELEMENT-->
<script src="<?php echo CAMINHO_CFG?>js/jquery.printArea.js" language="javascript" type="text/javascript"></script>
<!-- Carregar Google APi-->
<script type="text/javascript" src="<?php echo CAMINHO_CFG?>js/jsapi.js"></script>

<script type="text/javascript">
	$(document).ready(function(){		
		eventAbas();			
		eventFechar();			
		eventRolarParaTopo();
		eventValidateForm();
		eventFocoForm();
		eventMostrarTitle();
	});//.tooltip();
</script>