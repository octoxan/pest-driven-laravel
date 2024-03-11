<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('dashboard'))
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

    // Act
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B',
        ]);
});

it('does not list other courses', function() {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    // Act && Assert
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk()
        ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function() {
    // Arrange
    $user = User::factory()->create();
    $firstPurchasedCourse = Course::factory()->create();
    $lastPurchasedCourse = Course::factory()->create();

    $user->purchasedCourses()->attach($firstPurchasedCourse, ['created_at' => now()->yesterday()]);
    $user->purchasedCourses()->attach($lastPurchasedCourse, ['created_at' => now()]);

    // Act && Assert
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk()
        ->assertSeeTextInOrder([
            $lastPurchasedCourse->title,
            $firstPurchasedCourse->title,
        ]);
});

it('includes link to product videos', function() {
    // Arrange
    $user = User::factory()
        ->has(Course::factory(), 'purchasedCourses')
        ->create();

    // Act && Assert
    $this->actingAs($user);

    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Watch videos')
        ->assertSee(route('pages.course-videos', Course::first()));
});
