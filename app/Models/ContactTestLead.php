<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactTestLead extends Model
{
    use HasFactory;

    protected $table = 'contact_test_lead';

    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
