<div>
    <h3>{{ $video->title }} ({{ $video->getReadableDuration() }})</h3>
    <p>{{ $video->description }}</p>
    <iframe src="https://player.vimeo.com/video/{{ $video->vimeo_id }}"
            webkitallowfullscreen
            mozallowfullscreen
            allowfullscreen></iframe>
</div>
