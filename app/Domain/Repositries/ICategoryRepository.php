<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Entities\Category;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Category\CategoryID;
use App\Domain\Models\ValueObject\Category\CategoryName;


interface ICategoryRepository
{
    public function create(Category $category): void;
    public function getByThreadID(ThreadID $threadID): array;
}
