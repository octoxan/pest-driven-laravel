<div>
    <div class="max-w-7xl py-8 mx-auto">

        <div class="md:flex-row flex flex-col my-24">

            <!-- Video -->
            <div class="md:w-3/4 md:p-0 w-full p-6">
                <iframe class="aspect-video md:mb-8 w-full mb-4 rounded"
                        src="https://player.vimeo.com/video/{{ $video->vimeo_id }}"
                        webkitallowfullscreen
                        mozallowfullscreen
                        allowfullscreen></iframe>
                <div class="flex justify-end">
                    @if ($video->alreadyWatchedByCurrentUser())
                        <button class="hover:bg-yellow-500 px-4 py-2 text-xs bg-yellow-400 rounded-md"
                                wire:click="markVideoAsNotCompleted">Mark as <strong>not</strong> completed
                        </button>
                    @else
                        <button class="hover:bg-yellow-500 px-4 py-2 text-xs bg-yellow-400 rounded-md"
                                wire:click="markVideoAsCompleted">Mark as completed
                        </button>
                    @endif
                </div>

                <div>
                    <h3 class="mb-2 text-xl font-bold">{{ $video->title }} ({{ $video->getReadableDuration() }})</h3>
                    <p>{{ $video->description }}</p>

                </div>
            </div>
            <!-- Video -->

            <!-- Video list -->
            <div class="md:w-1/4 md:p-0 w-full p-6">
                <div>
                    <ul role="list"
                        class="md:ml-12 divide-y divide-gray-200">
                        @foreach ($courseVideos as $courseVideo)
                            <li class="py-4">
                                <div class="flex space-x-3">
                                    @include('partials.svg.play')
                                    <div class="flex-1 space-y-1">
                                        <div class="flex items-center justify-between">
                                            @if ($this->isCurrentVideo($courseVideo))
                                                <h3 class="text-md font-bold">{{ $courseVideo->title }} @if ($courseVideo->alreadyWatchedByCurrentUser())
                                                        ✅
                                                    @endif
                                                </h3>
                                            @else
                                                <a
                                                   href="{{ route('pages.course-videos', [$courseVideo->course, $courseVideo]) }}">
                                                    <h3 class="text-md font-medium">{{ $courseVideo->title }}
                                                        @if ($courseVideo->alreadyWatchedByCurrentUser())
                                                            ✅
                                                        @endif
                                                    </h3>
                                                </a>
                                            @endif
                                            <p class="text-sm text-gray-500">{{ $courseVideo->getReadableDuration() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Video list -->

        </div>
    </div>
</div>
