<?php

use App\Models\Course;
use App\Models\User;
use function Pest\Laravel\get;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('gives back successful response for home page', function () {
    get(route('pages.home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    $course = Course::factory()
        ->released()
        ->create();

    get(route('pages.course-details', $course))
        ->assertOk();
});

it('gives back successful response for dashboard age', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk();

    // Assert
});
