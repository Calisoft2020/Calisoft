const { mix } = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/assets/entries/bootstrap.js', 'public/js')
    .js('resources/assets/entries/semilleros.js', 'public/js')
    .js('resources/assets/entries/categorias.js', 'public/js')
    .js('resources/assets/entries/usuarios.js', 'public/js')
    .js('resources/assets/entries/proyectos.js', 'public/js')
    .js('resources/assets/entries/componentes.js', 'public/js')
    .js('resources/assets/entries/documentos.js', 'public/js')
    .js('resources/assets/entries/tipo-documento.js', 'public/js')
    .js('resources/assets/entries/categorias-show.js', 'public/js')
    .js('resources/assets/entries/invitaciones.js', 'public/js')
    .js('resources/assets/entries/admin-proyectos.js', 'public/js')
    .js('resources/assets/entries/evaluator-proyectos.js', 'public/js')
    .js('resources/assets/entries/notificaciones.js', 'public/js')
    .js('resources/assets/entries/items-codificacion.js', 'public/js')
    .js('resources/assets/entries/scripts-codificacion.js', 'public/js')
    .js('resources/assets/entries/modelacion.js', 'public/js')
    .js('resources/assets/entries/tipo-nomenclatura.js', 'public/js')
    .js('resources/assets/entries/nomenclaturas-show.js', 'public/js')
    .js('resources/assets/entries/items-show.js', 'public/js')
    .js('resources/assets/entries/archivo-sql.js', 'public/js')
    .js('resources/assets/entries/evaluator-docs.js', 'public/js')
    .js('resources/assets/entries/plataforma.js', 'public/js')
    .js('resources/assets/entries/codificacion.js', 'public/js')
    .js('resources/assets/entries/evaluator-script.js', 'public/js')
    .js('resources/assets/entries/plataforma-student.js', 'public/js')
    .js('resources/assets/entries/escenario.js', 'public/js')
    .js('resources/assets/entries/evaluacion-modelado.js', 'public/js')
    .js('resources/assets/entries/base-datos.js', 'public/js')
    .extract(['vue', 'vee-validate', 'laravel-echo', 'axios'])
