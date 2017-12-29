<?php

namespace SoapVersion\Models\Server;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use SoapVersion\Models\User\Group;

class Server extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'slug',
        'host',
        'port',
        'type_id'
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
        return decrypt($this->attributes['host']);
    }

    /**
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return \str_slug($this->attributes['name']);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActiveUser(Builder $query)
    {
        return $query->whereHas('groups', function (Builder $builder) {
            $builder->whereHas('users', function (Builder $userBuilder) {
                $userBuilder->where('users.id', Auth::id());
            });
        });
    }

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
