<?php

namespace SoapVersion\Models\Version;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use SoapVersion\Models\Server\Endpoint;

class Version extends Model
{
    /** @var array */
    protected $fillable = [
        'compare',
        'endpoint_result',
    ];

    /** @var array */
    protected $dates = [
        'deleted_at',
    ];

    /** @var array */
    protected $casts = [
        'compare' => 'boolean',
    ];

    /** @var array */
    protected $with = [
        'previousVersion'
    ];

    /**
     * @param Builder $query
     * @param Endpoint $endpoint
     * @return Builder
     */
    public function scopeByEndpoint(Builder $query, Endpoint $endpoint)
    {
        return $query->whereHas('endpoint', function (Builder $builder) use ($endpoint) {
            $builder->where('endpoints.id', $endpoint->id);
        });
    }

    /**
     * @return BelongsTo
     */
    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(Endpoint::class);
    }

    /**
     * @return HasOne
     */
    public function compareAbleVersion(): HasOne
    {
        return $this->hasOne(Version::class, 'version_id');
    }

    /**
     * @return BelongsTo
     */
    public function previousVersion(): BelongsTo
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
}
