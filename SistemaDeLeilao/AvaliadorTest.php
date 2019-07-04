<?php
  require_once 'Usuario.php';
  require_once 'Lance.php';
  require_once 'Leilao.php';
  require_once 'Avaliador.php';
  use PHPUnit\Framework\TestCase;

  class AvaliadorTest extends TestCase{
    public function testAceitaLancesOrdemDecrescente(){
      $maiorEsperado = 400;
      $menorEsperado = 250;

      $leilao = new Leilao('PlayStation 4');

      $renan  = new Usuario('Renan');
      $caio   = new Usuario('Caio');
      $felipe = new Usuario('Felipe');

      $leilao->propoe(new Lance($renan,  400));
      $leilao->propoe(new Lance($caio,   350));
      $leilao->propoe(new Lance($felipe, 251));

      $leiloeiro = new Avaliador();
      $leiloeiro->avalia($leilao);

      /**
        * função: verifica se valores são iguais
        * primeiro parâmetro: valor esperado
        * segundo  parâmetro: valor analisado
        */
      $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());

      echo "<br/>";

      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }
  }
 ?>
