@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
@endpush

@section('content')

{{-- ── Row 1: Visitor & WA Analytics ── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Visitors Today --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Visitor Hari Ini</p>
            <div class="p-2 bg-blue-50 rounded-lg"><i class="fas fa-eye text-blue-400 text-sm"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $visitorsToday }}</p>
        <p class="text-xs text-gray-400 mt-1">Bulan ini: {{ $visitorsThisMonth }}</p>
    </div>

    {{-- WA Clicks --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Klik WhatsApp</p>
            <div class="p-2 bg-green-50 rounded-lg"><i class="fab fa-whatsapp text-green-500 text-sm"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $waClicksToday }}</p>
        <p class="text-xs text-gray-400 mt-1">Bulan ini: {{ $waClicksMonth }}</p>
    </div>

    {{-- Conversion Rate --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Conversion Rate</p>
            <div class="p-2 bg-purple-50 rounded-lg"><i class="fas fa-percentage text-purple-400 text-sm"></i></div>
        </div>
        <p class="text-3xl font-bold {{ $conversionRate >= 10 ? 'text-green-600' : ($conversionRate >= 5 ? 'text-yellow-600' : 'text-gray-800') }}">
            {{ $conversionRate }}%
        </p>
        <p class="text-xs text-gray-400 mt-1">WA clicks / visitors hari ini</p>
    </div>

    {{-- Total Leads --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total Leads</p>
            <div class="p-2 bg-yellow-50 rounded-lg"><i class="fas fa-users text-yellow-500 text-sm"></i></div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $totalLeads }}</p>
        <p class="text-xs text-gray-400 mt-1">
            <span class="text-blue-600 font-semibold">{{ $newLeads }} new</span> ·
            <span class="text-green-600 font-semibold">{{ $dealsCount }} deal</span>
        </p>
    </div>

</div>

{{-- ── Row 2: Sparkline chart + Lead Pipeline ── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- 7-day visitor sparkline --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Visitor 7 Hari Terakhir</h3>
        <canvas id="visitorChart" height="80"></canvas>
    </div>

    {{-- Lead pipeline funnel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700">Lead Pipeline</h3>
            <a href="{{ route('admin.leads.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
        </div>
        <div class="space-y-2">
            @foreach(\App\Models\Lead::STATUSES as $key => $info)
            @php
                $count = $leadsByStatus[$key] ?? 0;
                $max = max(array_values($leadsByStatus) ?: [1]);
                $pct = $max > 0 ? round(($count / $max) * 100) : 0;
                $barColors = [
                    'blue'   => 'bg-blue-400',
                    'yellow' => 'bg-yellow-400',
                    'purple' => 'bg-purple-400',
                    'green'  => 'bg-green-400',
                    'red'    => 'bg-red-400',
                ];
                $barCls = $barColors[$info['color']] ?? 'bg-gray-300';
            @endphp
            <a href="{{ route('admin.leads.index', ['status' => $key]) }}" class="flex items-center gap-3 group">
                <span class="text-xs text-gray-500 w-24 truncate">{{ $info['label'] }}</span>
                <div class="flex-1 bg-gray-100 rounded-full h-2">
                    <div class="{{ $barCls }} h-2 rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                </div>
                <span class="text-sm font-bold text-gray-700 w-6 text-right">{{ $count }}</span>
            </a>
            @endforeach
        </div>
    </div>

</div>

{{-- ── Row 3: Top products + Cold products + Recent leads ── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Top viewed products --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700">🔥 Produk Terpopuler</h3>
            <span class="text-xs text-gray-400">by views</span>
        </div>
        @forelse($topProducts as $i => $pv)
        <div class="flex items-center gap-3 mb-3">
            <span class="text-xs font-bold text-gray-400 w-4">{{ $i + 1 }}</span>
            @if($pv->product->thumbnail)
                <img src="{{ Str::startsWith($pv->product->thumbnail, 'http') ? $pv->product->thumbnail : asset('storage/' . $pv->product->thumbnail) }}"
                     class="h-9 w-9 object-cover rounded-lg">
            @else
                <div class="h-9 w-9 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs"><i class="fas fa-image"></i></div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-800 truncate">{{ $pv->product->name }}</p>
                <p class="text-xs text-gray-400">{{ $pv->views }} views</p>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 text-center py-4">Belum ada data views.</p>
        @endforelse
    </div>

    {{-- Products viewed but no WA click --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700">👀 Dilihat, Tidak Dihubungi</h3>
            <span class="text-xs text-gray-400">opportunity</span>
        </div>
        @forelse($coldProducts as $p)
        <div class="flex items-center gap-3 mb-3">
            @if($p->thumbnail)
                <img src="{{ Str::startsWith($p->thumbnail, 'http') ? $p->thumbnail : asset('storage/' . $p->thumbnail) }}"
                     class="h-9 w-9 object-cover rounded-lg">
            @else
                <div class="h-9 w-9 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs"><i class="fas fa-image"></i></div>
            @endif
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-800 truncate">{{ $p->name }}</p>
                <p class="text-xs text-gray-400">Belum ada yang hubungi via WA</p>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 text-center py-4">Semua produk sudah ada WA click.</p>
        @endforelse
        <p class="text-xs text-gray-400 mt-3">Pertimbangkan promosi untuk produk di atas.</p>
    </div>

    {{-- Catalog stats --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">📦 Katalog</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Total Produk</span>
                <span class="text-lg font-bold text-gray-800">{{ $totalProducts }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Total Kategori</span>
                <span class="text-lg font-bold text-gray-800">{{ $totalCategories }}</span>
            </div>
            <hr class="my-2">
            <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between text-blue-600 hover:text-blue-700 text-sm font-medium">
                <span>+ Tambah Produk</span>
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
            <a href="{{ route('admin.leads.index') }}" class="flex items-center justify-between text-green-600 hover:text-green-700 text-sm font-medium">
                <span>Lihat Semua Leads</span>
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
            <a href="{{ route('admin.catalog.pdf') }}" target="_blank" class="flex items-center justify-between text-gray-500 hover:text-gray-700 text-sm font-medium">
                <span>Export PDF Catalog</span>
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </div>
    </div>

</div>

{{-- ── Row 4: Recent Leads table ── --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-gray-700">Lead Terbaru</h3>
        <a href="{{ route('admin.leads.index') }}" class="text-xs text-blue-600 hover:underline">Lihat semua →</a>
    </div>

    @if($recentLeads->isEmpty())
        <div class="text-center py-8 text-gray-400">
            <i class="fas fa-user-plus text-3xl mb-2 block"></i>
            <p class="text-sm">Belum ada leads. Pasang form di website untuk mulai mengumpulkan leads.</p>
        </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="pb-2 text-left text-xs text-gray-400 font-medium">Nama</th>
                    <th class="pb-2 text-left text-xs text-gray-400 font-medium">WhatsApp</th>
                    <th class="pb-2 text-left text-xs text-gray-400 font-medium">Produk</th>
                    <th class="pb-2 text-left text-xs text-gray-400 font-medium">Status</th>
                    <th class="pb-2 text-left text-xs text-gray-400 font-medium">Masuk</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($recentLeads as $lead)
                @php
                    $colorMap = [
                        'blue'   => 'bg-blue-100 text-blue-700',
                        'yellow' => 'bg-yellow-100 text-yellow-700',
                        'purple' => 'bg-purple-100 text-purple-700',
                        'green'  => 'bg-green-100 text-green-700',
                        'red'    => 'bg-red-100 text-red-700',
                    ];
                    $badgeCls = $colorMap[$lead->status_color] ?? 'bg-gray-100 text-gray-600';
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="py-2.5 pr-4 font-medium text-gray-800">
                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="hover:text-blue-600">{{ $lead->name }}</a>
                    </td>
                    <td class="py-2.5 pr-4">
                        <a href="{{ $lead->wa_link }}" target="_blank" class="text-green-600 hover:text-green-700 inline-flex items-center gap-1">
                            <i class="fab fa-whatsapp text-xs"></i> {{ $lead->whatsapp }}
                        </a>
                    </td>
                    <td class="py-2.5 pr-4 text-gray-500">{{ $lead->product_name ?? '—' }}</td>
                    <td class="py-2.5 pr-4">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badgeCls }}">{{ $lead->status_label }}</span>
                    </td>
                    <td class="py-2.5 text-gray-400 text-xs">{{ $lead->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
const ctx = document.getElementById('visitorChart');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($sparkLabels->values()),
            datasets: [{
                label: 'Visitor',
                data: @json($sparkline->values()),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                borderWidth: 2.5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3b82f6',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } },
            }
        }
    });
}
</script>
@endpush
