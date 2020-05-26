<?php

namespace App\Module\Vendor\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * @package App\Module\Vendor\Entity
 *
 * @property string $name
 * @property string $email
 */
class Vendor extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];
}

