<?php namespace App\Models;

use App\Entities\BaseEntityCollection;
use App\Entities\BusinessPartner;

class Products extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['title','description','price','image','category','created_by'];

    /**
     * @return BaseEntityCollection
     */
    public function findAllProducts() {
        $attr = static::all()->toArray();
        return new BaseEntityCollection($attr, 'App\Entities\BusinessPartner');
    }

    /**
     * @param $id
     * @return BusinessPartner
     */
    public function findById($id) {
        $attr = static::find($id)->toArray();
        return new BusinessPartner($attr);
    }
}
