<?php

namespace App\Presenters;

use App\Transformers\PocketTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PocketPresenter.
 *
 * @package namespace App\Presenters;
 */
class PocketPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PocketTransformer();
    }
}
