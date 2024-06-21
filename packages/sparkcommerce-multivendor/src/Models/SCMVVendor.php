<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Rahat1994\SparkCommerce\Models\SCProduct;

class SCMVVendor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'meta',
        'user_id',
        'slug',
        'category',
        'contact_number',
    ];

    protected $casts = [
        'name' => 'string',
        'user_id' => 'integer',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('sparkcommerce-multivendor.table_prefix') . 'vendors';
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'sc_mv_user_vendor', 'vendor_id', 'user_id');
    }

    public function sCProducts()
    {
        return $this->hasMany(SCProduct::class, 'vendor_id', 'id');
    }

    public function SCCategories()
    {
        return $this->hasMany(SCProduct::class, 'vendor_id', 'id');
    }
}
