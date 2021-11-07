<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Pocket;

/**
 * Class PocketTransformer.
 *
 * @package namespace App\Transformers;
 */
class PocketTransformer extends TransformerAbstract
{
    /**
     * Transform the Pocket entity.
     *
     * @param \App\Models\Pocket $model
     *
     * @return array
     */
    public function transform(Pocket $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
