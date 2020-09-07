<section {{ $attributes->merge(['class' => "p-4"]) }}>
    <div class="container mx-auto w-full md:w-4/5">
        {{ $slot }}
    </div>
</section>
