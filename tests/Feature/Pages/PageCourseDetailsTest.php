<?php

use App\Models\Course;
use App\Models\Video;
use Juampi92\TestSEO\TestSEO;

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

    $response = $this->get(route('pages.course-details', $course))
        ->assertOk();

    // Act & Assert
    $seo = new TestSEO($response->getContent());

    expect($seo->data)
        ->title()->toBe($expectedTitle);
});

it('includes social tags', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Assert
    $response = $this->get(route('pages.course-details', $course))
        ->assertOk();

    $seo = new TestSEO($response->getContent());

    expect($seo->data)
        ->openGraph()->url->toBe(route('pages.course-details', $course));
});

it('I will get around to this eventually?', function () {
    // Arrange

    // Act && Assert

})->todo();
