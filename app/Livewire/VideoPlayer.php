<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video;

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video-player');
    }
}