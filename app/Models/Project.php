<?php

namespace App\Models;

use App\Enums\ProjectVisibility;
use App\Traits\Visitable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Project extends BaseModel
{
    use Visitable;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'creator_id',
        'total_earned',
        'total_wanted',
        'project_status_id',
        'description',
        'short_description',
        'featured',
        'thumbnail',
        'start_date',
        'end_date',
        'order',
        'visibility',
        'accept_donation',
        'show_in_home_page',
        'show_in_shop',
        'is_gift',
        'category_id',
        'sub_category_id',
        'active',
        'show_in_menu',
        'hidden',
        'donation_available',
        'country_id',
        'share_value',
        'show_donation_comment',
        'donation_comment',
        'is_zakat',
        'show_donor_phone',
        'donor_phone_required',
        'show_donor_name',
        'donor_name_required',
        'show_banner',
        'is_continuous',
        'is_full_unit',
        'is_multi_country',
        'is_stock',
        'is_quick_donation',
        'unit_value',
        'stock',
        'show_timer',
        'show_target_amount',
        'show_paid_amount',
        'show_percentage',
        'main_image',
        'banner_image',
        'highlighted',
        'is_project_case',
        'suggested_values',
        'video'
    ];

    protected array $dates = ['start_date', 'end_date'];

    protected $casts = [
        'visibility' => ProjectVisibility::class,
        'amount_variant' => 'array',
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn(?string $value, array $attributes) => $value ?: Str::slug($attributes['name'])
        );
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status_id');
    }

    protected function visibility(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => ProjectVisibility::from($value)->name
        );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function album()
    {
        return $this->belongsToMany(Album::class, 'album_projects');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class)->withPivot('total_wanted', 'suggested_values');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function languageProjects()
    {
        return $this->hasMany(LanguageProject::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProjectGallery::class);
    }

    protected function amountVar(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($this->amount_variant, true),
            set: fn($value) => json_encode($this->amount_variant),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function division()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function currentLanguage()
    {
        $language = Language::where('short_name', app()->getLocale())->first();
        return $this->languageProjects->where('language_id', $language?->id)->first();
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function getUniqueColumns()
    {
        return ['name','slug'];
    }

    // create links upon project creation
    public static function boot()
    {
        parent::boot();

        static::created(function ($project) {
            $social_medias = SocialMedia::all();
            foreach($social_medias as $social_media) {
                Link::generate($project, 1, $social_media->name);
            }
        });
    }

    /**
     * The projects that belong to the campaign.
     */
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_projects');
    }

}
