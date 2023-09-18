<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SourceType extends Enum
{
    const FILM = 1;
    const POSTER_FILM = 2;
    const IMAGE_FILM = 3;
}
