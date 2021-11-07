<?php

namespace App\Presenters;

use App\Transformers\SiteContentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SiteContentPresenter.
 *
 * @package namespace App\Presenters;
 */
class SiteContentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SiteContentTransformer();
    }
}
