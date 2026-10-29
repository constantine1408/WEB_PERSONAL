<?php
/**
 * CALCULADORA (PHP) - archivo includes/calculadora.php
 * Lo carga index.php con require.
 *
 * Motor de la calculadora (PHP).
 *
 * Evalúa operaciones como "12+3×(4−1)" SIN usar eval(): es un pequeño
 * analizador que solo acepta números, + − × ÷, paréntesis, % y raíz cuadrada (√).
 * Cualquier otro texto se rechaza con un error.
 */

class ErrorCalculo extends Exception
{
}

final class Evaluador
{
    private string $texto;
    private int $pos = 0;
    private int $largo;

    private function __construct(string $texto)
    {
        $this->texto = $texto;
        $this->largo = strlen($texto);
    }

    /** Evalúa la operación y devuelve el resultado. Lanza ErrorCalculo si falla. */
    public static function evaluar(string $expresion): float
    {
        $expresion = trim($expresion);

        if ($expresion === '') {
            throw new ErrorCalculo('Escribe una operación.');
        }
        if (mb_strlen($expresion) > 200) {
            throw new ErrorCalculo('La operación es demasiado larga.');
        }

        // Unifica los símbolos (la raíz √ pasa a 'r' para trabajar byte a byte)
        $expresion = str_replace(
            ['×', '÷', '−', '–', ',', '√'],
            ['*', '/', '-', '-', '.', 'r'],
            $expresion
        );

        $analizador = new self($expresion);
        [$valor] = $analizador->suma();

        if ($analizador->actual() !== '') {
            throw new ErrorCalculo('Operación no válida.');
        }
        if (is_nan($valor) || is_infinite($valor)) {
            throw new ErrorCalculo('Resultado fuera de rango.');
        }

        return $valor;
    }

    private function saltarEspacios(): void
    {
        while ($this->pos < $this->largo && $this->texto[$this->pos] === ' ') {
            $this->pos++;
        }
    }

    /** Siguiente carácter sin consumirlo ('' si ya no hay más). */
    private function actual(): string
    {
        $this->saltarEspacios();
        return $this->pos < $this->largo ? $this->texto[$this->pos] : '';
    }

    /**
     * Suma y resta.
     * Devuelve [valor, esPorcentaje].
     */
    private function suma(): array
    {
        [$valor, $esPct] = $this->producto();

        while (($op = $this->actual()) === '+' || $op === '-') {
            $this->pos++;
            [$der, $derPct] = $this->producto();

            // Como en una calculadora de bolsillo: 200 + 10% = 220
            if ($derPct) {
                $der = $valor * $der;
            }

            $valor = $op === '+' ? $valor + $der : $valor - $der;
            $esPct = false;
        }

        return [$valor, $esPct];
    }

    /** Multiplicación y división. */
    private function producto(): array
    {
        [$valor, $esPct] = $this->factor();

        while (($op = $this->actual()) === '*' || $op === '/') {
            $this->pos++;
            [$der] = $this->factor();

            if ($op === '*') {
                $valor *= $der;
            } else {
                if ($der == 0.0) {
                    throw new ErrorCalculo('No se puede dividir entre cero.');
                }
                $valor /= $der;
            }
            $esPct = false;
        }

        return [$valor, $esPct];
    }

    /** Signo, número o paréntesis, y el % al final. */
    private function factor(): array
    {
        $c = $this->actual();

        if ($c === '-') {
            $this->pos++;
            [$v, $p] = $this->factor();
            return [-$v, $p];
        }
        if ($c === '+') {
            $this->pos++;
            return $this->factor();
        }

        $valor = $this->primario();
        $esPct = false;

        while ($this->actual() === '%') {
            $this->pos++;
            $valor /= 100;
            $esPct = true;
        }

        return [$valor, $esPct];
    }

    /** Número, (expresión) o raíz cuadrada. */
    private function primario(): float
    {
        $c = $this->actual();

        if ($c === '(') {
            $this->pos++;
            [$v] = $this->suma();
            if ($this->actual() !== ')') {
                throw new ErrorCalculo('Falta cerrar un paréntesis.');
            }
            $this->pos++;
            return $v;
        }

        if ($c === 'r') {
            $this->pos++;
            $x = $this->primario();
            if ($x < 0) {
                throw new ErrorCalculo('No existe la raíz de un número negativo.');
            }
            return sqrt($x);
        }

        if (preg_match('/\G(?:\d+(?:\.\d*)?|\.\d+)(?:[eE][+-]?\d+)?/', $this->texto, $m, 0, $this->pos)) {
            $this->pos += strlen($m[0]);
            return (float) $m[0];
        }

        throw new ErrorCalculo('Operación incompleta o no válida.');
    }
}

/** Da formato al número: quita ceros sobrantes (5.000 -> 5) y usa notación científica si es enorme. */
function formatearNumero(float $n): string
{
    if (is_nan($n) || is_infinite($n)) {
        return 'Fuera de rango';
    }
    if ($n == 0.0) {
        return '0';
    }

    $abs = abs($n);
    if ($abs >= 1e15 || $abs < 1e-9) {
        return preg_replace('/\.?0+e/', 'e', sprintf('%.8e', $n));
    }

    $texto = rtrim(rtrim(number_format($n, 10, '.', ''), '0'), '.');
    return ($texto === '' || $texto === '-0') ? '0' : $texto;
}

/* ============================================================
   CALCULADORA (PHP): recibe la operación y responde en JSON.
   Se ejecuta solo cuando el botón "=" envía datos a esta misma página.
   ============================================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expresion'])) {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');

    $expresion = $_POST['expresion'];
    if (!is_string($expresion)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Operación no válida.']);
        exit;
    }

    try {
        $resultado = Evaluador::evaluar($expresion);
        echo json_encode(['ok' => true, 'resultado' => formatearNumero($resultado)], JSON_UNESCAPED_UNICODE);
    } catch (ErrorCalculo $ex) {
        echo json_encode(['ok' => false, 'error' => $ex->getMessage()], JSON_UNESCAPED_UNICODE);
    }
    exit;
}
