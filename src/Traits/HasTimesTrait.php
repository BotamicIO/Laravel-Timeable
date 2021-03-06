<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Timeable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Timeable\Traits;

use Artisanry\Timeable\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTimesTrait
{
    public function times(): MorphMany
    {
        return $this->morphMany(Time::class, 'timeable');
    }

    public function addTime($day, $open, $close): bool
    {
        $time = new Time([
            'day'   => $day,
            'open'  => new Carbon($open),
            'close' => new Carbon($close),
        ]);

        return (bool) $this->times()->save($time);
    }
}
