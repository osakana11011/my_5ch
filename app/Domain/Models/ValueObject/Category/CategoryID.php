<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject\Category;

use Exception;


/**
 * カテゴリのID
 *   - 1以上の数値
 */
final class CategoryID
{
    public $value;

    public function __construct(?int $categoryID=null)
    {
        if (!is_null($categoryID) && $categoryID <= 0) {
            throw new Exception("categoryID: ${categoryID} is invalidated.");
        }

        $this->value = $categoryID;
    }
}
