<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service_user extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceUserFactory> */
    use HasFactory;
    public $timestamps = false;
    /**
     * The user that belong to the service_user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_id','service_id');
    }

}
