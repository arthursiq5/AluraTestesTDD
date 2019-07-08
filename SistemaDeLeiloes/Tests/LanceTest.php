<?php
  use PHPUnit\Framework\TestCase;
  require_once "{dirname(__FILE__)}/../Usuario.php";
  require_once "{dirname(__FILE__)}/../Lance.php";

  class LanceTest extends TestCase{
    /**
      * @expectedException InvalidArgumentException
      */
    public function testDeveRecusarLancesNulos(){
      $fulano = new Usuario('fulano');
      $i = new Lance($fulano, 0);
    }

    /**
      * @expectedException InvalidArgumentException
      */
    public function testDeveRecusarLancesNegativos(){
      $fulano = new Usuario('fulano');
      $i = new Lance($fulano, -1);
    }
  }
?>
