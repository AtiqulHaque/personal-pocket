<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\SiteContent;

/**
 * Class SiteContentTransformer.
 *
 * @package namespace App\Transformers;
 */
class SiteContentTransformer extends TransformerAbstract
{
    /**
     * Transform the SiteContent entity.
     *
     * @param \App\Models\SiteContent $model
     *
     * @return array
     */
    public function transform(SiteContent $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
