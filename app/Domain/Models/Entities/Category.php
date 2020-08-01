<?php
declare(strict_types=1);

namespace App\Domain\Models\Entities;

use App\Domain\Models\ValueObject\Category\CategoryID;
use App\Domain\Models\ValueObject\Category\CategoryName;


final class Category
{
    public $id;
    public $name;

    public function __construct(CategoryName $categoryName, ?CategoryID $categoryID=null)
    {
        $this->id = $categoryID;
        $this->name = $categoryName;
    }
}
