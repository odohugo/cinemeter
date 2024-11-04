<div class="text-xl text-stone-800">
    @for ($i = 1; $i <= 5; $i++)
        {{ $i <= round($rating) ? '★' : '☆' }}
    @endfor
</div>
