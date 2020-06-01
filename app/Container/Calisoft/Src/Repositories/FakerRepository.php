<?php
namespace App\Container\Calisoft\Src\Repositories;

use Faker;
use Faker\Factory;

/**
 * Clase de repositorio que retorna los valores para realizar las pruebas automatizadas
 * TIPOS => text, email, number, tel, url, file
 */
class FakerRepository
{   
    /**
     * @var Faker\Factory $faker 
     */
    private $faker;

    function __construct()
    {
        $this->faker = Faker\Factory::create('es_ES');
        $this->faker->addProvider(new TestFakeProvider($this->faker));
    }

    /**
     * Retorna valor de entrada valido
     * @param string $type
     */
    public function getValidValue($type) {
        switch ($type) {
            case 'text':
                return $this->faker->word();
                break;
            case 'email':
                return $this->faker->email();
                break;
            case 'password':
                return $this->faker->password();
                break;
            case 'tel':
                return $this->faker->e164PhoneNumber();
                break;
            case 'url':
                return $this->faker->url();
                break;
            case '1':
                return $this->faker->name();
                break;
            case '2':
                return $this->faker->email();
                break;
            case '3':
                return $this->faker->pass();
                break;
            case '4':
                return $this->faker->tel();
                break;
            case '5':
                return $this->faker->url();
                break;
            case '6':
                return $this->faker->text();
                break;
            case '7':
                return $this->faker->num();
                break;
            default:
                return null;
                break;
        }
    }

    public function getInvalidValue($type) {
        switch ($type) {
            case 'text':
                return $this->faker->word();
                break;
            case 'email':
                return $this->faker->email();
                break;
            case 'password':
                return $this->faker->password();
                break;
            case 'tel':
                return $this->faker->e164PhoneNumber();
                break;
            case 'url':
                return $this->faker->url();
                break;
            case '1':
                return $this->faker->name2();
                break;
            case '2':
                return $this->faker->email2();
                break;
            case '3':
                return $this->faker->pass2();
                break;
            case '4':
                return $this->faker->tel2();
                break;
            case '5':
                return $this->faker->url2();
                break;
            case '6':
                return $this->faker->text2();
                break;
            case '7':
                return $this->faker->num2();
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * Retorna valor de prueba de sql
     * @return string
     */
    public function getSqlValue() {
        return $this->faker->sql();
    }

    /**
     * Retorna valor de prueba de xss
     * @return string
     */
    public function getXssValue() {
        return $this->faker->xss();
    }

    public function getNameValue() {
        return $this->faker->xss();
    }

    

}
