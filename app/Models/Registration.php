<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','address','mobile_number','email','gender',
        'dob','height','weight','referred_by','has_insurance','has_health_issue',
        'health_issue_details','profession_type','profession_description',
        'business_name','business_details','registration_type','terms'
    ];

    protected $casts = [
        'dob'    => 'date',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'terms'  => 'boolean',
    ];
}