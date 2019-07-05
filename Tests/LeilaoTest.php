<?php
  use PHPUnit\Framework\TestCase;
  require_once "{dirname(__FILE__)}/../Usuario.php";
  require_once "{dirname(__FILE__)}/../Lance.php";
  require_once "{dirname(__FILE__)}/../Leilao.php";
  require_once "{dirname(__FILE__)}/../Avaliador.php";

  class LeilaoTest extends TestCase{
    /**
      * testa se método 'propor()' está funcionando de forma correta
      */
    public function testDeveProporUmLance(){
      $leilao = new Leilao("Macbook");

      $this->assertEquals(null, \count($leilao->getLances()));

      $joao = new Usuario('Joao');

      $leilao->propoe(new Lance($joao, 2000));

      $this->assertEquals(1, \count($leilao->getLances()));
      $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }

    /**
      * testa se o bloqueio de lances seguidos de um usuário está funcionando
      */
    public function testDeveBarrarDoisLancesSeguidos(){
      $leilao = new Leilao("Macbook");

      $joao = new Usuario('João');

      $leilao->propoe(new Lance($joao, 2000))
             ->propoe(new Lance($joao, 2500));

      $this->assertEquals(1, \count($leilao->getLances()));
      $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }
  }
 ?>
