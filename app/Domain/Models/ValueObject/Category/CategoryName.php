<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject\Category;

use Exception;


/**
 * カテゴリ名
 *   - 20文字以内の文字列
 */
final class CategoryName
{
    public $value;

    public function __construct(string $categoryName)
    {
        if (empty($categoryName) || mb_strlen($categoryName) > 20) {
            throw new Exception("categoryName: ${categoryName} is invalidate.");
        }

        $this->value = $categoryName;
    }
}
