<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use CrudTrait;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'financer_id',
        'total',
        'interest',
        'term_in_months',
        'payment_frequency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function financer()
    {
        return $this->belongsTo(Financer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getUserLoanAttribute()
    {
        return "(Loan ID # {$this->id}) : Client - {$this->user->email}";
    }
}
