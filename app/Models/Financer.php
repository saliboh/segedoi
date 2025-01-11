<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financer extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'total',
        'date_released',
        'term_in_months',
        'interest',
        'total_after_interest',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function getFinancerNameAttribute()
    {
        $formattedTotal = number_format($this->total, 2);
        return "(ID: $this->id) : {$this->user->email} : {$formattedTotal}";
    }
}
