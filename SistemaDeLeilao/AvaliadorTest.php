<?php
  // require_once "../autoload.";

  use PHPUnit\Framework\TestCase;
  require_once "Usuario.php";
  require_once "Lance.php";
  require_once "Leilao.php";
  require_once "Avaliador.php";
  // require_once "./Usuario.php";
  // require_once "./Lance.php";
  // require_once "./Leilao.php";
  // require_once "./Avaliador.php";
  /**
    * teste automatizado baseado no PHPUnit
    */
  class AvaliadorTest extends TestCase{
    /**
      * teste automatizado utilizando phpunit
      */
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

      /**
        * função: verifica se valores são iguais
        * primeiro parâmetro: valor esperado
        * segundo  parâmetro: valor analisado
        */
      $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }
  }
 ?>
