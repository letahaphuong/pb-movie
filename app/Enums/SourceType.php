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
    const IMAGE_FILM = 'IMAGE_FILM';
    const POSTER_FILM = 'POSTER_FILM';
    const NORMAL_QUALITY_FILM = 'NORMAL_QUALITY_FILM';
    const HIGH_QUALITY_FILM = 'HIGH_QUALITY_FILM';
}
