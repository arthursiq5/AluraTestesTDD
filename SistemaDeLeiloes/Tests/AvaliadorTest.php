<?php

  use PHPUnit\Framework\TestCase;
  require_once "{dirname(__FILE__)}/../Usuario.php";
  require_once "{dirname(__FILE__)}/../Lance.php";
  require_once "{dirname(__FILE__)}/../Leilao.php";
  require_once "{dirname(__FILE__)}/../Avaliador.php";
  require_once "{dirname(__FILE__)}/../LeilaoFactory.php";

  /**
    * teste automatizado baseado no PHPUnit
    */
  class AvaliadorTest extends TestCase{
    private $avaliador;

    /**
      * @access public
      * @return void
      */
    public function SetUp():void{
      $this->avaliador = new Avaliador();
    }
    /**
      * @access private
      * @param Leilao $leilao
      * @return void
      */
    private function criaAvaliador(Leilao $leilao):void{
      $this->avaliador->avalia($leilao);
    }
    /**
      * teste automatizado utilizando phpunit
      */
    public function testAceitaLancesOrdemDecrescente(){
      $maiorEsperado = 400;
      $menorEsperado = 100;

      $leilao = new Leilao('PlayStation 4');

      $renan  = new Usuario('Renan');
      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($renan,  400))
             ->propoe(new Lance($caio,   300))
             ->propoe(new Lance($felipe, 200))
             ->propoe(new Lance($renan,  100));

      $this->criaAvaliador($leilao);

      $this->assertEquals($maiorEsperado, $this->avaliador->getMaiorLance(), 1);

      $this->assertEquals($menorEsperado, $this->avaliador->getMenorLance());
    }
    public function testCalculaMedia(){
      $mediaEsperada = 333.33;

      $leilao = new Leilao('PlayStation 4');

      $renan  = new Usuario('Renan');
      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($renan,  400))
             ->propoe(new Lance($caio,   350))
             ->propoe(new Lance($felipe, 250));

      $this->criaAvaliador($leilao);

      $this->assertEquals($mediaEsperada, $this->avaliador->getMedia());

    }

    public function testAceitaLancesGrandesOrdemDecrescente(){
      $maiorEsperado = 400;
      $menorEsperado = 250;

      $leilao = new Leilao('PlayStation 4');

      $renan  = new Usuario('Renan');
      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($felipe, 250))
             ->propoe(new Lance($caio,   350))
             ->propoe(new Lance($renan,  400));

      $this->criaAvaliador($leilao);

      $this->assertEquals($maiorEsperado, $this->avaliador->getMaiorLance(), 1);


      $this->assertEquals($menorEsperado, $this->avaliador->getMenorLance());
    }

    public function testAceitaLancesOrdemAleatoria(){
      $maiorEsperado = 400;
      $menorEsperado = 122;

      $leilao = new Leilao('PlayStation 4');

      $renan  = new Usuario('Renan');
      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($caio,   350))
             ->propoe(new Lance($felipe, 250))
             ->propoe(new Lance($caio,   122))
             ->propoe(new Lance($renan,  400))
             ->propoe(new Lance($felipe, 350));


      $this->criaAvaliador($leilao);

      $this->assertEquals($maiorEsperado, $this->avaliador->getMaiorLance(), 1);

      $this->assertEquals($menorEsperado, $this->avaliador->getMenorLance());
    }

    public function testAceitaLanceUnico(){
      $leilao = new Leilao('PlayStation 4');

      $renan = new Usuario('Renan');
      $leilao->propoe(new Lance($renan, 10));

      $this->criaAvaliador($leilao);

      $menor = 10;
      $maior = 10;

      $this->assertEquals($menor, $this->avaliador->getMenorLance());
      $this->assertEquals($maior, $this->avaliador->getMaiorLance());
    }
    public function testPegaTresMaiores(){
      $leilao = new Leilao('PlayStation 4');

      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($felipe, 200))
             ->propoe(new Lance($caio,   350))
             ->propoe(new Lance($felipe, 400))
             ->propoe(new Lance($caio,   500));

      $this->criaAvaliador($leilao);

      $this->assertEquals(3, count($this->avaliador->getMaioresValores()));
      $this->assertEquals(500, $this->avaliador
        ->getMaioresValores()[0]
        ->getValor()
      );
      $this->assertEquals(400, $this->avaliador
        ->getMaioresValores()[1]
        ->getValor()
      );
      $this->assertEquals(350, $this->avaliador
        ->getMaioresValores()[2]
        ->getValor()
      );
    }

    public function testPegaMaioresDeCinco(){
      $leilao = new Leilao('PlayStation 4');

      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($felipe, 200))
             ->propoe(new Lance($caio,   350))
             ->propoe(new Lance($felipe, 400))
             ->propoe(new Lance($caio,   500))
             ->propoe(new Lance($felipe, 600))
             ->propoe(new Lance($caio,   700));

      $this->criaAvaliador($leilao);

      $this->assertEquals(3, count($this->avaliador->getMaioresValores()));
      $this->assertEquals(700, $this->avaliador
             ->getMaioresValores()[0]
             ->getValor()
        );
      $this->assertEquals(600, $this->avaliador
        ->getMaioresValores()[1]
        ->getValor()
      );
      $this->assertEquals(500, $this->avaliador
        ->getMaioresValores()[2]
        ->getValor()
      );
    }
    public function testPegaDoisUnicos(){
      $leilao = new Leilao('PlayStation 4');

      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($felipe, 200))
             ->propoe(new Lance($caio,   350));

      $this->criaAvaliador($leilao);

      $this->assertEquals(2, count($this->avaliador->getMaioresValores()));
      $this->assertEquals(350, $this->avaliador
        ->getMaioresValores()[0]
        ->getValor()
      );
      $this->assertEquals(200, $this->avaliador
        ->getMaioresValores()[1]
        ->getValor()
      );
    }
    public function testPegaNulos(){
      $leilao = new Leilao('PlayStation 4');

      $this->criaAvaliador($leilao);

      $this->assertEquals(null, count($this->avaliador->getMaioresValores()));


    }
  }
 ?>
