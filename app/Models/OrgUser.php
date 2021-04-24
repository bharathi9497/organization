<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgUser extends Model
{
    use HasFactory;
    protected $table = 'orgusers';
    protected $fillable = [
        'org_id',
        'name',
        'email',
        'mobile_number',
        'address',
    ];
}
