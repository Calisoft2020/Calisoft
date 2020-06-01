<?php

use Illuminate\Database\Seeder;

class TestValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TBL_TestValues')->insert([
            
            // Nombres de persona Correctos
            [ 'tipo' => 'name', 'valor' => "Johan Camilo Suárez Campos",'valido' => 1, 'FK_InputType' => 1],
            [ 'tipo' => 'name', 'valor' => "Pepito Perez",'valido' => 1, 'FK_InputType' => 1],
            [ 'tipo' => 'name', 'valor' => "Stevenson Marquez Rangel",'valido' => 1, 'FK_InputType' => "1"],
            // Nombres de personas Incorrectos
            [ 'tipo' => 'name2', 'valor' => "S",'valido' => "0", 'FK_InputType' => "1"],
            [ 'tipo' => 'name2', 'valor' => "Stevenson Rangel 2018",'valido' => "0", 'FK_InputType' => "1"],
            [ 'tipo' => 'name2', 'valor' => "Joh@n Súarez",'valido' => "0", 'FK_InputType' => "1"],
            // Emails Correctos
            [ 'tipo' => 'email', 'valor' => "Email@email.com",'valido' => "1", 'FK_InputType' => "2"],
            [ 'tipo' => 'email', 'valor' => "Prueba@Prueba.es",'valido' => "1", 'FK_InputType' => "2"],
            [ 'tipo' => 'email', 'valor' => "Raiz@surf.org",'valido' => "1", 'FK_InputType' => "2"],
            // Emails Incorrectos
            [ 'tipo' => 'email2', 'valor' => "EMconslo.com",'valido' => "0", 'FK_InputType' => "2"],
            [ 'tipo' => 'email2', 'valor' => "Windows@master",'valido' => "0", 'FK_InputType' => "2"],
            [ 'tipo' => 'email2', 'valor' => "L@nux@gmail.org",'valido' => "0", 'FK_InputType' => "2"],
            // PassWords Correctos
            [ 'tipo' => 'pass', 'valor' => "prueba1234!",'valido' => "1", 'FK_InputType' => "3"],
            [ 'tipo' => 'pass', 'valor' => "Contr@señ@090*",'valido' => "1", 'FK_InputType' => "3"],
            [ 'tipo' => 'pass', 'valor' => "Nomelase",'valido' => "1", 'FK_InputType' => "3"],
            // PassWords Incorrectos
            [ 'tipo' => 'pass2', 'valor' => "as",'valido' => "0", 'FK_InputType' => "3"],
            [ 'tipo' => 'pass2', 'valor' => "J",'valido' => "0", 'FK_InputType' => "3"],
            [ 'tipo' => 'pass2', 'valor' => "<h5>titulo<h5>",'valido' => "0", 'FK_InputType' => "3"],
            // Teléfonos Correctos
            [ 'tipo' => 'tel', 'valor' => "3144523889",'valido' => "1", 'FK_InputType' => "4"],
            [ 'tipo' => 'tel', 'valor' => "7689540",'valido' => "1", 'FK_InputType' => "4"],
            [ 'tipo' => 'tel', 'valor' => "3213431590",'valido' => "1", 'FK_InputType' => "4"],
            // Teléfonos Incorrectos
            [ 'tipo' => 'tel2', 'valor' => "301",'valido' => "0", 'FK_InputType' => "4"],
            [ 'tipo' => 'tel2', 'valor' => "123456789012345678901234567891234567890",'valido' => "0", 'FK_InputType' => "4"],
            [ 'tipo' => 'tel2', 'valor' => "555",'valido' => "0", 'FK_InputType' => "4"],
            // URL Validas
            [ 'tipo' => 'url', 'valor' => "https://web.whatsapp.com/",'valido' => "1", 'FK_InputType' => "5"],
            [ 'tipo' => 'url', 'valor' => "https://www.dominio.es/",'valido' => "1", 'FK_InputType' => "5"],
            [ 'tipo' => 'url', 'valor' => "https://www.xlmrapid.net",'valido' => "1", 'FK_InputType' => "5"],
            // URL Incorrectas
            [ 'tipo' => 'url2', 'valor' => "wwwwhatsapp.com/",'valido' => "0", 'FK_InputType' => "5"],
            [ 'tipo' => 'url2', 'valor' => "hts://web.telegram",'valido' => "0", 'FK_InputType' => "5"],
            [ 'tipo' => 'url2', 'valor' => "https//hostinger",'valido' => "0", 'FK_InputType' => "5"],
            // Creo que este no sería necesario ya que sólo evaluariamos atques xsm y sql
            // Texto Correcto
            [ 'tipo' => 'text', 'valor' => "Esto es un texto de prueba",'valido' => "1", 'FK_InputType' => "6"],
            [ 'tipo' => 'text', 'valor' => "El mismo texto de preuba para con números 1235456",'valido' => "1", 'FK_InputType' => "6"],
            [ 'tipo' => 'text', 'valor' => "Tambíen pueden ir unos $#: simbolos",'valido' => "1", 'FK_InputType' => "6"],
            [ 'tipo' => 'text', 'valor' => "Rama, árbol, cerezos, hojas, río, casas.",'valido' => "1", 'FK_InputType' => "6"],
            [ 'tipo' => 'text', 'valor' => "Frases con números 1234567890 y símbolos @#%/=",'valido' => "1", 'FK_InputType' => "6"],
            [ 'tipo' => 'text', 'valor' => "Carro, camión, moto, bicicleta, grúa",'valido' => "1", 'FK_InputType' => "6"],
            // Texto Incorrecto
            [ 'tipo' => 'text2', 'valor' => "<body onload=alert('test1')>",'valido' => "0", 'FK_InputType' => "6"],
            [ 'tipo' => 'text2', 'valor' => "<h1>Joh@n Súarez</h1>",'valido' => "0", 'FK_InputType' => "6"],
            [ 'tipo' => 'text2', 'valor' => '"x"; DROP TABLE members; --','valido' => "0", 'FK_InputType' => "6"],

             // Número Correcto
            [ 'tipo' => 'num', 'valor' => "123123",'valido' => "1", 'FK_InputType' => "7"],
            [ 'tipo' => 'num', 'valor' => "500025",'valido' => "1", 'FK_InputType' => "7"],
            [ 'tipo' => 'num', 'valor' => "3: simbolos",'valido' => "1", 'FK_InputType' => "7"],

            // Número Incorrecto
            [ 'tipo' => 'num2', 'valor' => "123%3",'valido' => "0", 'FK_InputType' => "7"],
            [ 'tipo' => 'num2', 'valor' => "No debe dejar pasar",'valido' => "0", 'FK_InputType' => "7"],
            [ 'tipo' => 'num2', 'valor' => 'Texto','valido' => "0", 'FK_InputType' => "7"],
            
            // Ataques

            [ 'tipo' => 'sql', 'valor' => '0 OR 1=1' ,'valido' => "0", 'FK_InputType' => "8" ],
            [ 'tipo' => 'sql', 'valor' => '" or ""="', 'valido' => "0", 'FK_InputType' => "8"],
            [ 'tipo' => 'sql', 'valor' => '"x"; DROP TABLE members; --"' ,'valido' => "0", 'FK_InputType' => "8" ],
            [ 'tipo' => 'sql', 'valor' => "\''; DROP TABLE users; --" ,'valido' => "0", 'FK_InputType' => "8"],

            [ 'tipo' => 'xss', 'valor' => "<body onload=alert('test1')>" ,'valido' => "0", 'FK_InputType' => "8"],
            [ 'tipo' => 'xss', 'valor' => "<b onmouseover=alert('Wufff!')>click me!</b>",'valido' => "0", 'FK_InputType' => "8"],
            [ 'tipo' => 'xss', 'valor' => '<img src="http://url.to.file.which/not.exist" onerror=alert(document.cookie);>', 'valido' => "0", 'FK_InputType' => "8"],
            [ 'tipo' => 'xss', 'valor' => "<IMG SRC=j&#X41vascript:alert('test2')>", 'valido' => "0", 'FK_InputType' => "8"]
        ]);
    }
}
