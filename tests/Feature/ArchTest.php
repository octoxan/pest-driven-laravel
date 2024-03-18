<?php

use Illuminate\Support\Facades\Validator;

it('finds missing debug statements', function () {
    // Act & Assert
    expect(['dd', 'dump', 'ray', 'var_dump'])
        ->not
        ->toBeUsed();
});

// You must use the request validation and not the facade
it('does not use validator facade', function () {
    expect(Validator::class)
        ->not
        ->toBeUsed()
        ->ignoring('App\Actions\Fortify');
});
