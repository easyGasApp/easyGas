<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Route;

/**
 * Class RouteTransformer.
 *
 * @package namespace App\Transformers;
 */
class RouteTransformer extends TransformerAbstract
{
    /**
     * Transform the Route entity.
     *
     * @param \App\Entities\Route $model
     *
     * @return array
     */
    public function transform(Route $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
