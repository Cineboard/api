<?php declare(strict_types=1);
/**
 * PHP version 7
 * User Model
 */

namespace Cineboard\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Map user to model
 *
 * @package Cineboard\Model
 * @uses Collection
 */
class User extends Model
{
    protected $table = 'user';
}
