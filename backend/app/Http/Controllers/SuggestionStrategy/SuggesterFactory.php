<?php

namespace App\Http\Controllers\SuggestionStrategy;

use App\Models\Hashtag;
use InvalidArgumentException;

class SuggesterFactory
{
    const DEFAULT_SUGGESTER = 1;
    const MUTUAL_FRIENDS_SUGGESTER = 2;
    const HASHTAGS_SUGGESTER = 3;

    public static function getSuggester($type): Suggester
    {
        switch ($type) {
            case self::DEFAULT_SUGGESTER:
                return new DefaultSuggester();
            case self::MUTUAL_FRIENDS_SUGGESTER:
                return new MutualFriendsSuggester();
            case self::HASHTAGS_SUGGESTER:
                return new HashtagsSuggester();
            default:
                throw new InvalidArgumentException("{$type} is not a valid suggester type");
        }
    }
}
