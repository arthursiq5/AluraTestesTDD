<?php
  require_once './Usuario.php';
  require_once './Lance.php';
  require_once './Leilao.php';

  class LeilaoFactory{

    private $leilao;

    /**
      * @access public
      * @param string $descricao
      * @return ConstrutorDeLeilao $this
      */
    public function para($descricao):ConstrutorDeLeilao{
      $this->leilao = new Leilao($descricao);

      return $this;
    }

    /**
      * adiciona item ao leilão
      * @access public
      * @param Usuario $usuario
      * @param float $valor
      * @return ConstrutorDeLeilao $this
      */
    public function lance(Usuario $usuario, float $valor):ConstrutorDeLeilao{
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
