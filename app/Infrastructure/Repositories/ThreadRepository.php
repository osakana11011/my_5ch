<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositries;

use App\Infrastructure\Database\Thread as PersistantThread;
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
            return $this->translatePersistantToDomainModel($threadRecord);
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
        return $this->translatePersistantToDomainModel($threadRecord);
    }

    /**
     * スレッドタイトルを受け取り、スレッドを作成する。
     *
     * @param ThreadTitle $threadTitle
     */
    public function create(ThreadTitle $threadTitle): void
    {
        PersistantThread::create([
            'title' => $threadTitle->value,
        ]);
    }

    /**
     * 永続化用threadsレコードをドメインモデルへ変換する。
     *
     * @param PersistantThread $threadRecord
     * @return Thread
     */
    private function translatePersistantToDomainModel(PersistantThread $threadRecord): Thread
    {
        $id = !empty($threadRecord->id) ? new ThreadID($threadRecord->id) : null;
        $title = !empty($threadRecord->title) ? new ThreadTitle($threadRecord->title) : null;
        $parentThreadID = !empty($threadRecord->parent_thread_id) ? new ThreadID($threadRecord->parent_thread_id) : null;

        return new Thread($title, $id, $parentThreadID);
    }
}
