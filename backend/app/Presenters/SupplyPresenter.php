<?php

namespace App\Presenters;

use App\Transformers\SupplyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SupplyPresenter.
 *
 * @package namespace App\Presenters;
 */
class SupplyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SupplyTransformer();
    }
}
