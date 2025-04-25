<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceRechargeCardBill extends Model
{
    protected $table = 'balance_recharge_card_bills';
    protected $fillable = [
        'user_id',
        'number',
        'serial',
        'mobile_carrier',
        'amount_fake', // Mệnh giá thẻ do người dùng nhập vào
        'amount_real', // Mệnh giá thực tế của thẻ do API trả về
        'balance_added', // Số tiền được cộng vào tài khoản sau khi nạp thành công
        'balance_before',
        'balance_after',
        'note',
        'trans_id',
        'status',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
