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

    public function testMaximo5LancesPorUsuario(){
      $leilao = new Leilao("Macbook");

      $jobs = new Usuario('Jobs');
      $gates = new Usuario('Gates');

      $leilao->propoe(new Lance($jobs , 2000))
             ->propoe(new Lance($gates, 3000))
             ->propoe(new Lance($jobs , 3500))
             ->propoe(new Lance($gates, 4000))
             ->propoe(new Lance($jobs , 4500))
             ->propoe(new Lance($gates, 5000))
             ->propoe(new Lance($jobs , 5500))
             ->propoe(new Lance($gates, 6000))
             ->propoe(new Lance($jobs , 6500))
             ->propoe(new Lance($gates, 7000))
             ->propoe(new Lance($jobs , 10000));
      $this->assertEquals(10, \count($leilao->getLances()));
      $this->assertEquals(7000, \end($leilao->getLances())->getValor());
    }

    public function testDobraLanceAnteriorUsuario(){
      $leilao = new Leilao("Macbook");

      $jobs = new Usuario('Jobs');
      $gates = new Usuario('Gates');

      $leilao->propoe(new Lance($jobs , 2000))
             ->propoe(new Lance($gates, 3000))
             ->dobraLance($jobs);

      $this->assertEquals(3,    \count($leilao->getLances()));
      $this->assertEquals(
        4000,
        \end($leilao->getLances())->getValor()
      );
    }
    public function testIgnoraDobrasDeLancesNulos(){
      $leilao = new Leilao("Macbook");

      $jobs = new Usuario('Jobs');
      $gates = new Usuario('Gates');


      $leilao->dobraLance($jobs )
             ->dobraLance($gates)
             ->dobraLance($jobs );

      $this->assertEquals(null,    \count($leilao->getLances()));
    }

    public function testIgnoraDobrasSequenciais(){
      $leilao = new Leilao("Macbook");

      $jobs = new Usuario('Jobs');
      $gates = new Usuario('Gates');

      $leilao->propoe(new Lance($jobs , 2000))
             ->dobraLance($jobs)
             ->dobraLance($jobs);

      $this->assertEquals(1,    \count($leilao->getLances()));
      $this->assertEquals(
        2000,
        \end($leilao->getLances())->getValor()
      );
    }

    public function testIgnoraDobraDeUsuarioComMaisDe5Lances(){
      $leilao = new Leilao("Macbook");

      $jobs = new Usuario('Jobs');
      $gates = new Usuario('Gates');

      $leilao->propoe(new Lance($jobs , 2000))
             ->propoe(new Lance($gates, 3000))
             ->propoe(new Lance($jobs , 3500))
             ->propoe(new Lance($gates, 4000))
             ->propoe(new Lance($jobs , 4500))
             ->propoe(new Lance($gates, 5000))
             ->propoe(new Lance($jobs , 5500))
             ->propoe(new Lance($gates, 6000))
             ->propoe(new Lance($jobs , 6500))
             ->propoe(new Lance($gates, 7000))
             ->dobraLance($jobs);
      $this->assertEquals(10, \count($leilao->getLances()));
      $this->assertEquals(7000, \end($leilao->getLances())->getValor());
    }
  }
 ?>
