<?php
  class Avaliador{
    /**
      * @access private
      * @var float $maiorValor
      */
    private $maiorValor;
    /**
      * @access private
      * @var float $maiorValor
      */
    private $menorValor;

    /**
      * @access private
      * @var float $mediaDosValores
      */
    private $mediaDosValores;


    /**
      * @access public
      * @return void
      */
    function __construct(){
      $this->maiorValor = (-INF);
      $this->menorValor = INF;
    }

    /**
      * avalia leilão
      * @param Leilao $leilao
      * @return void
      */
    public function avalia(Leilao $leilao):void{
      foreach($leilao->getLances() as $lance){
        if($lance->getValor() > $this->maiorValor)
          $this->maiorValor = $lance->getValor();
        if($lance->getValor < $this->menorValor)
          $this->menorValor = $lance->getValor();
      }
      $this->calculaMedia($leilao);
    }

    /**
      * calcula a média dos valores de um leilão
      * @access private
      * @param Leilao $leilao
      * @return void
      */
    private function calculaMedia(Leilao $leilao):void{
      $valorTotal = 0;
      foreach($leilao->getLances() as $lance){
        $valorTotal += $lance->getValor();
      }
      $this->mediaDosValores = (float) number_format(($valorTotal / \sizeof($leilao->getLances())), 2);
    }

    /**
      * @access public
      * @return float $maiorValor
      */
    public function getMaiorLance():float{
      return $this->maiorValor;
    }

    /**
      * @access public
      * @return float $menorValor
      */
    public function getMenorLance():float{
      return $this->menorValor;
    }

    /**
      * @access public
      * @return float $mediaDosValores
      */
    public function getMedia():float{
      return $this->mediaDosValores;
    }
  }
 ?>
