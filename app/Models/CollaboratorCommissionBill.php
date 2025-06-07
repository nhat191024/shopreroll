<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaboratorCommissionBill extends Model
{
    protected $table = 'collaborator_commission_bills';
    protected $fillable = [
        'collaborator_id',
        'account_id',
        'buyer_id',
        'balance_before',
        'balance_after',
        'price',
        'commission_fee',
        'status',
    ];

    public function Collaborator()
    {
        return $this->belongsTo(user::class, 'collaborator_id');
    }

    public function Buyer()
    {
        return $this->belongsTo(user::class, 'buyer_id');
    }

    public function GameAccount()
    {
        return $this->belongsTo(GameAccount::class, 'account_id');
    }
}
