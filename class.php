<?php
interface Cal
{
    public function add(string $num1, $num2);
    public function sub(string $num1, $num2);
    public function div(string $num1, $num2);
    public function mul(string $num1, $num2);
}

interface SciCal
{
    public function reminder($num1, $num2);
    public function double_mul($num1, $num2);
}

class Calculator implements Cal, SciCal
{
    public $num1;
    public $num2;
    public $method;

    public function __construct($userNum1, $userMethod, $userNum2)
    {
        $this->num1 = $userNum1;
        $this->num2 = $userNum2;
        $this->method = $userMethod;
    }

    public function add(string $num1, $num2)
    {
        return $num1 + $num2;
    }
    public function sub(string $num1, $num2)
    {
        return $num1 - $num2;
    }
    public function div(string $num1, $num2)
    {
        if ($num2 == 0) {
            $num2 = 1;
            return $num1 / $num2;
        } else {
            return $num1 / $num2;
        }
    }
    public function mul(string $num1, $num2)
    {
        return $num1 * $num2;
    }
    public function reminder($num1, $num2)
    {
        if ($num2 == 0) {
            $num2 = 1;
            return $num1 % $num2;
        } else {
            return $num1 % $num2;
        }
        
    }
    public function double_mul($num1, $num2)
    {
        return $num1 ** $num2;
    }

    public function __toString() : string
    {
        return (string) match ($this->method) {
          'add' => $this->add($this->num1, $this->num2),
          'sub' => $this->sub($this->num1, $this->num2),
          'div' => $this->div($this->num1, $this->num2),
          'mul' => $this->mul($this->num1, $this->num2),
          'reminder' => $this->reminder($this->num1, $this->num2),
          'double_mul' => $this->double_mul($this->num1, $this->num2),
        };
    }
}
?>