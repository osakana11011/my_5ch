<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositries;

use App\Infrastructure\Database\Thread as PersistantThread;
use App\Infrastructure\Repositries\ResRepository;
use App\Domain\Models\Entities\Thread;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Thread\ThreadTitle;
use App\Domain\Repositories\IThreadRepository;


final class ThreadRepository implements IThreadRepository
{
    /**
     * スレッドの一覧を取得する。
     *
     * @return array
     */
    public function getList(): array
    {
        $threadRecords = PersistantThread::get();
        return $threadRecords->map(function ($threadRecord) {
            return self::translatePersistantToDomainModel($threadRecord);
        })->toArray();
    }

    /**
     * IDからスレッドを検索し返す。
     *
     * @param ThreadID $threadID
     * @return Thread
     */
    public function getByID(ThreadID $threadID): Thread
    {
        $threadRecord = PersistantThread::find($threadID->value);
        return self::translatePersistantToDomainModel($threadRecord);
    }

    /**
     * スレッドタイトルを受け取り、スレッドを作成する。
     *
     * @param ThreadTitle $threadTitle
     * @return Thread
     */
    public function create(ThreadTitle $threadTitle): Thread
    {
        $threadRecord = PersistantThread::create([
            'title' => $threadTitle->value,
        ]);

        return self::translatePersistantToDomainModel($threadRecord);
    }

    /**
     * スレッドの検索を行う。
     *
     * @param
     */
    public function search(string $q): array
    {
        return PersistantThread::search($q)
            ->map(function ($thread) {
                return self::translatePersistantToDomainModel($thread);
            })
            ->toArray();
    }

    /**
     * 永続化用threadsレコードをドメインモデルへ変換する。
     *
     * @param PersistantThread $threadRecord
     * @return Thread
     */
    public static function translatePersistantToDomainModel(PersistantThread $threadRecord): Thread
    {
        $id = !empty($threadRecord->id) ? new ThreadID($threadRecord->id) : null;
        $title = !empty($threadRecord->title) ? new ThreadTitle($threadRecord->title) : null;
        $parentThreadID = !empty($threadRecord->parent_thread_id) ? new ThreadID($threadRecord->parent_thread_id) : null;
        $thread = new Thread($title, $id, $parentThreadID);

        if (!empty($threadRecord->resList)) {
            $thread->resList = $threadRecord->resList
                ->map(function ($response) {
                    return ResRepository::translatePersistantToDomainModel($response);
                })
                ->toArray();
        }

        return $thread;
    }
}
