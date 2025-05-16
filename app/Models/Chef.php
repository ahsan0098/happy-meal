<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'image',
        'is_featured'
    ];

    public function getNameAttribute(){
        return $this->first_name . " ". $this->last_name;
    }
}
