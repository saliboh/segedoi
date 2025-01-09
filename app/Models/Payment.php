<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use CrudTrait;
    protected $fillable = [
        'loan_id',
        'total',
        'proof_of_payment_image',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function setProofOfPaymentImageAttribute($value)
    {
        $attribute_name = "proof_of_payment_image";
        $disk = "public"; // The disk to store the file
        $destination_path = "uploads/payments"; // Directory within the disk

        // If a file was uploaded
        if (is_file($value)) {
            // Store the file and save its path
            $this->attributes[$attribute_name] = $value->store($destination_path, $disk);
        } elseif (is_null($value)) {
            // If the field is empty, set its value to null
            $this->attributes[$attribute_name] = null;
        }
    }
}
