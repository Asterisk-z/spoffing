<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function domains()
    {
        return $this->hasMany(OrgDomain::class, 'organization_id', 'id');
    }

}
