<?php
namespace Projetux\Math;
 
class Basic
{
    /**
     * @return int|float
     */
    public function soma(int|float $numero, int|float $numero2)
    {
        return $numero + $numero2;
    }
 
    /**
     * @return int|float
     */
    public function subtrai(int|float $numero, int|float $numero2)
    {
        return $numero - $numero2;
    }
 
    /**
     * @return int|float
     */
    public function multiplicar(int|float $numero, int|float $numero2)
    {
        return $numero * $numero2;
    }
 
    /**
     * @return int|float
     */
    public function divisao(int|float $numero, int|float $numero2)
    {
        return $numero / $numero2;
    }
 
    /**
     * @return int|float
     */
    public function raiz(int|float $numero)
    {
        return sqrt($numero);
    }
 
    /**
     * @return int|float
     */
    public function quadrado(int|float $numero)
    {
        return pou($numero);
    }
 
}