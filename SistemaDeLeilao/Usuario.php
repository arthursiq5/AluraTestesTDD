<?php
  class Usuario{
    /**
      * @access private
      * @var int $id
      */
    private $id;
    /**
      * @access private
      * @var string $nome
      */
    private $nome;

    /**
      * @access public
      * @param string $nome
      * @param int $id
      */
    function __construct(string $nome, int $id=(-1)){
      $this->nome = $nome;
      $this->id = $id;
    }

    /**
      * @access public
      * @return string $nome
      */
    public function getNome():string{
      return $this->nome;
    }

    /**
      * @access public
      * @return int $id
      */
    public function getId():int{
      return $this->id;
    }
  }
 ?>
