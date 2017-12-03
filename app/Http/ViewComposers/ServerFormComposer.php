<?php
declare(strict_types=1);

namespace SoapVersion\Http\ViewComposers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SoapVersion\Models\Server\Type;
use SoapVersion\Models\User\Group;

class ServerFormComposer
{
    /** @var Collection */
    private $types;

    public function __construct()
    {
        $this->types = Type::get(['id', 'name'])->pluck('name', 'id');

        $this->groups = Group::whereHas('users', function (Builder $userBuilder): void {
            $userBuilder->where('users.id', Auth::id());
        })->get(['groups.id', 'groups.name'])->pluck('name', 'id');
    }

    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with([
            'types' => $this->types,
            'groups' => $this->groups
        ]);
    }
}
