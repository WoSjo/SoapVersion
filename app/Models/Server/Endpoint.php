<?php

namespace SoapVersion\Models\Server;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SoapVersion\Models\Version\Version;

class Endpoint extends Model
{
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
