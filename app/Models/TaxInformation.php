<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxInformation extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
        'name',
        'ssn',
        'address',
        'w2_income',
        'self_employment_income',
        'mortgage_interest',
        'charitable_donations',
        'child_tax_credit',
        'education_credit',
        'federal_tax_withheld',
        'state_tax_withheld'
    ];

    // Define a relationship with the User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
