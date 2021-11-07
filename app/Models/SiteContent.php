<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SiteContent.
 *
 * @package namespace App\Models;
 */
class SiteContent extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pocket_id', 'site_url'];


    protected $table = "pocket_sites";


    public function contents()
    {
        return $this->hasOne(Content::class, 'site_id', 'id');
    }


    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'sites_tags',
            'site_id',
            'tag_id'
        );
    }
}
