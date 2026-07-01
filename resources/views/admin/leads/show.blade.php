@extends('layouts.admin')

@section('title', 'Detail Lead')

@section('content')
<div class="max-w-2xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.leads.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Kembali</a>
        <span class="text-gray-300">|</span>
        <h2 class="text-xl font-bold text-gray-800">Detail Lead — {{ $lead->name }}</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm">{{ session('success') }}</div>
    @endif

    {{-- Lead Info Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-4">
        <div class="flex items-start justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-lg">
                    {{ strtoupper(substr($lead->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ $lead->name }}</h3>
                    <a href="{{ $lead->wa_link }}" target="_blank"
                       class="inline-flex items-center gap-1.5 text-green-600 hover:text-green-700 font-medium text-sm">
                        <i class="fab fa-whatsapp text-base"></i> {{ $lead->whatsapp }}
                        <span class="text-xs text-gray-400">(klik untuk chat)</span>
                    </a>
                </div>
            </div>

            {{-- Status Badge --}}
            @php
                $colorMap = [
                    'blue'   => 'bg-blue-100 text-blue-800',
                    'yellow' => 'bg-yellow-100 text-yellow-800',
                    'purple' => 'bg-purple-100 text-purple-800',
                    'green'  => 'bg-green-100 text-green-800',
                    'red'    => 'bg-red-100 text-red-800',
                ];
                $badgeCls = $colorMap[$lead->status_color] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $badgeCls }}">{{ $lead->status_label }}</span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Produk Diminati</p>
                <p class="text-gray-800 font-medium">{{ $lead->product_name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Sumber</p>
                <p class="text-gray-800 font-medium">{{ $lead->source === 'lead_form' ? 'Form Popup' : 'WA Button Click' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Halaman Asal</p>
                <p class="text-gray-600 text-xs break-all">{{ $lead->referrer_page ?? '—' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Masuk</p>
                <p class="text-gray-800">{{ $lead->created_at->format('d M Y, H:i') }}</p>
            </div>
            @if($lead->contacted_at)
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-1">Dihubungi</p>
                <p class="text-gray-800">{{ $lead->contacted_at->format('d M Y, H:i') }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-4">
        <h4 class="font-semibold text-gray-700 mb-3">Update Status Pipeline</h4>
        <form action="{{ route('admin.leads.status', $lead->id) }}" method="POST" class="flex items-center gap-3">
            @csrf @method('PATCH')
            <div class="flex flex-wrap gap-2">
                @foreach(\App\Models\Lead::STATUSES as $k => $info)
                @php
                    $active = $lead->status === $k;
                    $btnMap = [
                        'blue'   => $active ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-700 hover:bg-blue-100',
                        'yellow' => $active ? 'bg-yellow-500 text-white' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100',
                        'purple' => $active ? 'bg-purple-600 text-white' : 'bg-purple-50 text-purple-700 hover:bg-purple-100',
                        'green'  => $active ? 'bg-green-600 text-white' : 'bg-green-50 text-green-700 hover:bg-green-100',
                        'red'    => $active ? 'bg-red-500 text-white' : 'bg-red-50 text-red-600 hover:bg-red-100',
                    ];
                    $btnCls = $btnMap[$info['color']] ?? '';
                @endphp
                <button type="submit" name="status" value="{{ $k }}"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium transition {{ $btnCls }}">
                    {{ $info['label'] }}
                </button>
                @endforeach
            </div>
        </form>
    </div>

    {{-- Notes --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h4 class="font-semibold text-gray-700 mb-3">Catatan Admin</h4>
        <form action="{{ route('admin.leads.notes', $lead->id) }}" method="POST">
            @csrf @method('PATCH')
            <textarea name="notes" rows="4" placeholder="Tambahkan catatan follow-up..."
                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">{{ $lead->notes }}</textarea>
            <button type="submit"
                    class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Simpan Catatan
            </button>
        </form>
    </div>

</div>
@endsection
