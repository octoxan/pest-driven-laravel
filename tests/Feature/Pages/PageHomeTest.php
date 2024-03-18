<?php

use App\Models\Course;

it('shows courses overview', function () {
    // Arrange
    $courses = Course::factory()->count(3)->released()->create();

    // Act & Assert
    $this->get(route('pages.home'))
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
    $this->get(route('pages.home'))
        ->assertSeeText($releasedCourse->title)
        ->assertDontSeeText($unreleasedCourse->title);
});

it('shows courses sorted by release date', function () {
    // Arrange
    $releasedCourse = Course::factory()->released(now()->subDays(2))->create();
    $newestCourse = Course::factory()->released()->create();

    // Act & Assert
    $this->get(route('pages.home'))
        ->assertSeeTextInOrder([
            $newestCourse->title,
            $releasedCourse->title,
        ]);
});

it('includes login if not logged in', function () {
    // Act & Assert
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

it('does not find JetStream registration page', function () {
    // Act & Assert
    $this->get('register')
        ->assertNotFound();
});

it('includes courses links', function () {
    // Arrange
    $firstCourse = Course::factory()->released()->create();
    $secondCourse = Course::factory()->released()->create();
    $lastCourse = Course::factory()->released()->create();

    // Act & Assert
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSeeInOrder([
            route('pages.course-details', $firstCourse),
            route('pages.course-details', $secondCourse),
            route('pages.course-details', $lastCourse),
        ]);
});

it('includes title', function () {
    // Arrange
    $expectedTitle = config('app.name').' - Home';

    // Act & Assert
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSee("<title>$expectedTitle</title>", false);
});

it('includes social tags', function () {
    // Arrange

    // Act & Assert
    $this->get(route('pages.home'))
        ->assertOk()
        ->assertSee([
            '<meta property="og:title" content="'.config('app.name').'">',
            '<meta property="og:description" content="'.config('app.name').'">',
            '<meta property="og:image" content="'.asset('images/advanced_laravel.png').'">',
            '<meta property="og:url" content="'.route('pages.home').'">',
            '<meta name="twitter:card" content="summary_large_image">',
            '<meta name="twitter:title" content="'.config('app.name').'">',
            '<meta name="twitter:description" content="'.config('app.name').'">',
            '<meta name="twitter:image" content="'.asset('images/advanced_laravel.png').'">',
        ], false);
});
