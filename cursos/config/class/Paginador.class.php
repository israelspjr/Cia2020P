<?php

class Paginador
{
    private $_dados;
    private $_paginacao;
    
    public function __construct() {
        $this->_dados = array();
        $this->_paginacao = array();
    }
    
    public function paginar($query, $pagina = false, $limite = false, $paginacao = false)
    {
        if($limite && is_numeric($limite)){
            $limite = $limite;
        } else {
            $limite = 10;
        }
        
        if($pagina && is_numeric($pagina)){
            $pagina = $pagina;
            $inicio = ($pagina - 1) * $limite;
        } else {
            $pagina = 1;
            $inicio = 0;
        }
        
        $registros = count($query);       
        $total = ceil($registros / $limite);
        $this->_dados = array_slice($query, $inicio, $limite);        
                
        $paginacao = array();
        $paginacao['atual'] = $pagina;
        $paginacao['total'] = $total;
        
        if($pagina > 1){
            $paginacao['primeiro'] = 1;
            $paginacao['anterior'] = $pagina - 1;
        } else {
            $paginacao['primeiro'] = '';
            $paginacao['anterior'] = '';
        }
        
        if($pagina < $total){
            $paginacao['ultimo'] = $total;
            $paginacao['proximo'] = $pagina + 1;
        } else {
            $paginacao['ultimo'] = '';
            $paginacao['proximo'] = '';
        }
        
        $this->_paginacao = $paginacao;
        $this->_intervaloPaginacao($paginacao);
        
        return $this->_dados;
    }
    
    private function _intervaloPaginacao($limite = false)
    {
        if($limite && is_numeric($limite)){
            $limite = $limite;
        } else {
            $limite = 10;
        }
        
        $total_paginas = $this->_paginacao['total'];
        $pagina_selecionada = $this->_paginacao['atual'];
        $intervalo = ceil($limite / 2);
        $paginas = array();
        
        $intervalo_direita = $total_paginas - $pagina_selecionada;
        
        if($intervalo_direita < $intervalo){
            $resto = $intervalo - $intervalo_direita;
        } else {
            $resto = 0;
        }
        
        $intervalo_esquerda = $pagina_selecionada - ($intervalo + $resto);
        
        for($i = $pagina_selecionada; $i > $intervalo_esquerda; $i--){
            if($i == 0){
                break;
            }
            
            $paginas[] = $i;
        }
        
        sort($paginas);
        
        if($pagina_selecionada < $intervalo){
            $intervalo_direita = $limite;
        } else {
            $intervalo_direita = $pagina_selecionada + $intervalo;
        }
        
        for($i = $pagina_selecionada + 1; $i <= $intervalo_direita; $i++){
            if($i > $total_paginas){
                break;
            }
            
            $paginas[] = $i;
        }
        
        $this->_paginacao['intervalo'] = $paginas;
        
        return $this->_paginacao;
        
    }    
  public function getView($vista, $link = false)
  {
    $rotaView = CAMINHO_CFG . "paginador.phtml";
    if($link)
      $link = CAMINHO_MODULO.$link.'/';
    
    if(is_readable($rotaView)){
      ob_start();
      
      include $rotaView;
      
      $conteudo = ob_get_contents();
      
      ob_end_clean();
      
      return $conteudo;
    }   
   throw new Exception("Erro de Paginação".$rotaView, 1);    
  }
}

?>
