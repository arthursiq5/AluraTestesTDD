<?php
  use PHPUnit\Framework\TestCase;
  require_once "{dirname(__FILE__)}/../AnoBissexto.php";

  class AnoBissextoTest extends TestCase{
    public function testAnosMultiplosDe4(){
      $this->assertEquals(true, AnoBissexto::ehBissexto(2004));
      $this->assertEquals(true, AnoBissexto::ehBissexto(2008));
      $this->assertEquals(true, AnoBissexto::ehBissexto(1996));
    }
    public function testAnosMultiplosDe100(){
      $this->assertEquals(false, AnoBissexto::ehBissexto(2100));
      $this->assertEquals(false, AnoBissexto::ehBissexto(1900));
      $this->assertEquals(false, AnoBissexto::ehBissexto(1800));
      $this->assertEquals(false, AnoBissexto::ehBissexto(1700));
      $this->assertEquals(false, AnoBissexto::ehBissexto(1500));
    }
    public function testAnosMultiplosDe400(){
      $this->assertEquals(true, AnoBissexto::ehBissexto(2400));
      $this->assertEquals(true, AnoBissexto::ehBissexto(2000));
      $this->assertEquals(true, AnoBissexto::ehBissexto(1600));
    }
  }
 ?>
