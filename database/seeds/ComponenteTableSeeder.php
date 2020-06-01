<?php
use Illuminate\Database\Seeder;

class ComponenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DIAGRAMA DE ACTIVIDADES

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Actividad',
            'required' => false,
            'descripcion' => 'Especificación de una secuencia parametrizada de comportamiento',
            'FK_TipoDocumentoId' => '4',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Acción',
            'required' => false,
            'descripcion' => 'Una acción representa un solo paso dentro de una actividad',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Restricciones de acción',
            'required' => true,
            'descripcion' => 'Son adjuntas a una acción se pueden presentar antes de realizar una acción o posteriormente',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Flujo de control',
            'required' => false,
            'descripcion' => 'Muestra el flujo de control de una acción sobre otra',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Nodo inicial',
            'required' => false,
            'descripcion' => 'Describe el comienzo de cualquier actividad',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Nodo final de actividad',
            'required' => false,
            'descripcion' => 'El nodo final de actividad se describe como un círculo con un punto dentro del mismo',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Nodo final de flujo',
            'required' => false,
            'descripcion' => 'El nodo final de flujo se describe como un círculo con una cruz dentro del mismo',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Flujo de objetos',
            'required' => true,
            'descripcion' => 'Un flujo de objeto es la ruta a lo largo de la cual pueden pasar objetos o datos',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Nodos de decisión y combinación',
            'required' => true,
            'descripcion' => 'Los flujos de control que provienen de un nodo de deciNOón tendrán condiciones de guarda que permitirán el control para fluir si la condición de guarda se realiza',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Nodos de bifurcación y unión',
            'required' => true,
            'descripcion' => 'Estos indican el comienzo y final de hilos actuales de control',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Región de expansión',
            'required' => false,
            'descripcion' => 'Es una región de actividad estructurada que se ejecuta muchas veces',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Gestores de excepción',
            'required' => true,
            'descripcion' => 'Son de uso exclusivo cuando para la realización de una actividad se tengan restricciones u observaciones',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Región de actividad interrumpible',
            'required' => true,
            'descripcion' => 'Rodea un grupo de acciones que se pueden interrumpir',
            'FK_TipoDocumentoId' => '4',
        ]);
        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Partición',
            'required' => true,
            'descripcion' => 'Las particiones se usan para separar acciones dentro de una actividad',
            'FK_TipoDocumentoId' => '4',
        ]);



        //DIAGRAMA DE CASOS DE USO

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Actores',
            'required' => false,
            'descripcion' => 'Los actores representan los roles que pueden incluir usuarios humanos, un hardware externo u otros sistemas',
            'FK_TipoDocumentoId' => '2',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Casos de uso',
            'required' => false,
            'descripcion' => ' Notación para usar un caso de uso es una línea de conexión con una punta de flecha opcional mostrando la dirección del control',
            'FK_TipoDocumentoId' => '2',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Inclusión de casos de uso',
            'required' => true,
            'descripcion' => 'Los casos de uso pueden contener la funcionalidad de otro caso de uso como parte de su proceso normal',
            'FK_TipoDocumentoId' => '2',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Casos de uso extendidos',
            'required' => true,
            'descripcion' => 'Se pude usar para extender el comportamiento de otro. (En caso de que un usuario necesite permiso de otro para el acceso a ese caso de uso)',
            'FK_TipoDocumentoId' => '2',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Puntos de extensión',
            'required' => true,
            'descripcion' => 'Se utiliza un punto de extensión en caso de que se cumplan algunas condiciones específicas para ejecutar el caso de uso relacionado',
            'FK_TipoDocumentoId' => '2',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Límite del sistema',
            'required' => true,
            'descripcion' => 'Usualmente se usa para mostrar casos de uso dentro del sistema y actor,es fuera del sistema',
            'FK_TipoDocumentoId' => '2',
        ]);



        //Diagrama de secuencia



        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Línea de vida',
            'required' => false,
            'descripcion' => 'Una línea de vida representa un participante individual en un diagrama de secuencia',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Mensajes',
            'required' => true,
            'descripcion' => 'Deben ser mostrados como flechas Síncronos: denotados por una flecha con punta oscura, Asíncronos: denotados por una flecha con un punta en línea, Llamadas o señales: denotado por una flecha punteada',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Ocurrencia de ejecución',
            'required' => true,
            'descripcion' => 'Denota la ocurrencia de ejecución o activación de un foco de control',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Mensajes self',
            'required' => true,
            'descripcion' => 'Puede representar una llamada recursiva de una operación o un método llamando a otro método perteneciente al mismo objeto',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Mensajes perdidos y encontrados',
            'required' => true,
            'descripcion' => 'Los mensajes perdidos son aquellos que han sido enviados pero que no han llegado al destino esperado, o que han llegado aún',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Inicio y final de línea de vida',
            'required' => false,
            'descripcion' => 'Una línea de vida se puede crear o destruir durante la escala de tiempo representada por un diagrama de secuencia',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Restricciones de tiempo y duración ',
            'required' => true,
            'descripcion' => 'Al configurar una restricción de duración para un mensaje, el mensaje se mostrará como una línea inclinada',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Fragmentos combinados',
            'required' => true,
            'descripcion' => 'Fragmento combinado es una o más secuencias de procesos incluidas en un marco y ejecutadas bajo circunstancias nombradas específicas',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Puerto',
            'required' => true,
            'descripcion' => 'Conexión entre un fragmento y un mensaje.',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Descomposición en parte',
            'required' => true,
            'descripcion' => 'Permite mensajes de entre e intra objetos para que se muestren en el mismo diagrama',
            'FK_TipoDocumentoId' => '3',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Continuaciones / Invariantes de Estado',
            'required' => true,
            'descripcion' => 'Se puede encontrar extendida por una o más líneas de vida en distintos objetos',
            'FK_TipoDocumentoId' => '3',
        ]);



        //Diagrama de clase



        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Notacion de clase',
            'required' => true,
            'descripcion' => 'Se usan para denotar el nombre de la clase atributos y operaciones',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Interfaces',
            'required' => false,
            'descripcion' => 'Si se usa una interfaz se garantiza que las clases soporten un comportamiento requerido que permite que el sistema trate los elementos no relacionados en la misma manera',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Tablas',
            'required' => true,
            'descripcion' => 'Una tabla es una clase estereotipada',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Asociaciones',
            'required' => true,
            'descripcion' => 'Una asociación implica que dos elementos del modelo tienen una relación, usualmente implementada como una variable de instancia de una clase',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Generalizaciones',
            'required' => true,
            'descripcion' => 'Una generalización se usa para indicar herencia',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Agregaciones',
            'required' => true,
            'descripcion' => 'Las agregaciones se usan para describir elementos que están compuestos de componentes más pequeños',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Clase asociación',
            'required' => true,
            'descripcion' => 'Una clase asociación es una estructura que permite una conexión de asociación para tener conexiones y atributos',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Dependencias',
            'required' => true,
            'descripcion' => 'Una dependencia se usa para modelar un alto rango de relaciones dependientes entre elementos del modelo',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Trazado',
            'required' => true,
            'descripcion' => 'La relación de trazado es una especialización de una dependencia, vinculando elementos del modelo o conjuntos de elementos que representan la misma idea a través de los modelos',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Relaciones',
            'required' => false,
            'descripcion' => 'Se usa para expresar trazabilidad e integridad en el modelo',
            'FK_TipoDocumentoId' => '1',
        ]);

        DB::table('TBL_ComponentesDocumento')->insert([
            'nombre' => 'Anidamientos',
            'required' => true,
            'descripcion' => 'Un anidamiento es un conector que muestra que el elemento fuente se anida dentro del elemento destino',
            'FK_TipoDocumentoId' => '1',
        ]);


    }
}
