<h1>{{ $course->title }}</h1>
<h2>{{ $course->tagline }}</h2>
<p>{{ $course->description }}</p>
<p>{{ $course->videos_count }} videos</p>
<ul>
    @foreach ($course->learnings as $learning)
        <li>{{ $learning }}</li>
    @endforeach
</ul>
<img src="{{ asset("images/$course->image_name") }}"
     alt="{{ $course->title }}">

<a href="#!"
   class="paddle_button"
   data-product="product-id">Buy Now!</a>

<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">
    Paddle.Setup({
        vendor: {{ config('services.paddle.vendor_id') }}
    });
</script>
