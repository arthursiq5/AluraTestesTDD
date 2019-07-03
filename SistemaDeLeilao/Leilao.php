<?php
  require_once 'Lance.php';

  class Leilao{
    /**
      * @access private
      * @var string $descricao
      */
    private $descricao;
    /**
      * @access private
      * @var array $lances
      */
    private $lances;

    /**
      * @param string $descricao
      * @return void
      */
    function __construct(string $descricao){
      $this->descricao = $descricao;
      $this->lances = array();
    }

    /**
      * @access public
      * @param Lance $lance
      * @return void
      */
    public function propoe(Lance $lance){
      $this->lances[] = $lance;
    }

    /**
      * @access public
      * @return string $descricao
      */
    public function getDescricao():string{
      return $this->descricao;
    }

    /**
      * @access public
      * @return array $lances
      */
    public function getLances():array{
      return $this->lances;
    }
  }
 ?>