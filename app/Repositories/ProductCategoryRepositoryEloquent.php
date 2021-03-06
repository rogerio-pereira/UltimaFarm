<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductCategoryRepository;
use App\Models\ProductCategory;
use App\Validators\ProductCategoryValidator;

/**
 * Class ProductCategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProductCategoryRepositoryEloquent extends BaseRepository implements ProductCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Generate Array to be used in comboboxes
     * @return array Title,ID
     */
    public function comboboxList()
    {
        return $this->model->pluck('title', 'id');
    }

    /**
     * Generate Array to be used in comboboxes
     * @return array Title,ID
     */
    public function subcategoriesComboboxList($id)
    {
        return $this->model->find($id)->subcategories->pluck('title', 'id');
    }
}
