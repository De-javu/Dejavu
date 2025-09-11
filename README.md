# Dejavu - Sistema de Gestión Documental

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## 📋 Descripción

Dejavu es un sistema integral de gestión documental desarrollado con Laravel que permite organizar, almacenar y gestionar documentos de manera jerárquica siguiendo estándares archivísticos. El sistema implementa estructuras de entidades, series documentales, subseries y manejo avanzado de archivos con detección de duplicados mediante hash SHA-256.

## ✨ Características Principales

- 🏢 **Gestión de Entidades**: Manejo de entidades públicas, privadas y mixtas
- 📁 **Series Documentales**: Organización jerárquica de documentos (Series → Subseries)
- 📤 **Carga Masiva de Archivos**: Soporte para hasta 10 archivos simultáneos (50MB máximo c/u)
- 🔍 **Detección de Duplicados**: Validación por hash SHA-256 para evitar archivos duplicados
- 🎯 **Validación Avanzada**: Múltiples tipos de archivo soportados con validación de tamaño
- 📊 **Dashboard Interactivo**: Interfaz intuitiva con componentes Livewire
- 🔐 **Sistema de Autenticación**: Control de acceso y usuarios
- 💾 **Caché Inteligente**: Optimización de consultas con Laravel Cache

## 🛠️ Stack Tecnológico

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade Templates, Livewire, Flux UI Components
- **Base de Datos**: MySQL 8.0+
- **Autenticación**: Laravel Breeze
- **Estilos**: Tailwind CSS
- **Build Tools**: Vite

## 📋 Requisitos del Sistema

- PHP 8.2 o superior
- Composer 2.x
- Node.js 18+ y npm
- MySQL 8.0+ o MariaDB 10.4+
- Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/De-javu/Dejavu.git
cd Dejavu
```

### 2. Instalar dependencias
```bash
# Dependencias de PHP
composer install

# Dependencias de Node.js
npm install
```

### 3. Configurar el entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 4. Configurar base de datos
Edita el archivo `.env` y configura tu base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dejavu
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Ejecutar migraciones y seeders
```bash
# Crear tablas
php artisan migrate

# Poblar datos iniciales (opcional)
php artisan db:seed
```

### 6. Configurar almacenamiento
```bash
# Crear enlace simbólico para archivos públicos
php artisan storage:link
```

### 7. Compilar assets
```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

### 8. Iniciar servidor de desarrollo
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 📁 Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── UploadFileController.php     # Gestión de archivos
│   │   └── DocumentarySeriesController.php # Series documentales
│   └── Requests/
│       ├── CargarArchivoRequest.php     # Validación de archivos
│       └── CreateEntitiesRequest.php    # Validación de entidades
├── Livewire/
│   ├── CargarArchivosComponent.php      # Componente de carga
│   └── SeriesDocumentaleCrear.php       # Gestión de series
└── Models/
    ├── UploadFile.php                   # Modelo de archivos
    ├── Entities.php                     # Modelo de entidades
    └── DocumentarySeries.php            # Modelo de series

resources/
├── views/
│   ├── dashboard.blade.php              # Panel principal
│   ├── livewire/                        # Componentes Livewire
│   └── components/                      # Componentes reutilizables
└── js/
    └── app.js                           # JavaScript principal

database/
├── migrations/                          # Migraciones de BD
├── seeders/                            # Datos iniciales
└── factories/                          # Factories para testing
```

## 🔧 Comandos Útiles

### Migraciones
```bash
# Crear migración
php artisan make:migration nombre_migracion

# Ejecutar migraciones
php artisan migrate

# Rollback última migración
php artisan migrate:rollback

# Refresh completo
php artisan migrate:refresh --seed
```

### Cache y Optimización
```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🧪 Testing

```bash
# Ejecutar tests
php artisan test

# Tests con cobertura
php artisan test --coverage
```

## 📝 Uso del Sistema

### 1. Gestión de Entidades
- Crear entidades (públicas, privadas, mixtas)
- Definir unidades administrativas y oficinas productoras

### 2. Series Documentales
- Crear series principales
- Definir subseries dentro de cada serie
- Organización jerárquica de documentos

### 3. Carga de Archivos
- Seleccionar entidad, serie y subserie
- Cargar hasta 10 archivos simultáneamente
- Validación automática de duplicados por hash
- Metadatos archivísticos (fechas, retención, disposición)

## 🔐 Configuración de Seguridad

### Límites de Archivos
Configura en `php.ini`:
```ini
upload_max_filesize = 50M
post_max_size = 500M
max_file_uploads = 10
```

### Permisos de Carpetas
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 📊 Monitoreo y Logs

Los logs se almacenan en `storage/logs/laravel.log`. Para depuración:

```bash
# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama feature (`git checkout -b feature/nueva-caracteristica`)
3. Commit cambios (`git commit -am 'Agregar nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Crear Pull Request

### Estándares de Código
- Seguir PSR-12 para PHP
- Usar nombres descriptivos para variables y métodos
- Comentar código complejo
- Escribir tests para nuevas características

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## 👥 Equipo de Desarrollo

- **Desarrollador Principal**: De-javu
- **Rama Actual**: main
- **Estado**: En desarrollo activo

## 📞 Soporte

- **Issues**: [GitHub Issues](https://github.com/De-javu/Dejavu/issues)
- **Documentación**: Ver carpeta `docs/`
- **Wiki**: [GitHub Wiki](https://github.com/De-javu/Dejavu/wiki)

---

⭐ Si este proyecto te es útil, ¡no olvides darle una estrella!
