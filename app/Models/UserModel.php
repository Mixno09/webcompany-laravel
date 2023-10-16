<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $name
 * @property string $surName
 * @property \App\Models\City $city
 */
class UserModel extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'users_model';
    protected $fillable = ['name', 'surName', 'city_id'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(100)
            ->height(100)
            ->nonQueued();
    }
}
