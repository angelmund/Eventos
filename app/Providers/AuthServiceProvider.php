<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url){
            return (new MailMessage)
                ->subject('Verificar cuenta')
                ->line('Tu cuenta  ya está casi terminada, solo debes presionar el botón de confirmar cuenta')
                ->line('Haga clic en el botón de abajo para verificar su cuenta')
                ->action('Confirmar cuenta', $url)
                ->line('Si no create esta cuenta , puedes ignorar el botón mensaje');
        });
    }
}