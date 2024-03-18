<?php

use App\Console\Commands\TweetAboutCourseRelease;
use App\Models\Course;

it('tweets about release for provided course', function () {
    // Arrange
    Twitter::fake();
    $course = Course::factory()->create();

    // Act
    $this->artisan(TweetAboutCourseRelease::class, ['courseId' => $course->id]);

    // Assert
    Twitter::assertTweetSent("I just released $course->title Check it out on ".route('pages.course-details', $course));
});
