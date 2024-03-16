<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video;

    // public function mount(Video $video)
    // {
    //     $this->video = $video;
    // }

    public function markVideoAsCompleted()
    {
        auth()->user()->watchedVideos()->attach($this->video->id);
    }

    public function markVideoAsNotCompleted()
    {
        auth()->user()->watchedVideos()->detach($this->video->id);
    }

    public function isCurrentVideo(Video $videoToCheck): bool
    {
        return $this->video->id === $videoToCheck->id;
    }

    public function render()
    {
        return view('livewire.video-player', [
            'video' => $this->video,
            'courseVideos' => $this->video->course->videos,
        ]);
    }
}
