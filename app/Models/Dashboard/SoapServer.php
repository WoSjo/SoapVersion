<?php

namespace SoapVersion\Models\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SoapVersion\Models\User;

class SoapServer extends Model
{
    /** @var array */
    protected $fillable = [
        'name',
        'slug',
        'host',
        'port'
    ];

    /** @var array */
    protected $dates = [
        'deleted_at'
    ];

    /** @var array */
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'host' => 'string',
        'port' => 'integer',
    ];

    /**
     * @param string $slug
     */
    public function setSlugAttribute(string $slug): void
    {
        $this->attributes['slug'] = str_slug($slug);
    }

    /**
     * @param string $host
     */
    public function setHostAttribute(string $host): void
    {
        $this->attributes['host'] = encrypt($host);
    }

    /**
     * @return string
     */
    public function getHostAttribute(): string
    {
        return decrypt($this->host);
    }

    /**
     * @param Builder $query
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function scopeByUserId(Builder $query)
    {
        return $query->has('user')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
