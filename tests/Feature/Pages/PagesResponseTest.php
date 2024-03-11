<?php

use App\Models\Course;
use App\Models\User;

it('gives back successful response for home page', function () {
    $this->get(route('pages.home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    $course = Course::factory()
        ->released()
        ->create();

    $this->get(route('pages.course-details', $course))
        ->assertOk();
});

it('gives back successful response for dashboard age', function () {
    // Act
    loginAsUser();

    $this->get(route('pages.dashboard'))
        ->assertOk();

    // Assert
});
