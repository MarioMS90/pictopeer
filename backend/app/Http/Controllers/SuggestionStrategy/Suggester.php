<?php

namespace App\Http\Controllers\SuggestionStrategy;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface Suggester
{
    public function getFriendsSuggestion($user): Collection;

    public function getPostsSuggestion($user): Builder;
}
