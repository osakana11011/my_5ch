<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use Illuminate\Database\Eloquent\Model;


class Categorizing extends Model
{
    protected $table = 'categorizing';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo('App\Infrastructure\Database\Category');
    }
}
