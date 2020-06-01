<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/app.css">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <header class="row">
        <div class="col-xs-4">
            <img src="img/LogoUDEC.png" class="img-responsive" alt="UDEC">
        </div>
        <div class="col-xs-6 col-xs-offset-2">
            <h3>CALISOFT</h3>
            <div> Calle 14 con Avenida 15 </div>
            <div>Universidad de Cundinamarca - Ext. Facatativá </div>
            <div> (+57 1) 892 0706 | 892 0707 </div>
            <div>
                <a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a>
            </div>
        </div>       
    </header>
    <div class="container-fluid">
        @yield('body')
    </div>
</body>

</html>
