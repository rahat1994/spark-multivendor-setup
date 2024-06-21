<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use Illuminate\Database\Eloquent\Model;

class SCMVPayoutRequest extends Model
{
    protected $fillable = [
        'name',
        'user_id',
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
        return config('sparkcommerce-multivendor.table_prefix') . 'payout_requests';
    }
}
