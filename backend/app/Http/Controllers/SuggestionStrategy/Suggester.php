<?php

namespace App\Http\Controllers\SuggestionStrategy;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


/*
 * Interfaz usada para el patrón strategy que contiene los dos métodos que
 * debera implementar cada estrategia a seguir.
 */

interface Suggester
{
    public function getFriendsSuggestion($user): Collection;

    public function getPostsSuggestion($user): Builder;
}
