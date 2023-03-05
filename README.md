   ![Image text](./public/img/SGMA.PNG)
  
  
## Acerca de SGMA

Sistema Gestión de Mecánica Automotriz, es un proyecto en proceso de desarrollo por estudiantes de la Universidad de Guayaquil bajo la cátedra SOF-S-MA-6-1 Construcción de Software del Ing. Angel Cuenca en el ciclo CII 2122-2022.

### Integrantes 
- **[Basurto Cruz Edgar Daniel](https://github.com/edgarbasurto)**
- **[Dávila Vidal Josá Andrés](https://github.com/Andresdavidala)**
- **[Espinoza De Los Monteros Víctor Iván](https://github.com/IvanEspiM)**
- **[Larrea Buste Edwin Rafael](https://github.com/Rafael1108)**
- **[Prado Velarde Andrés](https://github.com/AndresPradoVelarde)**
 
## Funcionalidad 

### Version 1.0
- Gestión del Sistema y Usuarios.
- Parametrización.
- Gestión de Inventario.
- Gestión del Taller.
- Gestión de Compras.
- Reportes.

## Tecnologías usadas
* [Lavarel](https://laravel.com/docs/9.x): Versión 9 
* [PHP](https://www.php.net/): Versión ^8.0.2
* [Apache](https://apache.org/): Versión 2.4.51 
* [Boostrap](https://getbootstrap.com/docs/5.1/getting-started/introduction/): Versión 5 
* [MySQL](https://dev.mysql.com/doc/): Versión 7.4.19  

### Pre Requisitos 
- Tener previamente instalado y configurado las técnologías usadas.
- [Lavarel](https://laravel.com/docs/9.x) para gestionar sus directivas recomienda el uso de [Composer](https://getcomposer.org/) se requiere que el equipo tenga instalado este componente.

## Instalación

1. Clonar el repositorio.
```
$ git clone https://github.com/UG-CSW-SGMA/SGMA.git
```
2. Abrir una consola de comandos y ubicarse dentro del directorio clonado.
3. Ejecutar la descarga de componentes de laravel:
```
$ composer update 
``` 
Este paso descargará y creará la carpeta <strong>Vendor</strong>

4. Copiar el archivo <strong>model.php</strong> que se encuentra en carpeta raíz y pegar en la ruta: 
```
/vendor/laravel/framework/src/Illuminate/Database/Eloquent/
``` 
<a style="color red"> <strong>Nota.</strong></a> Paso requerido para el manejo de los CRUD en  las bases de datos.

5. Descargar archivo de script de base de datos <strong> SGMA_V10.sql</strong> ubicado en la siguiente dirección del proyecto. 
```
/database/backup/
``` 

6. Cargar u ejecutar el script en MySQL.

7. Renombrar el archivo <strong>.env.example</strong> por <strong>.env</strong> que se encuentra en carpeta raíz.
<strongstyle="color red">Nota.</strong> En el archivo se encuentra la configuración de conexión en la cual se puede definir en función de lo confirado en mySQL.
   
## Ejecución
1. Abrir una consola de comandos y ubicarse dentro del directorio.
2. Ejecutar:
```
$ php artisan serve 
``` 

## Arquitectura MVC
A continuación se detalla la ubicacion de las carpetas de las capas.
### Modelo
Ubicación de los modelos/clases
[/app/Models](https://github.com/UG-CSW-SGMA/SGMA/tree/developer/app/Models)

Ubicación de las migraciones y especificación de campos
[/database/migrations](https://github.com/UG-CSW-SGMA/SGMA/tree/developer/database/migrations)

### Controlador
[/app/Http/Controllers](https://github.com/UG-CSW-SGMA/SGMA/tree/developer/app/Http/Controllers)

### Vistas
[/resources/views](https://github.com/UG-CSW-SGMA/SGMA/tree/developer/resources/views)
