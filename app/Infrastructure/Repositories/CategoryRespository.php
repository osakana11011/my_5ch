<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositries;

use App\Infrastructure\Database\Category as PersistantCategory;
use App\Infrastructure\Database\Categorizing as PersistantCategorizing;
use App\Domain\Models\Entities\Category;
use App\Domain\Models\ValueObject\Category\CategoryID;
use App\Domain\Models\ValueObject\Category\CategoryName;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Repositories\ICategoryRepository;


final class CategoryRepository implements ICategoryRepository
{
    /**
     * カテゴリデータを永続化ボリュームに作成する。
     *
     * @param Category $category
     */
    public function create(Category $category): void
    {
        PersistantCategory::firstOrCreate(['name' => $category->name->value], ['name' => $category->name->value]);
    }

    /**
     * スレッドIDからそれに紐づくカテゴリデータを取得する。
     *
     * @param ThreadID $threadID
     * @return array
     */
    public function getByThreadID(ThreadID $threadID): array
    {
        return PersistantCategorizing::where('thread_id', $threadID->value)
            ->with('category')
            ->get()
            ->map(function ($categorizingRecord) {
                return $this->translatePersistantToDomainModel($categorizingRecord->category);
            })
            ->toArray();
    }

    /**
     * 永続化用responseレコードをドメインモデルへ変換する。
     *
     * @param PersistantRes $threadRecord
     * @return Res
     */
    private function translatePersistantToDomainModel(PersistantCategory $categoryRecord): Category
    {
        return new Category(
            new CategoryName($categoryRecord->name),
            new CategoryID($categoryRecord->id)
        );
    }
}
