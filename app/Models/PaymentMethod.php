<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    const METHOD_CASH_ON_DELIVERY = 'cash_on_delivery';
    const METHOD_BIKASH = 'bikash';
    const METHOD_SSL_COMMERCE = 'ssl_commerce';
    const METHOD_NAGAD = 'nagad';
}
