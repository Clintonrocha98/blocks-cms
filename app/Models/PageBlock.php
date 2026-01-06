<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'type', 'position', 'data'];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }
}
