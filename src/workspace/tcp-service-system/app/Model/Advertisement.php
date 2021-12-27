<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 自增ID
 * @property string $name 广告名称
 * @property string $image 广告图片
 * @property string $url 广告链接
 * @property string $ctype 广告类型
 * @property int $status 广告状态
 * @property int $dateline 时间戳
 * @property int|null $dateline_up 修改时间戳
 */
class Advertisement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'advertisement';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'status' => 'integer', 'dateline' => 'integer'];
}