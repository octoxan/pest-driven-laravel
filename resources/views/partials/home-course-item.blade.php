<div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
    <div class="flex-shrink-0">
        <a href="{{ route('pages.course-details', $course) }}">
            <img class="object-cover w-full h-48"
                 src="{{ asset("images/$course->image_name") }}"
                 alt="Cover image for the course {{ $course->title }}">
        </a>
    </div>
    <div class="flex flex-col justify-between flex-1 p-6 bg-white">
        <div class="flex-1">
            <p class="text-sm font-medium text-yellow-500">
                <a href="#"
                   class="hover:underline">Video course</a>
            </p>
            <a href="{{ route('pages.course-details', $course) }}"
               class="block mt-2">
                <p class="text-xl font-semibold text-gray-900">{{ $course->title }}e</p>
                <p class="mt-3 text-base text-gray-500">{{ $course->description }}</p>
            </a>
        </div>
    </div>
</div>
