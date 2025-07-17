Repositorio
# Semana_3.
En la semana tres, logramos finalizara la creacion co la logica en la base de datos, 

# Semana_4.
Se crearon las primeras tres tablas , mañana continuamos con las otras tablas, cinco, es de mucho cuidado para saber donde se pone que ? 

# Semana_5.

## Diccionario de comandos de migraciones Laravel

- **Crear una nueva migración:**
  ```bash
  php artisan make:migration nombre_de_la_migracion
  ```

- **Ejecutar todas las migraciones pendientes:**
  ```bash
  php artisan migrate
  ```

- **Revertir la última tanda de migraciones ejecutadas:**
  ```bash
  php artisan migrate:rollback
  ```

- **Revertir todas las migraciones (deja la base vacía):**
  ```bash
  php artisan migrate:reset
  ```

- **Reescribir (rollback + migrate en un solo paso):**
  ```bash
  php artisan migrate:refresh
  ```

- **Reescribir y ejecutar los seeders:**
  ```bash
  php artisan migrate:refresh --seed
  ```

- **Ejecutar una migración específica:**
  ```bash
  php artisan migrate --path=/database/migrations/archivo.php
  ```

- **Ver el estado de las migraciones:**
  ```bash
  php artisan migrate:status
  ```

- **Forzar la ejecución en producción (¡cuidado!):**
  ```bash
  php artisan migrate --force
  ```


**
