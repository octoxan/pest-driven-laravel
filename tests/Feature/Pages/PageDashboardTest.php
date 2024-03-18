<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

// use actingAs() helper function to authenticate user
use function Pest\Laravel\actingAs;

it('cannot be accessed by guest', function () {
    // Act & Assert
    $this->get(route('pages.dashboard'))
        ->assertRedirect(route('login'));
});

it('lists purchased courses', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'Course A'],
                ['title' => 'Course B'],
            )), 'purchasedCourses')
        ->create();

    // Act & Assert
    loginAsUser($user);

    $this->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B',
        ]);
});

it('does not list other courses', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    loginAsUser();

    $this->get(route('pages.dashboard'))
        ->assertOk()
        ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();
    $firstPurchasedCourse = Course::factory()->create();
    $lastPurchasedCourse = Course::factory()->create();

    $user->purchasedCourses()->attach($firstPurchasedCourse, ['created_at' => now()->yesterday()]);
    $user->purchasedCourses()->attach($lastPurchasedCourse, ['created_at' => now()]);

    // Act & Assert
    loginAsUser($user);

    $this->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeTextInOrder([
            $lastPurchasedCourse->title,
            $firstPurchasedCourse->title,
        ]);
});

it('includes link to product videos', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory(), 'purchasedCourses')
        ->create();

    // Act & Assert
    loginAsUser($user);

    $this->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText('Watch videos')
        ->assertSee(route('pages.course-videos', Course::first()));
});

it('includes logout if logged in', function () {
    // Act & Assert
    loginAsUser();

    $this->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText('Log Out')
        ->assertSee(route('logout'));
});
