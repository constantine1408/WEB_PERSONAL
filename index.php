<?php
require __DIR__ . '/includes/calculadora.php';

/* ============================================================
   EDITA AQUÍ TUS DATOS PERSONALES
   ============================================================ */
$perfil = [
    'nombre'      => 'Tu Nombre Completo',
    'titulo'      => 'Estudiante de Ingeniería de Software',
    'descripcion' => 'Escribe aquí una breve presentación sobre ti: quién eres, qué estudias y qué te apasiona.',
    'email'       => 'tu-correo@ejemplo.com',
    'telefono'    => '+593 99 999 9999',
    'ciudad'      => 'Quito, Ecuador',
    'github'      => 'https://github.com/tu-usuario',
    'linkedin'    => 'https://www.linkedin.com/in/tu-usuario',
];

$estudios = [
    ['titulo' => 'Ingeniería de Software', 'lugar' => 'Tu Universidad', 'periodo' => '2024 - Actualidad'],
    ['titulo' => 'Bachiller en Ciencias',  'lugar' => 'Tu Colegio',     'periodo' => '2018 - 2024'],
];

$habilidades = ['HTML', 'CSS', 'PHP', 'JavaScript', 'Git y GitHub', 'Trabajo en equipo'];

$intereses = ['Programación', 'Tecnología', 'Música', 'Deportes'];

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($perfil['nombre']) ?> | Web personal</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

  <header class="barra-nav">
    <div class="nav-contenido">
      <a href="#inicio" class="logo"><?= e(explode(' ', $perfil['nombre'])[0]) ?></a>
      <nav>
        <a href="#sobre-mi">Sobre mí</a>
        <a href="#estudios">Estudios</a>
        <a href="#habilidades">Habilidades</a>
        <a href="#calculadora">Calculadora</a>
        <a href="#contacto">Contacto</a>
      </nav>
    </div>
  </header>

  <main>
    <!-- Inicio -->
    <section id="inicio" class="hero">
      <div class="avatar" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($perfil['nombre'], 0, 1))) ?></div>
      <h1><?= e($perfil['nombre']) ?></h1>
      <p class="subtitulo"><?= e($perfil['titulo']) ?></p>
      <a href="#calculadora" class="boton">Probar la calculadora</a>
    </section>

    <!-- Sobre mí -->
    <section id="sobre-mi" class="seccion">
      <h2>Sobre mí</h2>
      <p><?= e($perfil['descripcion']) ?></p>
      <h3>Intereses</h3>
      <ul class="etiquetas">
        <?php foreach ($intereses as $interes): ?>
          <li><?= e($interes) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>

    <!-- Estudios -->
    <section id="estudios" class="seccion">
      <h2>Estudios</h2>
      <div class="linea-tiempo">
        <?php foreach ($estudios as $estudio): ?>
          <article class="item">
            <h3><?= e($estudio['titulo']) ?></h3>
            <p><?= e($estudio['lugar']) ?></p>
            <span class="periodo"><?= e($estudio['periodo']) ?></span>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Habilidades -->
    <section id="habilidades" class="seccion">
      <h2>Habilidades</h2>
      <ul class="etiquetas">
        <?php foreach ($habilidades as $habilidad): ?>
          <li><?= e($habilidad) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>

    <!-- Calculadora (el cálculo lo hace PHP, al inicio de este mismo archivo) -->
    <section id="calculadora" class="seccion">
      <h2>Calculadora</h2>
      <p>Usa los botones o el teclado de tu computador. Al pulsar <strong>=</strong>, la operación se calcula con PHP en el servidor.</p>

      <div class="calc" id="calc">
        <div class="calc-pantalla">
          <div class="calc-expresion" id="calc-expresion"></div>
          <div class="calc-resultado" id="calc-resultado" aria-live="polite">0</div>
        </div>

        <div class="calc-cuerpo">
          <div class="calc-numeros">
            <button type="button" class="tecla" data-tecla="1">1</button>
            <button type="button" class="tecla" data-tecla="2">2</button>
            <button type="button" class="tecla" data-tecla="3">3</button>
            <button type="button" class="tecla" data-tecla="4">4</button>
            <button type="button" class="tecla" data-tecla="5">5</button>
            <button type="button" class="tecla" data-tecla="6">6</button>
            <button type="button" class="tecla" data-tecla="7">7</button>
            <button type="button" class="tecla" data-tecla="8">8</button>
            <button type="button" class="tecla" data-tecla="9">9</button>
            <button type="button" class="tecla fn" data-tecla="C" title="Borrar todo">C</button>
            <button type="button" class="tecla" data-tecla="0">0</button>
            <button type="button" class="tecla" data-tecla=".">.</button>
          </div>

          <div class="calc-ops">
            <button type="button" class="tecla op" data-tecla="+" title="Sumar">+</button>
            <button type="button" class="tecla op" data-tecla="-" title="Restar">&minus;</button>
            <button type="button" class="tecla op" data-tecla="*" title="Multiplicar">&times;</button>
            <button type="button" class="tecla op" data-tecla="/" title="Dividir">&divide;</button>
            <button type="button" class="tecla igual" data-tecla="=" title="Calcular">=</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="seccion">
      <h2>Contacto</h2>
      <ul class="contacto">
        <li><span>Correo</span> <a href="mailto:<?= e($perfil['email']) ?>"><?= e($perfil['email']) ?></a></li>
        <li><span>Teléfono</span> <?= e($perfil['telefono']) ?></li>
        <li><span>Ciudad</span> <?= e($perfil['ciudad']) ?></li>
        <li><span>GitHub</span> <a href="<?= e($perfil['github']) ?>" target="_blank" rel="noopener"><?= e($perfil['github']) ?></a></li>
        <li><span>LinkedIn</span> <a href="<?= e($perfil['linkedin']) ?>" target="_blank" rel="noopener"><?= e($perfil['linkedin']) ?></a></li>
      </ul>
    </section>
  </main>

  <footer class="pie">
    <p>&copy; <?= date('Y') ?> <?= e($perfil['nombre']) ?>. Hecho con HTML, CSS y PHP.</p>
  </footer>

  <script>
/**
 * Calculadora sencilla.
 *  - Los botones (o el teclado del computador) arman la operación en pantalla.
 *  - Al pulsar "=" la operación se envía a esta misma página, donde PHP hace el
 *    cálculo y devuelve el resultado.
 *  - No se recarga la página, por eso la pantalla no salta.
 */
(function () {
  'use strict';

  var calc = document.getElementById('calc');
  if (!calc) {
    return;
  }

  var URL_PHP = window.location.href.split('#')[0].split('?')[0];  // esta misma página (PHP)
  var elPrevia = document.getElementById('calc-expresion');
  var elPantalla = document.getElementById('calc-resultado');

  var OPERADORES = ['+', '−', '×', '÷'];
  var ALIAS = { '-': '−', '*': '×', '/': '÷' };

  var expresion = '';     // operación que se está escribiendo
  var previa = '';        // operación anterior, en pequeño ("7+8 =")
  var mensaje = '';       // mensaje de error
  var calculado = false;  // true justo después de pulsar "="
  var ocupado = false;    // esperando la respuesta del servidor

  /* ---------- Utilidades ---------- */

  function ultimo() {
    return expresion.charAt(expresion.length - 1);
  }

  function numeroActual() {
    var m = expresion.match(/[0-9.]+$/);
    return m ? m[0] : '';
  }

  // Después de un resultado, escribir un número empieza una operación nueva
  function nuevaEntrada() {
    if (calculado) {
      expresion = '';
      previa = '';
      calculado = false;
    }
  }

  /* ---------- Botones ---------- */

  function digito(d) {
    nuevaEntrada();
    var actual = numeroActual();
    if (actual === '0') {
      if (d === '0') {
        return;                                  // evita 00, 000...
      }
      expresion = expresion.slice(0, -1) + d;    // 05 -> 5
      return;
    }
    expresion += d;
  }

  function punto() {
    nuevaEntrada();
    var actual = numeroActual();
    if (actual.indexOf('.') !== -1) {
      return;                                    // solo un punto por número
    }
    expresion += (actual === '' ? '0.' : '.');
  }

  function operador(op) {
    if (calculado) {                             // sigue con el resultado
      calculado = false;
      previa = '';
    }
    if (expresion === '') {
      if (op === '−') {
        expresion = '−';                         // número negativo
      }
      return;
    }
    if (OPERADORES.indexOf(ultimo()) !== -1) {
      if (expresion.length === 1) {
        return;                                  // "−" solo, no se cambia
      }
      expresion = expresion.slice(0, -1) + op;   // reemplaza el operador
      return;
    }
    expresion += op;
  }

  function borrarUltimo() {
    if (calculado) {
      limpiar();
      return;
    }
    expresion = expresion.slice(0, -1);
  }

  function limpiar() {
    expresion = '';
    previa = '';
    calculado = false;
  }

  /* ---------- Comunicación con PHP ---------- */

  function evaluar(e) {
    var cuerpo = new URLSearchParams();
    cuerpo.append('expresion', e);

    return fetch(URL_PHP, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' },
      body: cuerpo.toString()
    })
      .then(function (respuesta) {
        return respuesta.json();
      })
      .catch(function () {
        return { ok: false, error: 'No se pudo conectar con el servidor PHP.' };
      });
  }

  function igual() {
    if (calculado) {
      return;
    }
    var e = expresion.replace(/[+−×÷]+$/, '');   // quita operadores sueltos al final
    if (e === '' || e === '−') {
      return;
    }
    ocupado = true;
    evaluar(e).then(function (r) {
      ocupado = false;
      if (r.ok) {
        previa = e + ' =';
        expresion = String(r.resultado).replace(/-/g, '−');
        calculado = true;
      } else {
        mensaje = r.error || 'Error al calcular.';
      }
      render();
    });
  }

  /* ---------- Pantalla ---------- */

  function render() {
    elPrevia.textContent = mensaje || previa;
    elPrevia.classList.toggle('error', !!mensaje);

    var texto = mensaje ? 'Error' : (expresion || '0');
    elPantalla.textContent = texto;
    elPantalla.classList.toggle('largo', texto.length > 11);
    elPantalla.classList.toggle('muy-largo', texto.length > 20);
  }

  /* ---------- Entrada ---------- */

  function pulsar(tecla) {
    if (ocupado) {
      return;
    }
    if (ALIAS[tecla]) {
      tecla = ALIAS[tecla];
    }
    mensaje = '';

    if (/^[0-9]$/.test(tecla)) {
      digito(tecla);
    } else if (OPERADORES.indexOf(tecla) !== -1) {
      operador(tecla);
    } else if (tecla === '.') {
      punto();
    } else if (tecla === 'C') {
      limpiar();
    } else if (tecla === 'back') {
      borrarUltimo();
    } else if (tecla === '=') {
      igual();
    }
    render();
  }

  calc.addEventListener('click', function (evento) {
    var boton = evento.target.closest('button[data-tecla]');
    if (boton) {
      pulsar(boton.getAttribute('data-tecla'));
    }
  });

  // Teclado del computador
  document.addEventListener('keydown', function (evento) {
    if (evento.ctrlKey || evento.metaKey || evento.altKey) {
      return;
    }
    if (evento.target && evento.target.tagName === 'A') {
      return;
    }

    var k = evento.key;
    var tecla = null;

    if (k.length === 1 && k >= '0' && k <= '9') { tecla = k; }
    else if (k === '.' || k === ',') { tecla = '.'; }
    else if (k === '+' || k === '-' || k === '*' || k === '/') { tecla = k; }
    else if (k === 'x' || k === 'X') { tecla = '*'; }
    else if (k === 'Enter' || k === '=') { tecla = '='; }
    else if (k === 'Backspace') { tecla = 'back'; }
    else if (k === 'Escape' || k === 'Delete') { tecla = 'C'; }

    if (tecla !== null) {
      evento.preventDefault();
      pulsar(tecla);
    }
  });

  render();
})();
  </script>
</body>
</html>
