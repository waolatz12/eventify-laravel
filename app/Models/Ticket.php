<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'type',
        'quantity',
        'price',
        'ticket_number',
        'company_id',
        'quantity_sold',
        'sale_start',
        'sale_end',
    ];
}
