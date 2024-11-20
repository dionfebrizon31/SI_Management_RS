<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jabatans extends Model
{
    public $timestamps = false;

    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }

    
    public function jobdesks(): HasMany
    {
        return $this->HasMany(Jobdesk::class);
    }

}
