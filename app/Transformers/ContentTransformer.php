<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Content;

/**
 * Class ContentTransformer.
 *
 * @package namespace App\Transformers;
 */
class ContentTransformer extends TransformerAbstract
{
    /**
     * Transform the Content entity.
     *
     * @param \App\Models\Content $model
     *
     * @return array
     */
    public function transform(Content $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
