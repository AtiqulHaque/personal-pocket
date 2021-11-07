<?php

namespace App\Presenters;

use App\Transformers\ContentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContentPresenter.
 *
 * @package namespace App\Presenters;
 */
class ContentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContentTransformer();
    }
}
