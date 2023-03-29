<?php

namespace OwenIt\Auditing\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Tests\database\factories\HasTestFactory;

class Article extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use HasTestFactory;

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'reviewed' => 'bool',
        'config' => 'json',
        'published_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    protected $dates = [
        'published_at',
    ];

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'title',
        'content',
        'published_at',
        'reviewed',
    ];

    public function __construct(array $attributes = [])
    {
        if (class_exists(\Illuminate\Database\Eloquent\Casts\AsArrayObject::class)) {
            $this->casts['config'] = \Illuminate\Database\Eloquent\Casts\AsArrayObject::class;
        }

        parent::__construct($attributes);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'model', 'model_has_categories');
    }

    /**
     * Uppercase Title accessor.
     */
    public function getTitleAttribute(string $value): string
    {
        return strtoupper($value);
    }
}
