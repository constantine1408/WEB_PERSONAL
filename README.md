# TAREA DE WEB PERSONAL

Página web personal hecha con **HTML**, **CSS** y **PHP**. se hace en el servidor con PHP.

**Tarea: Introducción a HTML**

Objetivo: Aplicar los conocimientos adquiridos sobre la instalación de dependencias, comprender la sintaxis básica y el manejo de variables en la creación de un script sencillo que realice operaciones básicas con HTML y CSS.

Usted debe  realizar una web personal y debe publicarlo en un versionador de código (Github, Gitlab, etc).
No se admiten que las tareas estén cargadas en un repositorio como OneDrive o Goole Drive.


La tarea consiste en desarrollar una pagina web personal, en donde debe mostrar su información (html y CSS) y dentro de la pagina web debe estar una calculadora (php)


## Estructura

``` 
├── index.php               # Página principal: datos personales y calculadora (HTML + JS)
├── css/
│   └── estilos.css         # Estilos
├── includes/
│   └── calculadora.php     # Calculadora en PH
├── README.md
└── .gitignore
```

## Cómo ejecutarla

Necesitas PHP 8 o superior. Desde esta carpeta:

```bash o cualquier entorno
php -S localhost:8000
```

Luego abre <http://localhost> en el navegador.

## Personalizar

Edita los arreglos `$perfil`, `$estudios`, `$habilidades` e `$intereses` donde dice "EDITA AQUÍ TUS DATOS PERSONALES" en `index.php`.
