@props(['message' => null])

<div class="alert alert-success">
    @if ($message)
        <strong>{{ $message }}</strong>
    @else
        {{ $slot }}
    @endif
</div>