<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$OcorrenciaFF = new OcorrenciaFF();	
$IntegranteGrupo = new IntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Relatorio = new Relatorio();

$caminhoAbrir = "modulos/ff/grupoMes.php";
$caminhoAtualizar = "modulos/ff/index.php";
$ondeAtualiza = "#centro";	

$grafico = $_REQUEST['grafico'];

$rs = $IntegranteGrupo->getidIntegranteGrupo($_SESSION['idClientePf_SS'],"",date("Y-m-d"));
$rs3 = explode(",",$rs);
$nivelTexto = array();
foreach ($rs3 as $valor) {
$idPAG = 	$IntegranteGrupo->integrantePAG($valor);

$valorPAG = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE inativo = 0 AND idPlanoAcaoGrupo = ".$idPAG);
$valorIntegranteGrupo = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valorPAG[0]['idPlanoAcaoGrupo']." AND clientePf_idClientePf = ".$_SESSION['idClientePf_SS']);
$idIntegranteGrupo = $valorIntegranteGrupo[0]['idIntegranteGrupo'];
$horasProgama = $PlanoAcao->getHorasPrograma($valorPAG[0]['planoAcao_idPlanoAcao']);
$idioma = $PlanoAcaoGrupo->getIdIdioma($idPAG);

$nivel = $PlanoAcaoGrupo->getIdNivel($idPAG);
$nivel = str_replace("Nível","",$nivel);

$inativo = $PlanoAcaoGrupo->getInativo($idPAG);

$nivelTexto[$idioma][$nivel]['inativo'] = [$inativo];
$nivelTexto[$idioma]['horas'] = [$horasProgama];
$nivelTexto[$idioma]['idIntegranteGrupo'] = [$idIntegranteGrupo];	

}

$html = "";
$html2 = "";
//	Uteis::pr($nivelTexto);
if ($grafico != 1) {
if ($nivelTexto[4]) { 
//Inglês
$html .= "<div style=\"text-align:center\">Estes são os módulos do curso de Inglês. Veja o caminho que você já percorreu e o que vai percorrer</div>";

	if (($nivelTexto[4][13]) || ($nivelTexto[4][39])) {
		$style="";
		if ($nivelTexto[4][13]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1a</button> ";
	} else {
		$html .= "<button $style>A1a</button> ";	
	}
	
	if (($nivelTexto[4][14]) || ($nivelTexto[4][40])) {
		$style="";
		if ($nivelTexto[4][14]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1b</button> ";
	} else {
		$html .= "<button>A1b</button> ";	
	}
	
	if (($nivelTexto[4][15]) || ($nivelTexto[4][41])) {
		$style="";
		if ($nivelTexto[4][15]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1c</button> ";
	} else {
		$html .= "<button >A1c</button> ";	
	}
	
	if (($nivelTexto[4][16]) || ($nivelTexto[4][42])) {
		$style="";
		if ($nivelTexto[4][16]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1d</button> ";
	} else {
		$html .= "<button>A1d</button> ";	
	}

	if (($nivelTexto[4][17]) || ($nivelTexto[4][47])) {
		$style="";
		if ($nivelTexto[4][17]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
			$html2 = $nivelTexto[4][17]['horas'][0];
		}
		
			$html .= "<button $style>A2a</button> ";
	} else {
		$html .= "<button>A2a</button> ";	
	}
	
	if (($nivelTexto[4][18]) || ($nivelTexto[4][48])) {
		$style="";
		if ($nivelTexto[4][18]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A2b</button> ";
	} else {
		$html .= "<button>A2b</button> ";	
	}

if (($nivelTexto[4][19]) || ($nivelTexto[4][49])) {
		$style="";
		if ($nivelTexto[4][19]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A2c</button> ";
} else {
		$html .= "<button>A2c</button> ";	
	}

if (($nivelTexto[4][20]) || ($nivelTexto[4][50])) {		
		$style="";
		if ($nivelTexto[4][20]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A2d</button> ";
		} else {
		$html .= "<button>A2d</button> ";	
	}

if (($nivelTexto[4][21]) || ($nivelTexto[4][43])) {		
		$style="";
		if ($nivelTexto[4][21]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1a</button> ";
		} else {
		$html .= "<button>B1a</button> ";	
	}

if (($nivelTexto[4][22]) || ($nivelTexto[4][44])) {		
		$style="";
		if ($nivelTexto[4][22]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1b</button> ";
		} else {
		$html .= "<button>B1b</button> ";	
	}

if (($nivelTexto[4][23]) || ($nivelTexto[4][45])) {			
		$style="";
		if ($nivelTexto[4][23]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1c</button> ";
		} else {
		$html .= "<button>B1c</button> ";	
	}
	
	if (($nivelTexto[4][24]) || ($nivelTexto[4][46])) {	
		$style="";
		if ($nivelTexto[4][24]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1d</button> ";
	} else {
		$html .= "<button>B1d</button> ";	
	}
	
		if (($nivelTexto[4][25]) || ($nivelTexto[4][51])) {	
	
		$style="";

	if ($nivelTexto[4][25]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>B2a</button> ";
	} else {
		$html .= "<button>B2a</button> ";	
	}

		if (($nivelTexto[4][26]) || ($nivelTexto[4][52])) {	
		
		$style="";
		if ($nivelTexto[4][26]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2b</button> ";
	} else {
		$html .= "<button>B2b</button> ";	
	}
	
	if (($nivelTexto[4][27]) || ($nivelTexto[4][53])) {			
		$style="";
		if ($nivelTexto[4][27]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2c</button> ";
	} else {
		$html .= "<button>B2c</button> ";	
	}	
	
		if (($nivelTexto[4][28]) || ($nivelTexto[4][54])) {	
		$style="";
		if ($nivelTexto[4][28]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2d</button> ";
	} else {
		$html .= "<button>B2d</button> ";	
	}	
	
	if (($nivelTexto[4][29]) || ($nivelTexto[4][55])) {	
		$style="";
		if ($nivelTexto[4][29]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1a</button> ";
	} else {
		$html .= "<button>C1a</button> ";	
	}
	
	if (($nivelTexto[4][30]) || ($nivelTexto[4][56])) {	
		$style="";
		if ($nivelTexto[4][30]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1b</button> ";
	} else {
		$html .= "<button>C1b</button> ";	
	}	
	
	if (($nivelTexto[4][31]) || ($nivelTexto[4][57])) {	
		$style="";
		if ($nivelTexto[4][31]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1c</button> ";
		} else {
		$html .= "<button>C1c</button> ";	
	}
	
	if (($nivelTexto[4][32]) || ($nivelTexto[4][58])) {		
		
		$style="";
		if ($nivelTexto[4][32]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1d</button> ";
		} else {
		$html .= "<button>C1d</button> ";	
	}	
	
	if (($nivelTexto[4][12]) || ($nivelTexto[4][59])) {	
		$style="";
		if ($nivelTexto[4][12]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C2</button> ";
			} else {
		$html .= "<button>C2</button> ";	
	}
	$rs = $Relatorio->relatorioFrequencia_mensal(" WHERE G.inativo = 0 AND CPF.inativo = 0
        AND IG.idIntegranteGrupo IN ( ".$nivelTexto[4]['idIntegranteGrupo'][0].")", "", "", "", 1 );
	$html2a = Uteis::exibirHoras($rs[0]['horaRealizadaAluno']); 
	$html2 = Uteis::exibirHoras($nivelTexto[4]['horas'][0]);
}

if ($nivelTexto[3]) { //Espanhol
$html .= "<div style=\"text-align:center\">Estes são os módulos do curso de Espanhol. Veja o caminho que você já percorreu e o que vai percorrer</div>";

	if (($nivelTexto[3][13]) || ($nivelTexto[3][39])) {
		$style="";
		if ($nivelTexto[3][13]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A1a</button> ";
	} else {
		$html .= "<button $style>A1a</button> ";	
	}
	
	if (($nivelTexto[3][14]) || ($nivelTexto[3][40])) {
		$style="";
		if ($nivelTexto[3][14]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A1b</button> ";
	} else {
		$html .= "<button>A1b</button> ";	
	}
	
	if (($nivelTexto[3][15]) || ($nivelTexto[3][41])) {
		$style="";
		if ($nivelTexto[3][15]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A1c</button> ";
	} else {
		$html .= "<button >A1c</button> ";	
	}

	if (($nivelTexto[3][17]) || ($nivelTexto[3][47])) {
		$style="";
		if ($nivelTexto[3][17]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2a</button> ";
	} else {
		$html .= "<button>A2a</button> ";	
	}
	
	if (($nivelTexto[3][18]) || ($nivelTexto[3][48])) {
		$style="";
		if ($nivelTexto[3][18]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2b</button> ";
	} else {
		$html .= "<button>A2b</button> ";	
	}
if (($nivelTexto[3][19]) || ($nivelTexto[3][49])) {
		$style="";
		if ($nivelTexto[3][19]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2c</button> ";
} else {
		$html .= "<button>A2c</button> ";	
	}

if (($nivelTexto[3][21]) || ($nivelTexto[3][43])) {		
		$style="";
		if ($nivelTexto[3][21]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1a</button> ";
		} else {
		$html .= "<button>B1a</button> ";	
	}

if (($nivelTexto[3][22]) || ($nivelTexto[3][44])) {		
		$style="";
		if ($nivelTexto[3][22]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1b</button> ";
		} else {
		$html .= "<button>B1b</button> ";	
	}

if (($nivelTexto[3][23]) || ($nivelTexto[3][45])) {			
		$style="";
		if ($nivelTexto[3][23]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1c</button> ";
		} else {
		$html .= "<button>B1c</button> ";	
	}
	
	if (($nivelTexto[3][24]) || ($nivelTexto[3][46])) {	
		$style="";
		if ($nivelTexto[3][24]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1d</button> ";
	} else {
		$html .= "<button>B1d</button> ";	
	}
	
		if (($nivelTexto[3][25]) || ($nivelTexto[3][51])) {	
	
		$style="";

	if ($nivelTexto[3][25]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2a</button> ";
	} else {
		$html .= "<button>B2a</button> ";	
	}

		if (($nivelTexto[3][26]) || ($nivelTexto[3][52])) {	
		
		$style="";
		if ($nivelTexto[3][26]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2b</button> ";
	} else {
		$html .= "<button>B2b</button> ";	
	}

	if (($nivelTexto[3][29]) || ($nivelTexto[3][55])) {	
		$style="";
		if ($nivelTexto[3][29]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1a</button> ";
	} else {
		$html .= "<button>C1a</button> ";	
	}
	
	if (($nivelTexto[3][30]) || ($nivelTexto[3][56])) {	
		$style="";
		if ($nivelTexto[3][30]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1b</button> ";
	} else {
		$html .= "<button>C1b</button> ";	
	}	

	if (($nivelTexto[3][12]) || ($nivelTexto[3][59])) {	
		$style="";
		if ($nivelTexto[3][12]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C2</button> ";
			} else {
		$html .= "<button>C2</button> ";	
	}
		$rs2 = $Relatorio->relatorioFrequencia_mensal(" WHERE G.inativo = 0 AND CPF.inativo = 0
        AND IG.idIntegranteGrupo IN ( ".$nivelTexto[3]['idIntegranteGrupo'][0].")", "", "", "", 1 );
	$html3a = Uteis::exibirHoras($rs2[0]['horaRealizadaAluno']); 

	$html3 = Uteis::exibirHoras($nivelTexto[3]['horas'][0]);
}


if ($nivelTexto[6]) { //Francês
$html .= "<div style=\"text-align:center\">Estes são os módulos do curso de Francês. Veja o caminho que você já percorreu e o que vai percorrer</div>";

	if (($nivelTexto[6][13]) || ($nivelTexto[6][39])) {
		$style="";
		if ($nivelTexto[6][13]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1a</button> ";
	} else {
		$html .= "<button $style>A1a</button> ";	
	}
	
	if (($nivelTexto[6][14]) || ($nivelTexto[6][40])) {
		$style="";
		if ($nivelTexto[6][14]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A1b</button> ";
	} else {
		$html .= "<button>A1b</button> ";	
	}
	
	if (($nivelTexto[6][15]) || ($nivelTexto[6][41])) {
		$style="";
		if ($nivelTexto[6][15]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A1c</button> ";
	} else {
		$html .= "<button >A1c</button> ";	
	}
	
	if (($nivelTexto[6][17]) || ($nivelTexto[6][47])) {
		$style="";
		if ($nivelTexto[6][17]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2a</button> ";
	} else {
		$html .= "<button>A2a</button> ";	
	}
	
	if (($nivelTexto[6][18]) || ($nivelTexto[6][48])) {
		$style="";
		if ($nivelTexto[6][18]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2b</button> ";
	} else {
		$html .= "<button>A2b</button> ";	
	}

if (($nivelTexto[6][19]) || ($nivelTexto[6][49])) {
		$style="";
		if ($nivelTexto[6][19]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A2c</button> ";
} else {
		$html .= "<button>A2c</button> ";	
	}

if (($nivelTexto[6][21]) || ($nivelTexto[6][43])) {		
		$style="";
		if ($nivelTexto[6][21]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1a</button> ";
		} else {
		$html .= "<button>B1a</button> ";	
	}

if (($nivelTexto[6][22]) || ($nivelTexto[6][44])) {		
		$style="";
		if ($nivelTexto[6][22]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1b</button> ";
		} else {
		$html .= "<button>B1b</button> ";	
	}


if (($nivelTexto[6][23]) || ($nivelTexto[6][45])) {			
		$style="";
		if ($nivelTexto[6][23]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1c</button> ";
		} else {
		$html .= "<button>B1c</button> ";	
	}

if (($nivelTexto[6][25]) || ($nivelTexto[6][51])) {	
	
		$style="";

	if ($nivelTexto[6][25]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2a</button> ";
	} else {
		$html .= "<button>B2a</button> ";	
	}

		if (($nivelTexto[6][26]) || ($nivelTexto[6][52])) {	
		
		$style="";
		if ($nivelTexto[6][26]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2b</button> ";
	} else {
		$html .= "<button>B2b</button> ";	
	}
	
	if (($nivelTexto[6][27]) || ($nivelTexto[6][53])) {			
		$style="";
		if ($nivelTexto[6][27]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2c</button> ";
	} else {
		$html .= "<button>B2c</button> ";	
	}	

if (($nivelTexto[6][29]) || ($nivelTexto[6][55])) {	
		$style="";
		if ($nivelTexto[6][29]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1a</button> ";
	} else {
		$html .= "<button>C1a</button> ";	
	}
	
	if (($nivelTexto[6][30]) || ($nivelTexto[6][56])) {	
		$style="";
		if ($nivelTexto[6][30]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1b</button> ";
	} else {
		$html .= "<button>C1b</button> ";	
	}	
	
	if (($nivelTexto[6][31]) || ($nivelTexto[6][57])) {	
		$style="";
		if ($nivelTexto[6][31]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C1c</button> ";
		} else {
		$html .= "<button>C1c</button> ";	
	}
	
if (($nivelTexto[6][12]) || ($nivelTexto[6][59])) {	
		$style="";
		if ($nivelTexto[6][12]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C2</button> ";
			} else {
		$html .= "<button>C2</button> ";	
	}
		$rs3 = $Relatorio->relatorioFrequencia_mensal(" WHERE G.inativo = 0 AND CPF.inativo = 0
        AND IG.idIntegranteGrupo IN ( ".$nivelTexto[6]['idIntegranteGrupo'][0].")", "", "", "", 1 );
	$html4a = Uteis::exibirHoras($rs3[0]['horaRealizadaAluno']); 

	$html4 = Uteis::exibirHoras($nivelTexto[6]['horas'][0]);
}


if ($nivelTexto[5]) { //Português
$html .= "<div style=\"text-align:center\">Estes são os módulos do curso de Português. Veja o caminho que você já percorreu e o que vai percorrer</div>";

	if (($nivelTexto[5][1]) || ($nivelTexto[5][60])) {
		$style="";
		if ($nivelTexto[5][1]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>A1</button> ";
	} else {
		$html .= "<button $style>A1</button> ";	
	}
	
if (($nivelTexto[5][2]) || ($nivelTexto[5][61])) {
		$style="";
		if ($nivelTexto[5][2]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>A2</button> ";
	} else {
		$html .= "<button>A2</button> ";	
	}
	
if (($nivelTexto[5][3]) || ($nivelTexto[5][62])) {
		$style="";
		if ($nivelTexto[5][3]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B1</button> ";
	} else {
		$html .= "<button >B1</button> ";	
	}

if (($nivelTexto[5][4]) || ($nivelTexto[5][63])) {
		$style="";
		if ($nivelTexto[5]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>B2</button> ";
	} else {
		$html .= "<button>B2</button> ";	
	}
	
if (($nivelTexto[5][5]) || ($nivelTexto[5][64])) {
		$style="";
		if ($nivelTexto[5][5]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
		
			$html .= "<button $style>C1</button> ";
	} else {
		$html .= "<button>C1</button> ";	
	}

	if (($nivelTexto[5][12]) || ($nivelTexto[5][59])) {	
		$style="";
		if ($nivelTexto[5][12]['inativo'][0] == 1) {
			$style="class=\"\"";	
		} else {
			$style="class=\"bBlue\"";
		}
			$html .= "<button $style>C2</button> ";
			} else {
		$html .= "<button>C2</button> ";	
	}
		$rs4 = $Relatorio->relatorioFrequencia_mensal(" WHERE G.inativo = 0 AND CPF.inativo = 0
        AND IG.idIntegranteGrupo IN ( ".$nivelTexto[5]['idIntegranteGrupo'][0].")", "", "", "", 1 );
	$html5a = Uteis::exibirHoras($rs4[0]['horaRealizadaAluno']); 

	$html5 = Uteis::exibirHoras($nivelTexto[5]['horas'][0]);
}


?>

<fieldset>
  <legend>Gráfico de desenvolvimento</legend>
</fieldset>

<?php echo $html."<br>"; 
if ($nivelTexto[4]) {  

$ass = $nivelTexto[4]['horas'][0]/60;

$totalM  = $rs[0]['horaRealizadaAluno']/60;

?>

<div><p>&nbsp;</p></div>
<div class="row">
			<div class="col-md-10" >
				<!--<div class="panel panel-default">-->
					<div class="panel-heading" style="text-align:center;line-height:18px">Veja quantas horas de estudo ao vivo são necessárias para conclusão do seu módulo atual e quantas você já realizou<?php echo "<br><strong>Total assistido:</strong>".$html2a." | <strong>Total do módulo:</strong>".$html2; ?> </div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas" width="450px" height=120></canvas>
						</div>
                        
					<!--</div>-->
				</div>
			</div>
            </div>
<script>
new Chart(document.getElementById("canvas"), {
"type": "horizontalBar",
"data": {
"labels": ["Total do Módulo", "Total Assistido"],
"datasets": [{
"label": "",
"data": [<?php echo $ass?>, <?php echo $totalM?>],
"fill": false,
"backgroundColor": ["rgba(255, 99, 132, 0.2)", "#84286b",
"rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
"rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
],
"borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
"rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
],
"borderWidth": 1
}]
},
"options": {
"scales": {
"xAxes": [{
"ticks": {
"beginAtZero": true
}
}]
}
}
});
</script>

<?php } 

if ($nivelTexto[3]) {
	
	$ass2 = $nivelTexto[3]['horas'][0]/60;

$totalM2  = $rs2[0]['horaRealizadaAluno']/60;

?>

<div><p>&nbsp;</p></div>
<div class="row">
			<div class="col-md-10" >
			<!--	<div class="panel panel-default">
				-->	<div class="panel-heading" style="text-align:center;line-height:18px">Veja quantas horas de estudo ao vivo são necessárias para conclusão do seu módulo atual e quantas você já realizou<?php echo "<br><strong>Total assistido:</strong>".$html3a." | <strong>Total do módulo:</strong>".$html3; ?> </div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas2" width="450px" height=120></canvas>
						</div>
                        
					</div>
		<!--		</div>
		-->	</div>
            </div>
<script>
new Chart(document.getElementById("canvas2"), {
"type": "horizontalBar",
"data": {
"labels": ["Total do Módulo", "Total Assistido"],
"datasets": [{
"label": "",
"data": [<?php echo $ass2?>, <?php echo $totalM2?>],
"fill": false,
"backgroundColor": ["rgba(255, 99, 132, 0.2)", "#84286b",
"rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
"rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
],
"borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
"rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
],
"borderWidth": 1
}]
},
"options": {
"scales": {
"xAxes": [{
"ticks": {
"beginAtZero": true
}
}]
}
}
});
</script>


<?php } 

if ($nivelTexto[6]) {
	
		$ass3 = $nivelTexto[6]['horas'][0]/60;

$totalM3  = $rs3[0]['horaRealizadaAluno']/60;

?>

<div><p>&nbsp;</p></div>
<div class="row">
			<div class="col-md-10" >
			<!--	<div class="panel panel-default">
				-->	<div class="panel-heading" style="text-align:center;line-height:18px">Veja quantas horas de estudo ao vivo são necessárias para conclusão do seu módulo atual e quantas você já realizou<?php echo "<br><strong>Total assistido:</strong>".$html4a." | <strong>Total do módulo:</strong>".$html4; ?> </div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas3" width="450px" height=120></canvas>
						</div>
                        
					</div>
		<!--		</div>
		-->	</div>
            </div>
<script>
new Chart(document.getElementById("canvas3"), {
"type": "horizontalBar",
"data": {
"labels": ["Total do Módulo", "Total Assistido"],
"datasets": [{
"label": "",
"data": [<?php echo $ass3?>, <?php echo $totalM3?>],
"fill": false,
"backgroundColor": ["rgba(255, 99, 132, 0.2)", "#84286b",
"rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
"rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
],
"borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
"rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
],
"borderWidth": 1
}]
},
"options": {
"scales": {
"xAxes": [{
"ticks": {
"beginAtZero": true
}
}]
}
}
});
</script>

<?php } 

if ($nivelTexto[5]) {
	
		$ass4 = $nivelTexto[5]['horas'][0]/60;

$totalM4  = $rs4[0]['horaRealizadaAluno']/60;

?>

<div><p>&nbsp;</p></div>
<div class="row">
			<div class="col-md-10" >
			<!--	<div class="panel panel-default">
			-->		<div class="panel-heading" style="text-align:center;line-height:18px">Veja quantas horas de estudo ao vivo são necessárias para conclusão do seu módulo atual e quantas você já realizou<?php echo "<br><strong>Total assistido:</strong>".$html5a." | <strong>Total do módulo:</strong>".$html5; ?> </div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas4" width="450px" height=120></canvas>
						</div>
                        
					</div>
		<!--		</div>
		-->	</div>
            </div>
<script>
new Chart(document.getElementById("canvas4"), {
"type": "horizontalBar",
"data": {
"labels": ["Total do Módulo", "Total Assistido"],
"datasets": [{
"label": "",
"data": [<?php echo $ass4?>, <?php echo $totalM4?>],
"fill": false,
"backgroundColor": ["rgba(255, 99, 132, 0.2)", "#84286b",
"rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
"rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
],
"borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
"rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
],
"borderWidth": 1
}]
},
"options": {
"scales": {
"xAxes": [{
"ticks": {
"beginAtZero": true
}
}]
}
}
});
</script>


<?php } 
} ?>

<div>&nbsp;</div>
<fieldset>
  <legend>Folha de frequência</legend>
</fieldset>
<?php require_once("../grupos.php")?>

<p> <img src="<?php echo CAMINHO_IMG."mais.png"?>" title="Abrir/fechar" id="img_ocorr" 
    onclick="abrirFormulario('div_ocorr', 'img_ocorr');" /><strong>Descrição das ocorrências da Folha de freqêuncia</strong>
	<div class="agrupa" id="div_ocorr" style="display:none;padding:1em;"> <?php echo $OcorrenciaFF->selectOcorrenciaFF_legenda();?> </div>
</p>
