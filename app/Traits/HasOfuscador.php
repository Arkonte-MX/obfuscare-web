<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

trait HasOfuscador
{
    const VOCALES = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];

    public static function procesar(array $palabras, array $permisos): array
    {
        $limite_palabras_procesar = (int) ($permisos["maximo_palabras"] ?? null);
        return self::obtenerOfuscables($palabras, $limite_palabras_procesar);
    }

    private static function obtenerOfuscables(array $palabras, int $limite_palabras_procesar): array
    {
        $cantidad_palabras = count($palabras);
        $palabras_procesadas = 0;
        $pendientes = [];

        for ($indice = 0; $indice < $cantidad_palabras; $indice++) {

            $original = self::sanearPalabra($palabras[$indice]);
            $ofuscable = self::convertirEnMinusculas($original);

            $palabras[$indice] = [
                "original" => $original,
                "ofuscable" => $ofuscable,
                "ofuscada" => null,
                "severidad" => null
            ];

            if ($ofuscable !== "") {
                if ($palabras_procesadas < $limite_palabras_procesar) {

                    if (Cache::has($ofuscable)) {
                        $palabras[$indice] = array_merge($palabras[$indice], Cache::get($ofuscable));
                    } else {
                        $pendientes[$indice] = $ofuscable;
                        $palabras[$indice]["ofuscada"] = "";
                    }

                    ++$palabras_procesadas;
                }
            }
        }

        if (count($pendientes) > 0) {
            DB::table('ofuscable')
                ->leftJoin('alternativa', 'ofuscable.id_alternativa', '=', 'alternativa.id')
                ->leftJoin('severidad', 'ofuscable.id_severidad', '=', 'severidad.id')
                ->whereNotNull('ofuscable.id_severidad')
                ->whereIn('ofuscable.valor', array_values($pendientes))
                ->select('ofuscable.valor as ofuscable', 'severidad.id as severidad', 'alternativa.valor as alternativa')
                ->get()
                ->each(function ($pendiente) use (&$palabras) {

                    $ofuscable = $pendiente->ofuscable;
                    $original = "";

                    foreach ($palabras as $palabra) {
                        if (!is_null($palabra["ofuscada"]) && $palabra["ofuscable"] === $ofuscable) {
                            $original = $palabra["original"];
                            break;
                        }
                    }

                    Cache::put(
                        $ofuscable,
                        [
                            "ofuscada" => self::ofuscarPalabra($original, $pendiente->severidad, $pendiente->alternativa),
                            "severidad" => $pendiente->severidad
                        ]
                    );
                });

            $pendientes = null;
        }

        return self::distribuirPalabrasOfuscadas($palabras);
    }

    private static function sanearPalabra(string $palabra): string
    {
        return preg_replace('/[^a-zA-Z0-9áéíóúÁÉÍÓÚ\s]/', '', trim($palabra));
    }

    private static function convertirEnMinusculas(string $palabra): string
    {
        return mb_strtolower($palabra, 'UTF-8');
    }

    private static function distribuirPalabrasOfuscadas(array $palabras): array
    {

        $distribucion = [];
        $cantidad_palabras = count($palabras);

        for ($indice = 0; $indice < $cantidad_palabras; $indice++) {
            $distribucion[$palabras[$indice]["ofuscable"]][] = $indice;
        }

        foreach ($distribucion as $ofuscable => $indices) {

            if (Cache::has($ofuscable)) {
                $memorizada = Cache::get($ofuscable);
                foreach ($indices as $indice) {
                    $palabras[$indice] = array_merge($palabras[$indice], $memorizada);
                }
            }
        }

        return $palabras;
    }

    private static function ofuscarPalabra(string $palabra, int $severidad, string | null $alternativa): string
    {
        return match ($severidad) { // DEBE COINCIDIR CON resources/assets/js/presentar/utilerias.js => obtenerColorSeveridad
            4 => self::ofuscarProhibido($palabra, $alternativa),
            3 => self::ofuscarRiesgoso($palabra, $alternativa),
            2 => self::ofuscarSospechoso($palabra, $alternativa),
            default => self::noOfuscar($palabra)
        };
    }

    private static function ofuscarProhibido(string $palabra, string | null $alternativa): string
    {
        return self::ocultar($palabra, $alternativa);
    }

    private static function ofuscarRiesgoso(string $palabra, string | null $alternativa): string
    {
        $sustitutos = [
            'a' => ['4', '@'],
            'e' => ['3', '€'],
            'i' => ['1', '|', '!', '¡'],
            'o' => ['0', '()'],
            'u' => ['µ'],
            'A' => ['4', '/\\', '@', '/-\\'],
            'E' => ['3', '€'],
            'I' => ['1', '|', '!', '¡'],
            'O' => ['0', '()'],
            'U' => ['µ', '|_|'],
            'á' => ['4', '@'],
            'é' => ['3', '€'],
            'í' => ['1', '|', '!', '¡'],
            'ó' => ['0', '()'],
            'ú' => ['µ'],
            'Á' => ['4', '/\\', '@', '/-\\'],
            'É' => ['3', '€'],
            'Í' => ['1', '|', '!', '¡'],
            'Ó' => ['0', '()'],
            'Ú' => ['µ', '|_|']
        ];

        return self::sustituir($palabra, $sustitutos, $alternativa);
    }

    private static function ofuscarSospechoso(string $palabra, string | null $alternativa): string
    {
        $sustitutos = [
            'a' => ['â', 'ä'],
            'e' => ['ê', 'ë'],
            'i' => ['î', 'ï'],
            'o' => ['ô', 'ö'],
            'u' => ['û', 'ü'],
            'A' => ['Â', 'Ä'],
            'E' => ['Ê', 'Ë'],
            'I' => ['Î', 'Ï'],
            'O' => ['Ô', 'Ö'],
            'U' => ['Û', 'Ü'],
            'á' => ['â', 'ä'],
            'é' => ['ê', 'ë'],
            'í' => ['î', 'ï'],
            'ó' => ['ô', 'ö'],
            'ú' => ['û', 'ü'],
            'Á' => ['Â', 'Ä'],
            'É' => ['Ê', 'Ë'],
            'Í' => ['Î', 'Ï'],
            'Ó' => ['Ô', 'Ö'],
            'Ú' => ['Û', 'Ü']
        ];

        return self::sustituir($palabra, $sustitutos, $alternativa);
    }

    private static function noOfuscar(string $palabra): string
    {
        return $palabra;
    }

    private static function ocultar(string $palabra, string | null $alternativa): string
    {
        if (!!$alternativa) {
            return $alternativa;
        }

        $longitud = mb_strlen($palabra, 'UTF-8');
        if ($longitud <= 2) {
            return $palabra;
        } elseif ($longitud == 3) {
            return $palabra[0] . '*' . $palabra[2];
        } else {
            $mitad = intdiv($longitud, 2);
            return mb_substr($palabra, 0, $mitad - 1, 'UTF-8') . str_repeat('*', $longitud - $mitad * 2 + 2) . mb_substr($palabra, -$mitad + 1, null, 'UTF-8');
        }
    }

    private static function sustituir(string $palabra, array $sustitutos, string | null $alternativa)
    {
        if (!!$alternativa) {
            return $alternativa;
        }

        $objetivos = implode('|', array_map(function ($objetivo) {
            return preg_quote($objetivo, '/');
        }, self::VOCALES));

        return preg_replace_callback("/{$objetivos}/", function ($matches) use ($sustitutos) {
            return $sustitutos[$matches[0]][array_rand($sustitutos[$matches[0]])];
        }, $palabra);
    }
}
