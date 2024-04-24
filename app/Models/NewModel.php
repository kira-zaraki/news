<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewModel extends Model
{
    use HasFactory;

    /**
     * New is a reserved name i named the model new to NewModel entity to quickly deliver the test
     **/
    protected $table = 'news';
    protected $guarded = [''];

    public function scopeNotExpired(Builder $query): void
    {
        $query->whereNull('date_expiration')->orWhere('date_expiration', '>=', Carbon::today());
    }
}
