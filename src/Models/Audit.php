<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string $tags
 * @property string $event
 * @property array $new_values
 * @property array $old_values
 * @property mixed $user
 * @property mixed $auditable.
 */
class Audit extends Model implements \OwenIt\Auditing\Contracts\Audit
{
    use \OwenIt\Auditing\Audit;

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old_values'   => 'json',
        'new_values'   => 'json',
        // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
    ];

    /**
     * @param \DateTimeInterface $date
     * @return string
     */
    public function getSerializedDate($date)
    {
        return $this->serializeDate($date);
    }
}
