<?php

namespace SoapVersion\Models\Version;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @return BelongsTo
     */
    public function compareAbleVersion(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }
}
