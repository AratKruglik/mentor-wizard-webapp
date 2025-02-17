<?php

use App\Actions\Auth\Reset\ResetPassword;
use App\Http\Requests\Auth\Reset\ResetPasswordRequest;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

mutates(ResetPassword::class);

describe('ResetPassword Action', function () {
    beforeEach(function () {
        $this->seed(RoleSeeder::class);
        $this->user = User::factory()->create();
    });

    it('sends password reset link successfully', function () {
        $user = User::factory()->create();
        $action = new ResetPassword();

        Password::shouldReceive('sendResetLink')
            ->with(['email' => $user->email])
            ->once()
            ->andReturn(Password::RESET_LINK_SENT);

        $request = new ResetPasswordRequest([
            'email' => $user->email
        ]);

        $response = $action->handle($request);

        expect($response)->toBeInstanceOf(RedirectResponse::class)
            ->and($response->getSession()->get('status'))->toBe(trans(Password::RESET_LINK_SENT));
    });

    it('throws validation exception when reset link fails', function () {
        $user = User::factory()->create();
        $action = new ResetPassword();

        Password::shouldReceive('sendResetLink')
            ->with(['email' => $user->email])
            ->once()
            ->andReturn(Password::RESET_THROTTLED);

        $request = new ResetPasswordRequest([
            'email' => $user->email
        ]);

        $this->expectException(ValidationException::class);
        $action->handle($request);
    });
});
