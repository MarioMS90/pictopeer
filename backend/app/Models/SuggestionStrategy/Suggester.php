<?php

namespace App\Models\SuggestionStrategy;

use Illuminate\Support\Collection;

interface Suggester
{
    public function getFriendsSuggestion($user): Collection;

    public function getPostsSuggestion($user): Collection;
}
