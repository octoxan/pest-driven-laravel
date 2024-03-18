<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Console\Command;
use Twitter;

class TweetAboutCourseRelease extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet:about-course-release {courseId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet about course release.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $course = Course::findOrFail($this->argument('courseId'));

        Twitter::tweet("I just released $course->title Check it out on ".route('pages.course-details', $course));
    }
}
