<?php

namespace SoapVersion\Models\Version;

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

    protected $casts = [
        'compare' => 'boolean',
    ];

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
        return $this->hasOne(Version::class);
    }
}
