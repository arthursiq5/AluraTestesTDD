<?php
  /**
   * classe Ano
   */
  class AnoBissexto
  {
    /**
      * @access public
      * @param int $ano
      * @return boolean
      */
    public static function ehBissexto(int $ano):bool{
      if (($ano%2==0 && $ano%100!=0) || $ano%400==0) {
        return true;
      }
      return false;
    }
  }

 ?>
