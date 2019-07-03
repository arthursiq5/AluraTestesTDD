<?php
  class Avaliador{
    /**
      * @access private
      * @var float $maiorValor
      */
    private $maiorValor = (-INF);
    /**
      * @access private
      * @var float $maiorValor
      */
    private $menorValor = INF;

    /**
      * avalia leilão
      * @param Leilao $leilao
      */
    public function avalia(Leilao $leilao){
      foreach($leilao->getLances() as $lance){
        if($lance->getValor() > $this->maiorValor)
          $this->maiorValor = $lance->getValor();
        if($lance->getValor < $this->menorValor)
          $this->menorValor = $lance->getValor();
      }
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
  }
 ?>
