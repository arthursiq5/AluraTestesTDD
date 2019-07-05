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
      * @access private
      * @var array $maiores
      */
    private $maiores;


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
      * @return Avaliador $this
      */
    public function avalia(Leilao $leilao):Avaliador{
      foreach($leilao->getLances() as $lance){
        if($lance->getValor() > $this->maiorValor)
          $this->maiorValor = $lance->getValor();
        if($lance->getValor() < $this->menorValor)
          $this->menorValor = $lance->getValor();
      }
      $this->calculaMedia($leilao);
      $this->pegaMaioresValoresDo($leilao);
      return $this;
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
      if (sizeof($leilao->getLances()) > 0) {
        $this->mediaDosValores = (float) number_format(($valorTotal / \sizeof($leilao->getLances())), 2);
      }else{
        $this->mediaDosValores = null;
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

    /**
      * @access public
      * @return float $mediaDosValores
      */
    public function getMedia():float{
      return $this->mediaDosValores;
    }

    /**
      * @access private
      * @param Leilao $leilao
      * @return void
      */
    private function pegaMaioresValoresDo(Leilao $leilao):void{
      $lances = $leilao->getLances();

      usort($lances, function($a, $b){
        if($a->getValor() == $b->getValor()) return 0;
        return ($a->getValor() < $b->getValor()) ? (1) : (-1);
      });

      $this->maiores = array_slice($lances, 0, 3);
    }

    /**
      * @access public
      * @return array
      */
    public function getMaioresValores():array{
      return $this->maiores;
    }
  }
 ?>
