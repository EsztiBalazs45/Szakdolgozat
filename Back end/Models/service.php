<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'service_name',
        'service_description',
        'service_price',
    ];
    /**
     * Get the service_users that owns the service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_users(): BelongsTo
    {
        return $this->belongsTo(service_user::class, 'service_user', 'id'); 
    }



    
}
