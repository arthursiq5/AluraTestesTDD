<?php
  require_once 'Usuario.php';
  class Lance{
    /**
      * @var \Usuario $usuario
      */
    private $usuario;
    /**
      * @var mixed $valor
      */
    private $valor;

    /**
      * @param  Usuario $usuario
      * @throws InvalidArgumentException exceção para lances nulos ou negativos
      * @param  float $valor
      * @return void
      */
    function __construct(Usuario $usuario, float $valor){
      if (($valor <= 0) || ($valor == null)) {
        throw new InvalidArgumentException("Lances não podem ser nulos ou negativos");
      }
      $this->usuario = $usuario;
      $this->valor = $valor;
    }

    /**
      * @access public
      * @return Usuario $usuario
      */
    public function getUsuario():Usuario{
      return $this->usuario;
    }

    /**
      * @access public
      * @return float $valor
      */
    public function getValor():float{
      return $this->valor;
    }
  }
 ?>
