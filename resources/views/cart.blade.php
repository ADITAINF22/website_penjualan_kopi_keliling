@extends('layouts.app')

@section('content')
<main class="max-w-2xl mx-auto px-5 py-10">
    <h2 class="text-2xl mb-6">Keranjang</h2>

    @if ($items->isEmpty())
        <div class="empty-box">
            <p class="sub" style="margin-bottom:14px">Keranjang masih kosong.</p>
            <a href="{{ route('home') }}" style="color:var(--gold);font-weight:600;font-size:14px">← Lihat menu</a>
        </div>
    @else
        <div class="list-card">
            @foreach ($items as $item)
                <div>
                    <div style="flex:1">
                        <b>{{ $item['product']->name }}</b>
                        <small>Rp {{ number_format($item['product']->price, 0, ',', '.') }}</small>
                    </div>

                    <form method="POST" action="{{ route('cart.update', $item['product']) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item['qty'] }}" min="0" max="20" class="qty-input">
                        <button style="color:var(--gold);font-weight:600;font-size:13px;background:none">Ubah</button>
                    </form>

                    <b style="min-width:90px;text-align:right">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</b>

                    <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                        @csrf
                        @method('DELETE')
                        <button class="del-btn">Hapus</button>
                    </form>
                </div>
            @endforeach

            <div class="total-row">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('order.store') }}" style="margin-top:26px">
            @csrf

            <label class="field">Nama</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="field-input" required>
            @error('customer_name') <p style="color:var(--ember);font-size:13px;margin-top:4px">{{ $message }}</p> @enderror

            <label class="field">No. HP</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="field-input" required>
            @error('phone') <p style="color:var(--ember);font-size:13px;margin-top:4px">{{ $message }}</p> @enderror

            <label class="field">Lokasi antar / titik ketemu</label>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="Contoh: Depan gerbang Blok C" class="field-input" required>
            @error('address') <p style="color:var(--ember);font-size:13px;margin-top:4px">{{ $message }}</p> @enderror

            <label class="field">Catatan (opsional)</label>
            <textarea name="note" rows="2" class="field-input">{{ old('note') }}</textarea>

            <button class="wa-btn">Pesan via WhatsApp</button>
        </form>
    @endif
</main>
@endsection