<?php

use App\Actions\Auth\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

mutates(Logout::class);

describe('Logout Action', function () {

    it('logs out the user', function () {
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('session->invalidate')->once();
        $request->shouldReceive('session->regenerateToken')->once();

        $logout = new Logout();

        Auth::shouldReceive('guard')->with('web')
            ->once()
            ->andReturnSelf();
        Auth::shouldReceive('logout')->once();

        $result = $logout->handle($request);

        expect($result)->toBeInstanceOf(RedirectResponse::class)
            ->and($result->getTargetUrl())->toBe(route('login'));
    });
});
