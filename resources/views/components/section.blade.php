@props(['bgcolor' => 'bg-white', 'padding' => 'p-4'])
<section {{ $attributes->merge(['class' => "p-4"]) }}>
    <div class="container mx-auto w-full md:w-3/4">
        {{ $slot }}
    </div>
</section>
