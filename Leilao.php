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
      * @return Leilao
      */
    public function propoe(Lance $lance):Leilao{
      if ($this->validaProposta($lance))
        $this->lances[] = $lance;
      return $this;
    }

    /**
      * @access private
      * @param Lance $lance
      * @return boolean
      */
    private function validaProposta(Lance $lance):bool{
      return (\count($this->getLances()) == 0) ||
             $this->verificaLancesSequenciaisUsuario($lance->getUsuario()) &&
             $this->validaQuantiaDeLancesUsuario($lance->getUsuario());
    }

    /**
      * verifica se usuário deu dois lances seguidos
      * @access private
      * @param Lance $lance
      * @return boolean
      */
    private function verificaLancesSequenciaisUsuario(Usuario $usuario):bool{
      return $this->getUltimoUsuario() != $usuario;
    }

    /**
      * retorna verdadeiro apenas se o usuário tiver dado menos de 5 lances
      * @access private
      * @param Lance $lance
      * @return boolean
      */
    private function validaQuantiaDeLancesUsuario(Usuario $usuario):bool{
      /** @var int $totalLances */
      $totalLances = 0;

      foreach ($this->lances as $lanceAtual) {
        if($lanceAtual->getUsuario() == $usuario)
          $totalLances++;
      }
      return $totalLances < 5;
    }

    /**
      * @access private
      * @return Usuario $ultimoUsuario
      */
    private function getUltimoUsuario():Usuario{
      return end($this->lances)->getUsuario();
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

    public function dobraLance(Usuario $usuario){
      $ultimoLanceDoUsuario = null;
      foreach ($this->lances as $lance) {
        if($lance->getUsuario() == $usuario)
          $ultimoLanceDoUsuario = $lance;
      }
      if ($this->validaDobraDeLance(
        $usuario,
        $ultimoLanceDoUsuario)
      ) {
        $this->lances[] = new Lance(
          $usuario,
          ($ultimoLanceDoUsuario->getValor() * 2)
        );
      }
      return $this;
    }

    public function validaDobraDeLance(
      Usuario $usuario,
      $ultimoLanceDoUsuario
    ):bool{
      if(\count($this->getLances()) == 0) return false;
      return $this->verificaLancesSequenciaisUsuario($usuario) &&
             (
               $this->validaQuantiaDeLancesUsuario($usuario) &&
               $ultimoLanceDoUsuario != null
             );
    }
  }
 ?>
