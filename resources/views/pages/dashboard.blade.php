<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl sm:px-6 lg:px-8 lg:py-24 px-4 py-12 mx-auto">
            <div class="space-y-12">
                <div class="sm:space-y-4 md:max-w-xl lg:max-w-3xl xl:max-w-none space-y-5">
                    <h2 class="sm:text-4xl text-3xl font-bold tracking-tight">Purchased courses</h2>
                    <p class="text-xl text-gray-500">On the dashboard you can find your purchased courses.</p>
                </div>
                <ul role="list"
                    class="sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8 space-y-12">

                    @foreach ($purchasedCourses as $purchasedCourse)
                        <li>
                            @include('partials.purchase-course-list-item')
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
