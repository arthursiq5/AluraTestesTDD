<?php

  use PHPUnit\Framework\TestCase;
  require_once "{dirname(__FILE__)}/../Usuario.php";
  require_once "{dirname(__FILE__)}/../Lance.php";
  require_once "{dirname(__FILE__)}/../Leilao.php";
  require_once "{dirname(__FILE__)}/../Avaliador.php";
  /**
    * teste automatizado baseado no PHPUnit
    */
  class AvaliadorTest extends TestCase{
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

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 1);

      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
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

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals($mediaEsperada, $leiloeiro->getMedia());

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

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 1);


      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
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


      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 1);

      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }

    public function testAceitaLanceUnico(){
      $leilao = new Leilao('PlayStation 4');

      $renan = new Usuario('Renan');
      $leilao->propoe(new Lance($renan, 10));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $menor = 10;
      $maior = 10;

      $this->assertEquals($menor, $leiloeiro->getMenorLance());
      $this->assertEquals($maior, $leiloeiro->getMaiorLance());
    }
    public function testPegaTresMaiores(){
      $leilao = new Leilao('PlayStation 4');

      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($felipe, 200))
             ->propoe(new Lance($caio,   350))
             ->propoe(new Lance($felipe, 400))
             ->propoe(new Lance($caio,   500));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(3, count($leiloeiro->getMaioresValores()));
      $this->assertEquals(500, $leiloeiro
        ->getMaioresValores()[0]
        ->getValor()
      );
      $this->assertEquals(400, $leiloeiro
        ->getMaioresValores()[1]
        ->getValor()
      );
      $this->assertEquals(350, $leiloeiro
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

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(3, count($leiloeiro->getMaioresValores()));
      $this->assertEquals(700, $leiloeiro
             ->getMaioresValores()[0]
             ->getValor()
        );
      $this->assertEquals(600, $leiloeiro
        ->getMaioresValores()[1]
        ->getValor()
      );
      $this->assertEquals(500, $leiloeiro
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

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(2, count($leiloeiro->getMaioresValores()));
      $this->assertEquals(350, $leiloeiro
        ->getMaioresValores()[0]
        ->getValor()
      );
      $this->assertEquals(200, $leiloeiro
        ->getMaioresValores()[1]
        ->getValor()
      );
    }
    public function testPegaNulos(){
      $leilao = new Leilao('PlayStation 4');

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      $this->assertEquals(null, count($leiloeiro->getMaioresValores()));


    }
  }
 ?>
