<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
echo $grafico->TabelaGraficoPSA($gerente, $where);