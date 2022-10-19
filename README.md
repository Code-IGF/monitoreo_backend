Universidad Nacional de El Salvador
-----------------------------------
Colaboración Programación III e Ingeniería de Software
------------------------------------------------------
Ciclo II-2022
-------------
Laravel Login API
=========================
**Commandos**

*1. Instalar dependencias*
```
composer install --ignore-platform-reqs
```

*2. Servidor de desarrollo*
```
php artisan serve
```

*3. crear modelo, migracion y controller *
```
php artisan make:model <nombreModelo> -m -c -r
```

*4. modificar migración*
```
php artisan make:migration add_<parametro>_to_<tabla>_table --table <tabla>
```

*5. Ejecutar seed en producción*
```
php artisan db:seed --force
```