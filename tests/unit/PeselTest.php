<?php


use PHPUnit\Framework\TestCase;

class PeselTest extends TestCase
{


    public function test1()
    {

        $pesel = new \App\Models\Pesel;
        $peselNumber='59062181980';
        $this->assertTrue($pesel->is_valid($peselNumber), $peselNumber);

    }
    public function test2()
    {
        $pesel = new \App\Models\Pesel;
        $peselNumber='87042133224';
        $this->assertTrue($pesel->is_valid($peselNumber));
        return $peselNumber;

    }
    public function test3()
    {
        $pesel = new \App\Models\Pesel;
        $peselNumber='59062181982';
        $this->assertTrue($pesel->is_valid($peselNumber), $peselNumber);

    }
    public function test4()
    {
        $pesel = new \App\Models\Pesel;
        $peselNumber='85070624489';
        $this->assertTrue($pesel->is_valid($peselNumber), $peselNumber);


    }


}