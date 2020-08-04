<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use Illuminate\Database\Eloquent\Model;


class Response extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * レスの検索を行う。
     *
     * @param int $threadID
     * @param string $q
     * @return Collection[Response]
     */
    public static function search(int $threadID, string $q): object
    {
        return self::where('thread_id', $threadID)
            ->where('content', 'LIKE', "%${q}%")
            ->get();
    }
}
