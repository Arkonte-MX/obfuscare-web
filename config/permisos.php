<?php

return [
    "autenticado" => [
        "campo" => [
            "caracteres" => [
                "minimo" => env('PERMISOS_CAMPO_MINIMO_CARACTERES'),
                "maximo" => env('PERMISOS_USUARIO_AUTENTICADO_CAMPO_MAXIMO_CARACTERES')
            ]
        ],
        "procesar" => [
            "palabras" => [
                "maximo" => env('PERMISOS_USUARIO_AUTENTICADO_PALABRAS_PROCESAR')
            ]
        ]
    ],

    "invitado" => [
        "campo" => [
            "caracteres" => [
                "minimo" => env('PERMISOS_CAMPO_MINIMO_CARACTERES'),
                "maximo" => env('PERMISOS_USUARIO_INVITADO_CAMPO_MAXIMO_CARACTERES')
            ]
        ],
        "procesar" => [
            "palabras" => [
                "maximo" => env('PERMISOS_USUARIO_INVITADO_PALABRAS_PROCESAR')
            ]
        ]
    ]
];