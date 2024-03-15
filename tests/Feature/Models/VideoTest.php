<?php

use App\Models\Video;

it('gives back readable video duration', function () {
    // Arrange
    $video = Video::factory()->create([
        'duration_in_min' => 10,
    ]);

    // Act & Assert
    expect($video->getReadableDuration())->toEqual('10mins');
});
