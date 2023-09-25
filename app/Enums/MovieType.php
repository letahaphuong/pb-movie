<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MovieType extends Enum
{
    const FEATURE_FILM = 1;
    const TV_SERIES = 2;
    const THEATRICAL_FILM = 3;
}
