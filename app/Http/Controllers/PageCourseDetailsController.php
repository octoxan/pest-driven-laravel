<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PageCourseDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Course $course)
    {
        // if unreleased, return 404
        if (! $course->released_at) {
            abort(404);
        }

        $course->loadCount('videos');

        return view('pages.course-details', compact('course'));
    }
}
