<?php

namespace App\Container\Calisoft\Src\Repositories;

use Faker\Provider\Base;
use App\Container\Calisoft\Src\TestValue;

class TestFakeProvider extends Base {
    
    /**
     * Retorna valor de prueba de sql
     * @return string
     */
    public function sql() {
        $values = $this->data('sql');
        return $this->generator->randomElement($values);
    }

    /**
     * Retorna valor de prueba de xss
     * @return string
     */
    public function xss() {
        $values = $this->data('xss');
        return $this->generator->randomElement($values);
    }

    public function name() {
        $values = $this->data('name');
        return $this->generator->randomElement($values);
    }
    public function name2() {
        $values = $this->data('name2');
        return $this->generator->randomElement($values);
    }
    public function email() {
        $values = $this->data('email');
        return $this->generator->randomElement($values);
    }
    public function email2() {
        $values = $this->data('email2');
        return $this->generator->randomElement($values);
    }
    public function pass() {
        $values = $this->data('pass');
        return $this->generator->randomElement($values);
    }
    public function pass2() {
        $values = $this->data('pass2');
        return $this->generator->randomElement($values);
    }
    public function tel() {
        $values = $this->data('tel');
        return $this->generator->randomElement($values);
    }
    public function tel2() {
        $values = $this->data('tel2');
        return $this->generator->randomElement($values);
    }
    public function url() {
        $values = $this->data('url');
        return $this->generator->randomElement($values);
    }
    public function url2() {
        $values = $this->data('url2');
        return $this->generator->randomElement($values);
    }
    public function text() {
        $values = $this->data('text');
        return $this->generator->randomElement($values);
    }
    public function text2() {
        $values = $this->data('text2');
        return $this->generator->randomElement($values);
    }
    public function num() {
        $values = $this->data('num');
        return $this->generator->randomElement($values);
    }
    public function num2() {
        $values = $this->data('num2');
        return $this->generator->randomElement($values);
    }

    private function data($tipo) {
        return TestValue::where('tipo', $tipo)->pluck('valor')->toArray();
    }
}