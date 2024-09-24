<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'role',
        'balance',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    public function GameAccount()
    {
        return $this->hasMany(game_account::class);
    }

    public function BillAccount()
    {
        return $this->hasMany(account_bill::class);
    }

    public function BillRecharge()
    {
        return $this->hasMany(recharge_bill::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(reroll_bill::class);
    }

    public function BalanceRechargeBankBill()
    {
        return $this->hasMany(balance_recharge_bank_bill::class);
    }

    public function BalanceRechargeCardBill()
    {
        return $this->hasMany(balance_recharge_card_bill::class);
    }

    public function ContributorCommission()
    {
        return $this->hasMany(contributor_commission::class);
    }
}
