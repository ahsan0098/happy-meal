<?php

namespace App\Models;

use App\Notifications\Visitor\NewsNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['email', 'status'];

    public function sendNewsNotification($data): void
    {
        $this->notify(new NewsNotification(...$data));
    }
}
