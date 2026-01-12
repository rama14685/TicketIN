@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-300 bg-green-500/20 border border-green-500/30 rounded-lg px-4 py-2']) }}>
        {{ $status }}
    </div>
@endif
