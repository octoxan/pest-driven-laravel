<?php

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;

function createCourseAndVideos(int $videosCount = 1): Course
{
    return Course::factory()
        ->has(Video::factory()->count($videosCount))
        ->create();
}

it('shows details for given video', function () {
    // Arrange
    $course = createCourseAndVideos();

    $video = $course->videos->first();
    // Act && Assert
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeText([
            $video->title,
            $video->description,
            "{$video->duration_in_min}min",
        ]);
});

it('shows given video', function () {
    // Arrange
    $course = createCourseAndVideos();

    $video = $course->videos->first();
    // Act && Assert
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeHtml('src="https://player.vimeo.com/video/'.$video->vimeo_id.'"');
});

it('shows list of all course videos', function () {
    // Arrange
    $course = createCourseAndVideos(videosCount: 3);

    // Act && Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSeeText([
            ...$course->videos->pluck('title')->toArray(),
        ])
        ->assertSeeHtml([
            route('pages.course-videos', $course->videos->get(1)),
            route('pages.course-videos', $course->videos->get(2)),
        ]);
});

it('does not include route for current video', function () {
    // Arrange
    $course = createCourseAndVideos();

    // Act && Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSeeText([
            ...$course->videos->pluck('title')->toArray(),
        ])
        ->assertDontSeeHtml(route('pages.course-videos', $course->videos->first()));
});

it('marks video as completed', function () {
    // Arrange
    $user = User::factory()->create();
    $course = createCourseAndVideos();

    $user->purchasedCourses()->attach($course);

    // Assert
    expect($user->watchedVideos)->toHaveCount(0);
    // Act
    loginAsUser($user);

    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsCompleted');

    // Assert
    $user->refresh();

    expect($user->watchedVideos)
        ->toHaveCount(1)
        ->first()
        ->title
        ->toEqual($course->videos()->first()->title);
});

it('marks video as not completed', function () {
    // Arrange
    $user = User::factory()->create();
    $course = createCourseAndVideos();

    $user->purchasedCourses()->attach($course);
    $user->watchedVideos()->attach($course->videos()->first());

    // Assert
    expect($user->watchedVideos)->toHaveCount(1);
    // Act
    loginAsUser($user);

    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsNotCompleted');

    // Assert
    $user->refresh();

    expect($user->watchedVideos)
        ->toHaveCount(0);
});
