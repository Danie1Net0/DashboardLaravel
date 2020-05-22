<?php

namespace App;

use App\Notifications\Auth\EmailVerificationNotification;
use App\Notifications\Auth\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password',
    ];
    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Notificação personalizada (traduzida) para verificação de cadastro.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification());
    }

    /**
     * Notificação personalizada (traduzida) para recuperação de senha.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Mutator: Retorna o primeiro nome do usuário em formato Camel Case.
     *
     * @param $value
     * @return string
     */
    public function getfirstNameAttribute($value): string
    {
        $firstName = collect(explode(' ', $this->name))->first();
        return Str::ucfirst(Str::lower($firstName));
    }
}
