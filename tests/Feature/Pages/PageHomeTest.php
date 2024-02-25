<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    // Arrange
    $courses = Course::factory()->count(3)->released()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSeeTextInOrder([
            $courses[0]->title,
            $courses[0]->description,
            $courses[1]->title,
            $courses[1]->description,
            $courses[2]->title,
            $courses[2]->description,
        ]);
});

it('shows only released courses', function () {
    // Arrange
    $releasedCourse = Course::factory()->released()->create();
    $unreleasedCourse = Course::factory()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSeeText($releasedCourse->title)
        ->assertDontSeeText($unreleasedCourse->title);
});

it('shows courses sorted by release date', function () {
    // Arrange
    $releasedCourse = Course::factory()->released(now()->subDays(2))->create();
    $newestCourse = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSeeTextInOrder([
            $newestCourse->title,
            $releasedCourse->title,
        ]);
});
