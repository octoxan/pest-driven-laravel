<div class="space-y-4">
    <div class="aspect-w-3 aspect-h-2">
        <a class="text-indigo-600"
           href="{{ route('pages.course-videos', $purchasedCourse) }}">
            <img class="object-cover rounded-lg shadow-lg"
                 src="{{ asset("images/$purchasedCourse->image_name") }}"
                 alt="Banner for course {{ $purchasedCourse->title }}">
        </a>
    </div>

    <div class="space-y-2">
        <div class="space-y-1 text-lg font-medium leading-6">
            <h3>{{ $purchasedCourse->title }}</h3>
            <a class="text-indigo-600"
               href="{{ route('pages.course-videos', $purchasedCourse) }}">Watch videos</a>
        </div>
    </div>
</div>
