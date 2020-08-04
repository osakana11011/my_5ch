<?php
declare(strict_types=1);

namespace App\Infrastructure\Database;

use Illuminate\Database\Eloquent\Model;
use App\Infrastructure\Database\Response;


class Thread extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function responses()
    {
        return $this->hasMany('App\Infrastructure\Database\Response');
    }

    /**
     * スレッドの検索を行う。
     *
     * @param string $q
     * @return Collection[Thread]
     */
    public static function search(string $q): object
    {
        $threadIDs = self::select('thread_id')
            ->where('title', 'LIKE', "%${q}%")
            ->join('responses', 'threads.id', '=', 'responses.thread_id')
            ->orWhere(function($query) use ($q) {
                return $query->where('responses.content', 'LIKE', "%${q}%");
            })
            ->groupBy('thread_id')
            ->get();

        $threads = self::whereIn('id', $threadIDs)
            ->get()
            ->map(function ($thread) use ($q) {
                $thread->resList = Response::search($thread->id, $q);
                return $thread;
            });

        return $threads;
    }
}
