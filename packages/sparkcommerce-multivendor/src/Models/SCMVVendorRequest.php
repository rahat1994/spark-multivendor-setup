<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use Illuminate\Database\Eloquent\Model;

class SCMVVendorRequest extends Model
{
    protected $fillable = ['name', 'email', 'meta', 'user_id'];

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
        return config('sparkcommerce-multivendor.table_prefix') . 'vendor_requests';
    }
}
