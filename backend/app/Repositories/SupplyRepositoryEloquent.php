<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SupplyRepository;
use App\Entities\Supply;
use App\Validators\SupplyValidator;

/**
 * Class SupplyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SupplyRepositoryEloquent extends BaseRepository implements SupplyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Supply::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SupplyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
