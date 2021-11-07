<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Pocket.
 *
 * @package namespace App\Models;
 */
class Pocket extends Model implements Transformable
{
    use TransformableTrait;
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'status'];

}
