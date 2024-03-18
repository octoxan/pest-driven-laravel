<x-guest-layout>
    <main>
        <div class="sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14 pt-10 bg-indigo-500">
            <div class="max-w-7xl lg:px-8 mx-auto">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                    <div
                         class="sm:max-w-2xl sm:px-6 sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left max-w-md px-4 mx-auto">
                        <div class="lg:py-24">
                            <h1
                                class="sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl mt-4 text-4xl font-bold tracking-tight text-white">
                                <span class="block">A cast a day</span>
                                <span
                                      class="bg-gradient-to-r from-yellow-500 to-yellow-200 bg-clip-text sm:pb-5 block pb-3 text-transparent">keeps
                                    bugs away</span>
                            </h1>
                            <p class="sm:text-xl lg:text-lg xl:text-xl text-base text-gray-200">
                                <strong>LaravelCasts</strong> is the
                                leading learning platform for Laravel developers.</p>
                        </div>
                    </div>
                    <div class="sm:-mb-48 lg:relative lg:m-0 mt-12 -mb-16">
                        <div class="sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0 max-w-md px-4 mx-auto">
                            <img class="lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none w-full"
                                 src="{{ asset('images/coding_illustration.svg') }}"
                                 alt="Illustration of someone coding in front of a computer at home">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Courses -->
        <div class="bg-gray-50 sm:py-24 lg:py-32 relative py-16">
            <div class="relative">
                <div class="sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8 max-w-md px-4 mx-auto text-center">
                    <h2 class="sm:text-4xl mt-2 text-3xl font-bold tracking-tight text-gray-900">Pick one of our
                        exclusive premium courses</h2>
                    <p class="max-w-prose mx-auto mt-5 text-xl text-gray-500">All of our courses will teach you one
                        specific aspect of programming. Go step by step and never stop learning.</p>
                </div>
                <div
                     class="sm:max-w-lg sm:px-6 lg:max-w-7xl lg:grid-cols-3 lg:px-8 grid max-w-md gap-8 px-4 mx-auto mt-12">
                    @foreach ($courses as $course)
                        @include('partials.home-course-item')
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Available Courses -->

    </main>
</x-guest-layout>
