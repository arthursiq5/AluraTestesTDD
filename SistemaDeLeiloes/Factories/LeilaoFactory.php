<?php
  require_once "{dirname(__FILE__)}/../Usuario.php";
  require_once "{dirname(__FILE__)}/../Lance.php";
  require_once "{dirname(__FILE__)}/../Leilao.php";

  class LeilaoFactory{

    private $leilao;

    /**
      * @access public
      * @param string $descricao
      * @return LeilaoFactory $this
      */
    public function para(string $descricao):LeilaoFactory{
      $this->leilao = new Leilao($descricao);

      return $this;
    }

    /**
      * adiciona item ao leilão
      * @access public
      * @param Usuario $usuario
      * @param float $valor
      * @return LeilaoFactory $this
      */
    public function lance(Usuario $usuario, float $valor):LeilaoFactory{
      $this->leilao->propoe(new Lance($usuario, $valor));
      return $this;
    }

    /**
      * @access public
      * @return Leilao $leilao
      */
    public function constroi():Leilao{
      return $this->leilao;
    }
  }
 ?>
