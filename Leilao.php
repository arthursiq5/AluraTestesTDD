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
             $this->verificaLancesSequenciaisUsuario($lance) &&
             $this->validaQuantiaDeLancesUsuario($lance);
    }

    /**
      * verifica se usuário deu dois lances seguidos
      * @access private
      * @param Lance $lance
      * @return boolean
      */
    private function verificaLancesSequenciaisUsuario(Lance $lance):bool{
      return $this->getUltimoUsuario() != $lance->getUsuario();
    }

    /**
      * retorna verdadeiro apenas se o usuário tiver dado menos de 5 lances
      * @access private
      * @param Lance $lance
      * @return boolean
      */
    private function validaQuantiaDeLancesUsuario(Lance $lance):bool{
      /** @var int $totalLances */
      $totalLances = 0;

      foreach ($this->lances as $lanceAtual) {
        if($lanceAtual->getUsuario() == $lance->getUsuario())
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
  }
 ?>
