<?php

namespace App\Models;

use App\Enums\GalleryProjectStatus;
use App\Enums\GalleryProjectType;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectGallery extends BaseModel
{
    protected $table = 'project_gallery';

    protected $fillable = [
        'project_id',
        'path',
        'status',
        'type',
        'file'
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => GalleryProjectStatus::from($value)->name
        );
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => GalleryProjectType::from($value)->name
        );
    }
}
