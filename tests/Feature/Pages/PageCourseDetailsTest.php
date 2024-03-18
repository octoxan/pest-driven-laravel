<?php

use App\Models\Course;
use App\Models\Video;

it('does not find unreleased course', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertNotFound();
});

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->released()
        ->create();

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings,
        ])
        ->assertSee(asset("images/$course->image_name"));
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->released()
        ->create();

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});

it('includes paddle checkout button', function () {
    // Arrange
    config()->set('services.paddle.vendor-id', 'vendor-id');

    $course = Course::factory()
        ->released()
        ->create([
            'paddle_product_id' => 'product-id',
        ]);

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee('<script src="https://cdn.paddle.com/paddle/paddle.js"></script>', false)
        ->assertSee('Paddle.Setup({', false)
        ->assertSeeInOrder([
            '<a href="#!"',
            'data-product="product-id"',
            'data-theme="none"',
            'class="paddle_button',
        ], false);
});

it('includes title', function () {
    // Arrange
    $course = Course::factory()->released()->create();
    $expectedTitle = config('app.name').' - '.$course->title;

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee("<title>$expectedTitle</title>", false);
});

it('includes social tags', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    $this->get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSee([
            '<meta property="og:title" content="'.$course->title.'">',
            '<meta property="og:description" content="'.$course->description.'">',
            '<meta property="og:image" content="'.asset('images/advanced_laravel.png').'">',
            '<meta property="og:url" content="'.route('pages.course-details', $course).'">',
            '<meta name="twitter:card" content="summary_large_image">',
            '<meta name="twitter:title" content="'.$course->title.'">',
            '<meta name="twitter:description" content="'.$course->description.'">',
            '<meta name="twitter:image" content="'.asset('images/advanced_laravel.png').'">',
        ], false);
});
