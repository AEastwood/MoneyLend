<?php

namespace App\Models;

use App\Models\Payments\Loan;
use App\Models\Payments\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    /**
     * get full name attribute
     *
     * @param string|null $original
     * @return string
     */
    public function getFullnameAttribute(?string $original): string
    {
        return "$this->first_name $this->last_name" ?? $original;
    }

    /**
     * return how much lender owes
     *
     * @return string
     */
    public function getOutstandingLoansAttribute(): string
    {
        $loanAmount = $this->loans->sum('amount');
        $paymentAmount = $this->payments->sum('amount');
        return number_format($loanAmount - $paymentAmount, 2);
    }

    /**
     * @return HasMany
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
