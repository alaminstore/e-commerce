<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PROCESSING = 'processing';
    const STATUS_APPROVED = 'approved';
    const STATUS_ON_SHIPPING = 'on_shipping';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_RETURN = 'return';
    const STATUS_COMPLETE = 'completed';

}
