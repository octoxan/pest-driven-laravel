<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Videos') }} - {{ $video->course->title }}
        </h2>
    </x-slot>
    <livewire:video-player :video="$video" />
</x-app-layout>
