<?php declare(strict_types=1);
/**
 * PHP version 7
 * Library Model
 */

namespace Cineboard\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Map library to model
 * @package Cineboard\Model
 */
class Library extends Model
{
    protected $table = 'library';

    /**
     * One to Many - request user id for library
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(
            "Cineboard\Model\User",
            "id",
            "user_id"
        );
    }

    /**
     * Belongs to Many - associate library id to category
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            "Cineboard\Model\Category",
            "library_category"
        );
    }
}
