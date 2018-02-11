<?php

namespace SoapVersion\Models\Server;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SoapVersion\Models\Version\Version;

class Endpoint extends Model
{
    const WEEKLY = 1;
    const TWICE_DAILY = 2;
    const DAILY_AT = 3;
    const DAILY = 4;
    const HOURLY = 5;
    const EVERY_FIFTEEN_MINUTES = 6;
    const EVERY_MINUTE = 7;

    const RUN_AT = [
        self::HOURLY,
        self::DAILY,
        self::DAILY_AT,
        self::TWICE_DAILY,
        self::WEEKLY,
        self::EVERY_FIFTEEN_MINUTES,
        self::EVERY_MINUTE,
    ];

    /** @var array */
    protected $fillable = [
        'function',
        'name',
        'data',
    ];

    /** @var array */
    protected $dates = [
        'deleted_at'
    ];

    /** @var array */
    protected $casts = [
        'url' => 'string',
        'name' => 'string',
    ];

    /**
     * @param Builder $query
     * @param Server $server
     * @return Builder
     */
    public function scopeByServer(Builder $query, Server $server)
    {
        return $query->whereHas('server', function (Builder $builder) use ($server) {
            $builder->where('servers.id', $server->getAttribute('id'));
        });
    }

    /**
     * @return BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * @return HasMany
     */
    public function versions(): HasMany
    {
        return $this->hasMany(Version::class);
    }
}
