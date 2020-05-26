<?php

namespace App\Module\Partner\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Partner
 * @package App\Module\Partner\Entity
 *
 * @property string $name
 * @property string $email
 */
class Partner extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];
}
