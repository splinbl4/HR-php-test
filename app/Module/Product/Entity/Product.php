<?php

namespace App\Module\Product\Entity;

use App\Module\Vendor\Entity\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 * @package App\Module\Product\Entity
 *
 * @property string $name
 * @property int $price
 * @property-read Vendor $vendor
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'vendor_id'
    ];

    public function vendor() : BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
