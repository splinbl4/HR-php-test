<?php

declare(strict_types=1);

namespace App\Module\Order\Entity;

use App\Module\Partner\Entity\Partner;
use App\Module\Product\Entity\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Order
 * @package App\Module\Order\Entity
 *
 * @property-read   int $id
 * @property        int $status
 * @property        string $client_email
 * @property        int $partner_id
 * @property-read   Partner $partner
 * @property        Carbon $delivery_dt
 * @property-read   Carbon $created_at
 * @property-read   Carbon $updated_at
 * @property-read   Product[]|Collection $products
 */
class Order extends Model
{
    public const STATUS_NEW = 0;
    public const STATUS_CONFIRMED = 10;
    public const STATUS_DONE = 20;

    protected $fillable = [
        'status',
        'client_email',
        'partner_id',
        'delivery_dt',
    ];

    protected $dates = ['delivery_dt'];

    public static array $statusMap = [
        self::STATUS_NEW => 'new',
        self::STATUS_CONFIRMED => 'confirmed',
        self::STATUS_DONE => 'done'
    ];

    /**
     * @return string|null
     */
    public function getStatusName(): ?string
    {
        if (isset(self::$statusMap[$this->status])) {
            return self::$statusMap[$this->status];
        }

        return null;
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot(['quantity', 'price'])
            ->orderBy('created_at')
            ->withTimestamps();
    }

    public function partner() : BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function getPrice() : int
    {
        return $this->products->sum( function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }

    public function isCompleted(): bool
    {
        return (int)$this->status === self::STATUS_DONE;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('delivery_dt', '<', Carbon::now())
            ->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCurrent(Builder $query): Builder
    {
        return $query->whereBetween('delivery_dt', [Carbon::now(), Carbon::now()->addHours(24)])
            ->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNew(Builder $query): Builder
    {
        return $query->where('delivery_dt', '>', Carbon::now())
            ->where('status', self::STATUS_NEW);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeDone(Builder $query): Builder
    {
        return $query->whereBetween('delivery_dt', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->where('status', self::STATUS_DONE);
    }
}
