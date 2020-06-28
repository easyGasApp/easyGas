<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Supply;

/**
 * Class SupplyTransformer.
 *
 * @package namespace App\Transformers;
 */
class SupplyTransformer extends TransformerAbstract
{
    /**
     * Transform the Supply entity.
     *
     * @param \App\Entities\Supply $model
     *
     * @return array
     */
    public function transform(Supply $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
