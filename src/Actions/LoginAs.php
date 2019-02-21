<?php

namespace Coderello\LoginAs\Actions;

use Closure;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class LoginAs extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The callback used to authorize viewing the action.
     * The callback used to determine where to redirect after logging as a user.
     *
     * @var \Closure|null
     */
    public $redirectToCallback;

    public function __construct()
    {
        $this->name = __('Login As');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $user = $models->first();

        Auth::login($user, true);

        return Action::redirect(
            collect([
                $this->redirectToCallback ? ($this->redirectToCallback)($user) : null,
                app('router')->has('home') ? route('home') : null,
                '/',
            ])->filter()->first()
        );
    }

    /**
     * Set the callback to determine where to redirect after logging as a user.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function redirectTo(Closure $callback)
    {
        $this->redirectToCallback = $callback;

        return $this;
    }
}
