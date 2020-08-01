<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\ICategoryRepository;
use App\Domain\Models\Entities\Category;
use App\Domain\Models\ValueObject\Category\CategoryName;


final class CategoryService
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * スレッドにレスを投稿する。
     *
     * @param string $categoryName
     */
    public function createCategory(string $categoryName): void
    {
        $categoryName = new CategoryName($categoryName);
        $category = new Category($categoryName);
        $this->categoryRepository->create($category);
    }
}
