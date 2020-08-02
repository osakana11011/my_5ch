<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject\Res;

use Exception;


/**
 * レスのID
 *   - 1以上の数値
 */
final class ResID
{
    public $value;

    public function __construct(int $resID)
    {
        if (empty($resID) || $resID <= 0) {
            throw new Exception("resID: ${resID} is invalidated.");
        }

        $this->value = $resID;
    }
}
