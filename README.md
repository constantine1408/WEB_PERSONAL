# Web personal

Página web personal hecha con **HTML**, **CSS** y **PHP**. Incluye una calculadora sencilla (suma, resta, multiplicación y división) cuyo cálculo se hace en el servidor con PHP.

## Estructura

```
Semana_1/
├── index.php               # Página principal: datos personales y calculadora (HTML + JS)
├── css/
│   └── estilos.css         # Estilos
├── includes/
│   └── calculadora.php     # Calculadora en PHP: motor de cálculo y respuesta al botón "="
├── README.md
└── .gitignore
```

## Cómo ejecutarla

Necesitas PHP 8 o superior. Desde esta carpeta:

```bash
php -S localhost:8000
```

Luego abre <http://localhost:8000> en el navegador.

## Personalizar

Edita los arreglos `$perfil`, `$estudios`, `$habilidades` e `$intereses` donde dice "EDITA AQUÍ TUS DATOS PERSONALES" en `index.php`.
