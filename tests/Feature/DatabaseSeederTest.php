<?php

use App\Models\Course;

it('adds given courses', function () {
    // Assert
    $this->assertDatabaseCount('courses', 0);

    // Act
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount('courses', 3);
    $this->assertDatabaseHas('courses', ['title' => 'Laravel For Beginners']);
    $this->assertDatabaseHas('courses', ['title' => 'Advanced Laravel']);
    $this->assertDatabaseHas('courses', ['title' => 'TDD The Laravel Way']);
});

it('adds given courses only once', function () {
    // Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Course::class, 3);
});

it('adds given videos', function () {
    // Arrange

    // Act && Assert

});

it('adds given videos only once', function () {
    // Arrange

    // Act && Assert

});
