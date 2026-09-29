@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-5 hero">
    <h1>Ngopi di manapun kamu berdiri.</h1>
    <p>Gerobak kopi yang datang ke titik kumpulmu. Pilih menu, kami racik saat kamu pesan.</p>
</div>

<main class="max-w-5xl mx-auto px-5 py-10 space-y-14">

    <section>
        <h2 class="text-2xl mb-1">Menu hari ini</h2>
        <p class="sub">Diseduh langsung di tempat, selagi kamu menunggu.</p>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="menu-tag">
                    <span class="hole"></span>
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="menu-photo">
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <div class="flex items-center justify-between pl-1.5">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <form method="POST" action="{{ route('cart.add', $product) }}">
                            @csrf
                            <button class="btn-add">+ Tambah</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl mb-1">Jadwal mangkal</h2>
        <p class="sub">Cek dulu sebelum ke lokasi, jadwal bisa berubah kalau hujan.</p>
        <div class="board">
            @foreach ($stops as $stop)
                <div class="stop">
                    <div>
                        <b>{{ $stop->place_name }}</b>
                        <small>{{ $stop->address }}</small>
                    </div>
                    <div class="r">
                        {{ $hari[$stop->day] }}
                        <span>{{ substr($stop->start_time, 0, 5) }} – {{ substr($stop->end_time, 0, 5) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection