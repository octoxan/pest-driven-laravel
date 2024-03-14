@guest
    <a href="{{ route('login') }}">Login</a>
@else
    <form
        method="POST"
        action="{{ route('logout') }}"
    >
        @csrf
        <button type="submit">Log Out</button>
    @endguest

    @foreach ($courses as $course)
        <h1>{{ $course->title }}</h1>
        <p>{{ $course->description }}</p>
    @endforeach
