<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositries;

use App\Infrastructure\Database\Response as PersistantResponse;
use App\Domain\Models\Entities\Res;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Res\ResID;
use App\Domain\Models\ValueObject\Res\ResContent;
use App\Domain\Models\ValueObject\Res\ResSubmitterName;
use App\Domain\Repositories\IResRepository;


final class ResRepository implements IResRepository
{
    public function getByThreadID(ThreadID $threadID): array
    {
        $id = $threadID->value;
        return PersistantResponse::where('thread_id', $id)
            ->get()
            ->map(function ($responseRecord) {
                return self::translatePersistantToDomainModel($responseRecord);
            })
            ->toArray();
    }

    public function create(Res $res): void
    {
        PersistantResponse::create([
            'thread_id' => $res->threadID->value,
            'submitter_name' => $res->submitterName->value,
            'content' => $res->content->value,
        ]);
    }

    /**
     * 永続化用responseレコードをドメインモデルへ変換する。
     *
     * @param PersistantRes $threadRecord
     * @return Res
     */
    public static function translatePersistantToDomainModel(PersistantResponse $responseRecord): Res
    {
        return new Res(
            new ThreadID($responseRecord->thread_id),
            new ResContent($responseRecord->content),
            new ResSubmitterName($responseRecord->submitter_name),
            new ResID($responseRecord->id),
            $responseRecord->created_at
        );
    }
}
