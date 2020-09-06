<?php
namespace App\Models;
class Pesel
{
    public $peselNumber;
    public $base_year;
    public function is_valid($peselNumber)
    {
        if(preg_match('#^\d{11}$#', $peselNumber)===0){
            return false;
        }
        else{
            for($x =0; $x<11; $x++){
                $this ->peselNumber[$x]=(int)$peselNumber[$x];
            }
            if($this ->check_sum() === true && $this->is_valid_date() === true){
                return true;
            }else return false;

        }
    }
    public function check_sum()
    {
        $sum = (10 - ((1 * $this -> peselNumber[0] + 3 * $this -> peselNumber[1] + 7 * $this -> peselNumber[2] + 9 * $this -> peselNumber[3] + 1 * $this -> peselNumber[4] + 3 * $this -> peselNumber[5] + 7 * $this -> peselNumber[6] + 9 * $this -> peselNumber[7] + 1 * $this -> peselNumber[8] + 3 * $this -> peselNumber[9]) % 10)) % 10;
        if($sum === $this -> peselNumber[10]){
            return true;
        }else false;
    }
    public function get_birth_day()
    {
        return 10 * $this -> peselNumber[4] + $this -> peselNumber[5];
    }
    public function get_birth_month()
    {
        $month = 10 * $this -> peselNumber[2] + $this -> peselNumber[3];

        if($month > 80 && $month < 93)
        {
            $month -= 80;
            $this -> base_year = 1800;
        }
        else if($month > 20 && $month < 33)
        {
            $month -= 20;
            $this -> base_year = 2000;
        }
        else if($month > 40 && $month < 53)
        {
            $month -= 40;
            $this -> base_year = 2100;
        }
        else if($month > 60 && $month < 73)
        {
            $month -= 60;
            $this -> base_year = 2200;
        }
        else
        {
            $this -> base_year = 1900;
        }

        return $month;
    }

    public function get_birth_year()
    {
        return $this -> base_year + 10 * $this -> peselNumber[0] + $this -> peselNumber[1];
    }
    public function is_leap_year($year)
    {
        return (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0));
    }
    public function is_valid_month($month)
    {
        return ($month > 0 && $month < 13);
    }
    private function is_valid_day($month)
    {
        $day = $this -> get_birth_day();
        $year = $this -> get_birth_year();
        $is_correct_date = false;
        if($day > 0)
        {
            if(($month === 1 || $month === 3 || $month === 5 || $month === 7 || $month === 8 || $month === 10 || $month === 12) && $day < 32)
            {
                $is_correct_date = true;
            }
            else if(($month === 4 || $month === 6 || $month === 9 || $month === 11) && $day < 31)
            {
                $is_correct_date = true;
            }
            else
            {
                $leap_year = $this -> is_leap_year($year);
                if($leap_year === true)
                {
                    if($day < 30)
                    {
                        $is_correct_date = true;
                    }
                }
                else
                {
                    if($day < 29)
                    {
                        $is_correct_date = true;
                    }
                }
            }
        }
        return $is_correct_date;
    }
    public function is_valid_date()
    {
        $month = $this -> get_birth_month();

        return ($this -> is_valid_month($month) === true && $this -> is_valid_day($month) === true);
    }
}