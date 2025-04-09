<div>
    @foreach ([
        1 => ['📋', 'Basic Info'],
        2 => ['👤', 'Owner Info'],
        3 => ['🏠', 'Property Details'],
        4 => ['📍', 'Location'],
        5 => ['📸', 'Media']
    ] as $num => [$icon, $label])
            <div class="col-md-3">
                <span class="text-xl">{{ $icon }}</span>
                <span class="text-sm md:text-base">{{ $label }}</span>
            </div>
            @if ($step > $num)
                <span class="text-green-500 text-sm">✔️</span>
            @endif
    @endforeach
</div>