<?php
class Aprovacao extends Database {
	// class attributes
	var $idProposta;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProposta = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProposta($value) {
		$this -> idProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function selectAprovacaoTr($where = "", $apenasLinha = false) {

		$sql = "SELECT SQL_CACHE idProposta, representante_idRepresentante, dataAprovacao FROM proposta AS P 
		INNER JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = P.statusAprovacao_idStatusAprovacao AND ST.idStatusAprovacao = 2 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$cont = 0;

			$PlanoAcao = new PlanoAcao();
			$Representante = new Representante();
			$AgendamentoVisita = new AgendamentoVisita();

			$caminhoAtualizar = CAMINHO_VENDAS . "aprovacao/index.php";

			while ($valor = mysqli_fetch_array($result)) {

				$idProposta = $valor['idProposta'];
				$idRepresentante = $valor['representante_idRepresentante'];
				$ordenar = strtotime($valor['dataAprovacao']);

				$rsPlanoAcao = $PlanoAcao -> selectPlanoAcao(" WHERE (dataExclusao IS NULL OR dataExclusao='') AND proposta_idProposta = " . $idProposta);

				$caminhoAtualizar2 = "$caminhoAtualizar?tr=1&idProposta=" . $idProposta . "&ordem=" . ($cont++);
				if ($apenasLinha)
					$caminhoAtualizar2 = "$caminhoAtualizar?tr=1&idProposta=" . $idProposta . "&ordem=" . ($apenasLinha);

				$agendamentoVisita = $AgendamentoVisita -> selectAgendamentoVisita(" WHERE proposta_idProposta = " . $idProposta);

				$representante = "";
				$novoPA = "";

				if ($idRepresentante) {
					$representante = $Representante -> getNome($idRepresentante);
					if (!$agendamentoVisita) {
						$representante = "<div onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "aprovacao/include/form/representante.php?id=" . $idProposta . "', '$caminhoAtualizar2', 'tr')\" >$representante</div>";
					}

					$novoPA = "<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Novo plano de ação\" 
					onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?idProposta=" . $idProposta . "', '$caminhoAtualizar2', 'tr')\" ></center>";

				} else {

					$representante = "<center><img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Atribuir representante\" 
					onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "aprovacao/include/form/representante.php?id=" . $idProposta . "', '$caminhoAtualizar2', 'tr')\"></center>";
				}

				//AGENDAMENTO DE VISITAS
				$visita = "";
				if ($idRepresentante) {

					$idAgendamentoVisita = $agendamentoVisita[0]['idAgendamentoVisita'];
					$realizada = $agendamentoVisita[0]['realizada'];

					$visita .= "<center><img onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "aprovacao/include/form/agendamentoVisita.php?idProposta=" . $idProposta . "&id=$idAgendamentoVisita', '$caminhoAtualizar2', 'tr')\" src=\"" . CAMINHO_IMG;

					if ($agendamentoVisita) {
						if ($realizada) {
							$visita .= "ativo.png\" title=\"Visita realizada\" ";
						} else {
							$visita .= "none.png\" title=\"Visita agendada\" ";
						}
					} else {
						$visita .= "pa.png\" title=\"Agendar visita\" ";
					}

					$visita .= " />";
				}

				//PLANOS DE AÇÃO
				$pas = "";
				$aprovacoes = "";
				if ($rsPlanoAcao) {
					foreach ($rsPlanoAcao as $valorPlanoAcao) {

						$idPlanoAcao = $valorPlanoAcao['idPlanoAcao'];
						$idStatusAprovacao = $valorPlanoAcao['statusAprovacao_idStatusAprovacao'];

						$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/cadastro.php?id=" . $idPlanoAcao . "', '$caminhoAtualizar2', 'tr')\" ";

						$pas .= "<div class=\"destacaLinha\" ref=\"" . $idPlanoAcao . "\" $onclick >
						Plano de ação: <strong>" . $valorPlanoAcao['idPlanoAcao'] . "</strong>
						</div>";

						$aprovacoes .= "<div class=\"destacaLinha\" ref=\"" . $idPlanoAcao . "\" $onclick >" . Uteis::exibirStatusAprovacao($idStatusAprovacao) . "</div>";
                        $novoPA = "";
					}
				}
				if ($apenasLinha) {

					$col = array();

					$col[] = $ordenar;
					$col[] = $idProposta;
					$col[] = $representante;
					$col[] = $novoPA;
					$col[] = $visita;
					$col[] = $pas;
					$col[] = $aprovacoes;

					$html = $col;
					break;

				} else {

					$html .= "<tr>";

					//ORDENAR POR
					$html .= "<td>" . $ordenar . "</td>";

					//PROPOSTA
					$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/cadastro.php?id=" . $idProposta . "', '$caminhoAtualizar2', 'tr')\" >" . $idProposta . "</td>";

					//REPRESENTANTE
					$html .= "<td>" . $representante . "</td>";

					//NOVO PA
					$html .= "<td align=\"center\">" . $novoPA . "</td>";

					//VISITAS
					$html .= "<td align=\"center\">" . $visita . "</td>";

					//PA
					$html .= "<td align=\"center\">" . $pas . "</td>";

					//APROVACOES
					$html .= "<td align=\"center\">" . $aprovacoes . "</td>";

					$html .= "</tr>";

				}

			}
		}

		return $html;
	}

}
?>