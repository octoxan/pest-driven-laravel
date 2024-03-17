<?php

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('cannot be accessed by guest', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act && Assert
    $this->get(route('pages.course-videos', $course))
        ->assertRedirect(route('login'));
});

it('includes video player', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act && Assert
    loginAsUser();

    $this->get(route('pages.course-videos', $course))
        ->assertOk()
        ->assertSeeLivewire(VideoPlayer::class);

});

it('shows first course video by default', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act && Assert
    loginAsUser();

    $this->get(route('pages.course-videos', $course))
        ->assertOk()
        ->assertSee("<h3>{$course->videos()->first()->title}", false);
});

it('shows provided course video', function () {
    // Arrange
    $course = Course::factory()
        ->has(
            Video::factory()
                ->count(2)
                ->state(new Sequence(
                    ['title' => 'First Video'],
                    ['title' => 'Second Video'],
                ))
        )
        ->create();

    // Act && Assert
    loginAsUser();

    $this->get(route('pages.course-videos', ['course' => $course, 'video' => $course->videos()->orderByDesc('id')->first()]))
        ->assertOk()
        ->assertSee('Second Video');
});
