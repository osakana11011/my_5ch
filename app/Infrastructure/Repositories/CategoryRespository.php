<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositries;

use App\Infrastructure\Database\Category as PersistantCategory;
use App\Domain\Models\Entities\Category;
use App\Domain\Models\ValueObject\Category\CategoryID;
use App\Domain\Models\ValueObject\Category\CategoryName;
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
