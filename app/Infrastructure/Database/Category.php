<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
