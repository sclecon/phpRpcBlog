<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel
{
    const CREATED_AT = 'dateline';

    const UPDATED_AT = 'dateline_up';

    protected $attributes = ['status'=>1];

    protected $dateFormat = 'U';

    public function fromDateTime($value)
    {
        $timestamp = strtotime(''.$value);
        return "{$timestamp}";
    }

}
