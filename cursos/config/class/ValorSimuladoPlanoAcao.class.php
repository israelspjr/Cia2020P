<?php
class ValorSimuladoPlanoAcao extends Database {
    // class attributes
    var $idValorSimuladoPlanoAcao;
    var $planoAcaoIdPlanoAcao;
    var $valorHora;
    var $valorDescontoHora;
    var $validadeDesconto;
    var $horasPorAula;
    var $frequenciaSemanalAula;
    var $cargaHorariaFixaMensal;
    var $horaNaoGeraFf;
    var $obs;
    var $tipo;
    var $modalidadeIdModalidade;

    // constructor
    function __construct() {
        parent::__construct();
        $this -> idValorSimuladoPlanoAcao = "NULL";
        $this -> planoAcaoIdPlanoAcao = "NULL";
        $this -> valorHora = "NULL";
        $this -> valorDescontoHora = "NULL";
        $this -> validadeDesconto = "NULL";
        $this -> horasPorAula = "NULL";
        $this -> frequenciaSemanalAula = "NULL";
        $this -> cargaHorariaFixaMensal = "NULL";
        $this -> horaNaoGeraFf = "NULL";
        $this -> obs = "NULL";
        $this -> tipo = "NULL";
        $this -> modalidadeIdModalidade = "NULL";

    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdValorSimuladoPlanoAcao($value) {
        $this -> idValorSimuladoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPlanoAcaoIdPlanoAcao($value) {
        $this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setValorHora($value) {
        $this -> valorHora = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    function setValorDescontoHora($value) {
        $this -> valorDescontoHora = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
    }

    function setValidadeDesconto($value) {
        $this -> validadeDesconto = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setHorasPorAula($value) {
        $this -> horasPorAula = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setFrequenciaSemanalAula($value) {
        $this -> frequenciaSemanalAula = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setCargaHorariaFixaMensal($value) {
        $this -> cargaHorariaFixaMensal = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setHoraNaoGeraFf($value) {
        $this -> horaNaoGeraFf = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setTipo($value) {
        $this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setModalidadeIdModalidade($value) {
        $this -> modalidadeIdModalidade = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    /**
     * addValorSimuladoPlanoAcao() Function
     */
    function addValorSimuladoPlanoAcao() {
        $sql = "INSERT INTO valorSimuladoPlanoAcao (planoAcao_idPlanoAcao, valorHora, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo, modalidade_idModalidade) VALUES ($this->planoAcaoIdPlanoAcao, $this->valorHora, $this->valorDescontoHora, $this->validadeDesconto, $this->horasPorAula, $this->frequenciaSemanalAula, $this->cargaHorariaFixaMensal, $this->horaNaoGeraFf, $this->obs, $this->tipo, $this->modalidadeIdModalidade)";
        $result = $this -> query($sql, true);
        return $this -> connect;
    }

    /**
     * deleteValorSimuladoPlanoAcao() Function
     */
    function deleteValorSimuladoPlanoAcao() {

        $NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
        $where = " OR valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao IN (" . $this -> idValorSimuladoPlanoAcao . ")";
        $NaoFazAulaNestaSemanaPlanoAcao -> deleteNaoFazAulaNestaSemanaPlanoAcao($where);

        $ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
        $where = " OR valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao IN (" . $this -> idValorSimuladoPlanoAcao . ")";
        $ProdutoAdicionalValorSimuladoPlanoAcao -> deleteProdutoAdicionalValorSimuladoPlanoAcao($where);

        //DELETAR TODOS ITEN ASSOCIADOS
        $OpcaoDia = new OpcaoDia();
        $rs = $OpcaoDia -> selectOpcaoDia(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao IN( $this->idValorSimuladoPlanoAcao )");
        if ($rs) {
            foreach ($rs as $val) {
                $OpcaoDia -> setIdOpcao($val['idOpcao']);
                //$where = " OR valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao IN (".$this->idValorSimuladoPlanoAcao.")";
                $OpcaoDia -> deleteOpcaoDia();
            }
        }

        $sql = "DELETE FROM valorSimuladoPlanoAcao WHERE idValorSimuladoPlanoAcao = $this->idValorSimuladoPlanoAcao";
        $result = $this -> query($sql, true);
    }

    /**
     * updateFieldValorSimuladoPlanoAcao() Function
     */
    function updateFieldValorSimuladoPlanoAcao($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE valorSimuladoPlanoAcao SET " . $field . " = " . $value . " WHERE idValorSimuladoPlanoAcao = $this->idValorSimuladoPlanoAcao";
        $result = $this -> query($sql, true);
    }

    /**
     * updateValorSimuladoPlanoAcao() Function
     */
    function updateValorSimuladoPlanoAcao() {
        $sql = "UPDATE valorSimuladoPlanoAcao SET planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, valorHora = $this->valorHora, valorDescontoHora = $this->valorDescontoHora, validadeDesconto = $this->validadeDesconto, horasPorAula = $this->horasPorAula, frequenciaSemanalAula = $this->frequenciaSemanalAula, cargaHorariaFixaMensal = $this->cargaHorariaFixaMensal, horaNaoGeraFf = $this->horaNaoGeraFf, obs = $this->obs, tipo = $this->tipo, modalidade_idModalidade = $this->modalidadeIdModalidade WHERE idValorSimuladoPlanoAcao = $this->idValorSimuladoPlanoAcao";
     //echo $sql;
        //exit;
        $result = $this -> query($sql, true);
    }

    /**
     * selectValorSimuladoPlanoAcao() Function
     */
    function selectValorSimuladoPlanoAcao($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idValorSimuladoPlanoAcao, planoAcao_idPlanoAcao, valorHora, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo, modalidade_idModalidade FROM valorSimuladoPlanoAcao " . $where;
        return $this -> executeQuery($sql);
    }

    function selectValorSimuladoPlanoAcaoTr($where = "", $apenasVer) {
        $sql = "SELECT SQL_CACHE idValorSimuladoPlanoAcao, planoAcao_idPlanoAcao, valorHora, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo FROM valorSimuladoPlanoAcao " . $where;
        echo $sql;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            $NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();

            while ($valor = mysqli_fetch_array($result)) {
				
				if ($apenasVer != 1) {
				
                $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/include/form/valorSimulado.php?id=" . $valor['idValorSimuladoPlanoAcao'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/valorSimuladoPlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_valorSimuladoPlanoAcao')\" ";
				
				}

                $textoAdicional = $valor['valorDescontoHora'] ? " <font color=\"#FF0000\">(desconto de " . number_format($valor['valorDescontoHora'], 2, ',', '') . " por hora até " . Uteis::exibirData($valor['validadeDesconto']) . ")</font>" : "";

                $html .= "<tr >";

                $html .= "<td " . $onclick . ">R$ " . Uteis::formatarMoeda($valor['valorHora']) . $textoAdicional . "</td>";

                $horas = Uteis::exibirHoras($valor['horasPorAula']);

                $cargaHorariaFixaMensal = $valor['cargaHorariaFixaMensal'] ? " <font color=\"#FF0000\">(carga horária fixa de " . Uteis::exibirHoras($valor['cargaHorariaFixaMensal']) . ")</font>" : "";

                $html .= "<td $onclick >" . $horas . $cargaHorariaFixaMensal . "</td>";

                $freq = $valor['frequenciaSemanalAula'] ? $valor['frequenciaSemanalAula'] . " vez(es) na semana" : "";
                $semanas = $NaoFazAulaNestaSemanaPlanoAcao -> selectNaoFazAulaNestaSemanaPlanoAcao(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $valor['idValorSimuladoPlanoAcao']);
				Uteis::pr($semanas);
                $semanas = Uteis::arrayCampoEspecifico($semanas, 'semana');

                if ($semanas && $semanas[0] != "0") {
                    $freq .= " <font color=\"#FF0000\">(não fará aula na " . implode("ª, ", $semanas) . "ª semana de cada mês)</font>";
                }

                $html .= "<td $onclick >" . $freq . "</td>";

                $somaProdutosAdicionais = $this -> somaProdutosAdicionais($valor['idValorSimuladoPlanoAcao']);
                $padicionalDia = $somaProdutosAdicionais ? "R$ " . Uteis::formatarMoeda($somaProdutosAdicionais) : "";
                $html .= "<td $onclick >" . $padicionalDia . "</td>";
				
				$somaProdutosAdicionais = $this -> somaProdutosAdicionaisHora($valor['idValorSimuladoPlanoAcao']);
                $padicional = $somaProdutosAdicionais ? "R$ " . Uteis::formatarMoeda($somaProdutosAdicionais) : "";
                $html .= "<td $onclick >" . $padicional . "</td>";
				
				

                $tipo = ($valor['tipo']);

                if ($tipo == 'R')
                    $tipoDescricao = "Regular";
                else if ($tipo == 'T')
                    $tipoDescricao = "Total";
                else if ($tipo == 'E')
                    $tipoDescricao = "Exata";

                $html .= "<td>" . $tipoDescricao . "</td>";

                $valorTotal = $this -> calculoValorSimuladoPlanoAcao($valor['idValorSimuladoPlanoAcao']);

                if ($tipo == 'R')
                    $totalDescricao = "R$ " . $valorTotal . " por mês";
                else if ($tipo == 'T' || $tipo == 'E')
                    $totalDescricao = "Total de R$ " . $valorTotal;

                $html .= "<td $onclick >" . $totalDescricao . "</td>";

                $html .= "<td align=\"center\" >";
				
				if ($apenasVer != 1) {
				
				$html .= "<img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/valorSimuladoPlanoAcao.php', " . $valor['idValorSimuladoPlanoAcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/valorSimuladoPlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_valorSimuladoPlanoAcao')\">";
				}
				$html .= "</td>";
                $html .= "</tr>";

            }
        }
        return $html;
    }

    function listaValorSimuladoPlanoAcao() {

        $ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
        $ProdutoAdicional = new ProdutoAdicional();
        $NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();

        $where = " WHERE planoAcao_idPlanoAcao = " . $this -> planoAcaoIdPlanoAcao;
        $valorSimuladoPlanoAcao = $this -> selectValorSimuladoPlanoAcao($where);
        
        if ($valorSimuladoPlanoAcao) {

            for ($row = 0; $row < count($valorSimuladoPlanoAcao, 0); $row++) {

                $html .= "<p>";

                $idValorSimuladoPlanoAcao = $valorSimuladoPlanoAcao[$row]['idValorSimuladoPlanoAcao'];
                $valorDescontoHora = $valorSimuladoPlanoAcao[$row]['valorDescontoHora'];
                $validadeDesconto = $valorSimuladoPlanoAcao[$row]['validadeDesconto'];
                $valor = $valorSimuladoPlanoAcao[$row]['valorHora'];
                $tipo = $valorSimuladoPlanoAcao[$row]['tipo'];
                $horasPorAula = $valorSimuladoPlanoAcao[$row]['horasPorAula'];
                $frequenciaSemanalAula = $valorSimuladoPlanoAcao[$row]['frequenciaSemanalAula'];
                $cargaHorariaFixaMensal = $valorSimuladoPlanoAcao[$row]['cargaHorariaFixaMensal'];
                $valorTotal = $this -> calculoValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);

                $textoAdicional = $valorDescontoHora ? " com desconto de R$" . Uteis::formatarMoeda($valorDescontoHora) . " por hora até " . Uteis::exibirData($validadeDesconto) : "";

                //PRODUTO ADICONAL
                $valorProdutoAdicionalValorSimuladoPlanoAcao = $ProdutoAdicionalValorSimuladoPlanoAcao -> selectProdutoAdicionalValorSimuladoPlanoAcao(" WHERE ValorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $idValorSimuladoPlanoAcao);

                $valorProdutoAdicionalValorSimuladoPlanoAcao = implode(",", Uteis::arrayCampoEspecifico($valorProdutoAdicionalValorSimuladoPlanoAcao, 'produtoAdicional_idProdutoAdicional'));

                if ($valorProdutoAdicionalValorSimuladoPlanoAcao) {

                    $valorProdutoAdicional = $ProdutoAdicional -> selectProdutoAdicional(" WHERE idProdutoAdicional IN(" . $valorProdutoAdicionalValorSimuladoPlanoAcao . ")");

                    $textoAdicional .= ", mais adicional por hora <em>(";

                    for ($row2 = 0; $row2 < count($valorProdutoAdicional, 0); $row2++) {
                        $valorProduto = $valorProdutoAdicional[$row2]['valor'];
                        $nomeProduto = $valorProdutoAdicional[$row2]['nome'];
                        $textoAdicional .= ($row2 == 0 ? "" : ", ") . $nomeProduto . " - R$ " . Uteis::formatarMoeda($valorProduto);
                    }

                    $textoAdicional .= ")</em>";
                }

                if ($tipo == 'R') {

                    $tipoDescricao = " Valor hora de ";
                    $freq = $frequenciaSemanalAula ? $frequenciaSemanalAula . " vez(es) na semana " : "";

                    //caraga fixa
                    if ($cargaHorariaFixaMensal)
                        $freq .= ", com uma carga horária maxima de " . Uteis::exibirHoras($cargaHorariaFixaMensal) . " no mês";

                    //nao faz aula semanas
                    $semanas = $NaoFazAulaNestaSemanaPlanoAcao -> selectNaoFazAulaNestaSemanaPlanoAcao(" WHERE ValorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $idValorSimuladoPlanoAcao);
                    $semanas = Uteis::arrayCampoEspecifico($semanas, 'semana');

                    if ($semanas)
                        $freq .= ", não tendo aulas toda " . implode("ª, ", $semanas) . "ª semana de cada mês";

                    $textoAdicional .= ". Sendo " . Uteis::exibirHoras($horasPorAula) . " por aula " . $freq;
                    $periodoPgt = "por mês";

                    //total
                    $totalMes += $this -> calculoValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);

                } elseif ($tipo == 'T') {

                    $tipoDescricao = "Valor hora de ";
                    $textoAdicional .= ". Sendo um total de " . Uteis::exibirHoras($horasPorAula) . " de curso ";
                    $periodoPgt = "";

                    //total
                    $total += $this -> calculoValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);

                } elseif ($tipo == 'E') {
                    $tipoDescricao = "Valor total de ";
                    $textoAdicional .= ". Sendo um total de " . Uteis::exibirHoras($horasPorAula) . " de curso ";
                    $periodoPgt = "";

                    //total
                    $total += $this -> calculoValorSimuladoPlanoAcao($idValorSimuladoPlanoAcao);
                }

                $html .= $tipoDescricao . "R$ " . Uteis::formatarMoeda($valor) . $textoAdicional . ". Sub-total: R$ " . $valorTotal . " " . $periodoPgt . ".</p>";

            }
            
            //------------------------------------------------------------------------------------------------------------------------
            $html .= "<p><strong>";

            if ($total)
                $html .= "TOTAL FIXO: R$ " . Uteis::formatarMoeda($total);

            if  (($totalMes) && ($row == 1)) {
                $html .= "TOTAL POR MÊS: R$ " . Uteis::formatarMoeda($totalMes);
			}

            $html .= "</strong></p>";

        }

        return $html;

    }

    function calculoValorSimuladoPlanoAcao($id) {

        $where = " WHERE idValorSimuladoPlanoAcao =" . $id;

        $arrayValorSimuladoPlanoAcao = $this -> selectValorSimuladoPlanoAcao($where);

        $tipo = $arrayValorSimuladoPlanoAcao[0]['tipo'];

        $valor = $arrayValorSimuladoPlanoAcao[0]['valorHora'];
        //SOMA PRODUTOS ADICIONAIS
        $valorDia += $this -> somaProdutosAdicionais($id);
		$valorHora += $this -> somaProdutosAdicionaisHora($id);

        $valorDescontoHora = $arrayValorSimuladoPlanoAcao[0]['valorDescontoHora'];
	    if ($valorDescontoHora == '' || is_null($valorDescontoHora))
            $valorDescontoHora = 0;

        $horasPorAula = $arrayValorSimuladoPlanoAcao[0]['horasPorAula'];
	

        $frequenciaSemanalAula = $arrayValorSimuladoPlanoAcao[0]['frequenciaSemanalAula'];

        $cargaHorariaFixaMensal = $arrayValorSimuladoPlanoAcao[0]['cargaHorariaFixaMensal'];
        if ($cargaHorariaFixaMensal == '' || is_null($cargaHorariaFixaMensal))
            $cargaHorariaFixaMensal = 0;

        if ($tipo == 'R') {

            $NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
            $semanasNaoFaz = $NaoFazAulaNestaSemanaPlanoAcao -> selectNaoFazAulaNestaSemanaPlanoAcao(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $id);
            $semanasNaoFaz = count($semanasNaoFaz, 0);

            $semanasNoMes = 4 - $semanasNaoFaz;

            $horasTotais = (($frequenciaSemanalAula * $semanasNoMes) * ($horasPorAula / 60));

            $cargaHorariaFixaMensal = $cargaHorariaFixaMensal / 60;
            if ($cargaHorariaFixaMensal < $horasTotais && $cargaHorariaFixaMensal != 0)
                $horasTotais = $cargaHorariaFixaMensal;
			
			$diasAulas = ($frequenciaSemanalAula * $semanasNoMes);
			$diasAulas *= $valorDia;	
	//		echo $diasAulas;

            $total = $diasAulas + (($valorHora + $valor - $valorDescontoHora) * $horasTotais);

        } elseif ($tipo == 'T') {

            $total = $diasAulas + (($valorHora + $valor- $valorDescontoHora )* ($horasPorAula / 60));
        } elseif ($tipo == 'E') {

            $total = $diasAulas + $valorHora + $valor;
        }

        $total = Uteis::formatarMoeda($total);

        return $total;
    }

    function somaProdutosAdicionais($id) {

        $ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
        $ProdutoAdicional = new ProdutoAdicional();

        $where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $id;
        $valorProdutoAdicional = $ProdutoAdicionalValorSimuladoPlanoAcao -> selectProdutoAdicionalValorSimuladoPlanoAcao($where);
        $valorProdutoAdicional = Uteis::arrayCampoEspecifico($valorProdutoAdicional, 'produtoAdicional_idProdutoAdicional');
        $valorProdutoAdicional = implode(',', $valorProdutoAdicional) != "" ? implode(',', $valorProdutoAdicional) : "0";
        $where = " WHERE porHora = 0 AND idProdutoAdicional IN (" . $valorProdutoAdicional . ") ";
        $valorProdutoAdicional = $ProdutoAdicional -> selectProdutoAdicional($where);
        $valorProdutoAdicional = Uteis::arrayCampoEspecifico($valorProdutoAdicional, 'valor');
        $valorProdutoAdicional = array_sum($valorProdutoAdicional);

        return $valorProdutoAdicional;

    }
	
	    function somaProdutosAdicionaisHora($id) {

        $ProdutoAdicionalValorSimuladoPlanoAcao = new ProdutoAdicionalValorSimuladoPlanoAcao();
        $ProdutoAdicional = new ProdutoAdicional();

        $where = " WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $id;
        $valorProdutoAdicional = $ProdutoAdicionalValorSimuladoPlanoAcao -> selectProdutoAdicionalValorSimuladoPlanoAcao($where);
        $valorProdutoAdicional = Uteis::arrayCampoEspecifico($valorProdutoAdicional, 'produtoAdicional_idProdutoAdicional');
        $valorProdutoAdicional = implode(',', $valorProdutoAdicional) != "" ? implode(',', $valorProdutoAdicional) : "0";
        $where = " WHERE porHora = 1 AND idProdutoAdicional IN (" . $valorProdutoAdicional . ") ";
        $valorProdutoAdicional = $ProdutoAdicional -> selectProdutoAdicional($where);
        $valorProdutoAdicional = Uteis::arrayCampoEspecifico($valorProdutoAdicional, 'valor');
        $valorProdutoAdicional = array_sum($valorProdutoAdicional);

        return $valorProdutoAdicional;

    }

}
?>