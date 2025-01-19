<?php

use \Symfony\Component\HttpFoundation\Response;
use App\Actions\Pages\WelcomePage;

covers(WelcomePage::class);

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(Response::HTTP_OK);
});
