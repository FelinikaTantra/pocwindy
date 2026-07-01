@extends('layouts.admin')

@section('title', 'Leads')

@section('content')

{{-- Status pipeline cards --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
    @foreach(\App\Models\Lead::STATUSES as $key => $info)
    @php
        $colorMap = [
            'blue'   => 'bg-blue-50 border-blue-200 text-blue-700',
            'yellow' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
            'purple' => 'bg-purple-50 border-purple-200 text-purple-700',
            'green'  => 'bg-green-50 border-green-200 text-green-700',
            'red'    => 'bg-red-50 border-red-200 text-red-700',
        ];
        $cls = $colorMap[$info['color']] ?? 'bg-gray-50 border-gray-200 text-gray-700';
    @endphp
    <a href="{{ route('admin.leads.index', ['status' => $key]) }}"
       class="border rounded-xl p-4 text-center {{ $cls }} {{ request('status') === $key ? 'ring-2 ring-offset-1 ring-current' : '' }} hover:shadow transition">
        <div class="text-2xl font-bold">{{ $counts[$key] ?? 0 }}</div>
        <div class="text-xs font-semibold mt-0.5">{{ $info['label'] }}</div>
    </a>
    @endforeach
</div>

<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-xl font-bold text-gray-800">
            Lead Management
            @if(request('status'))
                <span class="text-sm font-normal text-gray-500 ml-2">— {{ \App\Models\Lead::STATUSES[request('status')]['label'] ?? '' }}</span>
            @endif
        </h2>
        @if(request('status') || request('search'))
            <a href="{{ route('admin.leads.index') }}" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
        @endif
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.leads.index') }}" class="mb-5">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <div class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, WA, atau produk..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">Cari</button>
        </div>
    </form>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">WhatsApp</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk Diminati</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sumber</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Masuk</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($leads as $lead)
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
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium text-gray-900">
                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="hover:text-blue-600">{{ $lead->name }}</a>
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        <a href="{{ $lead->wa_link }}" target="_blank"
                           class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-medium">
                            <i class="fab fa-whatsapp"></i> {{ $lead->whatsapp }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $lead->product_name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-0.5 rounded text-xs {{ $lead->source === 'lead_form' ? 'bg-indigo-100 text-indigo-700' : 'bg-green-100 text-green-700' }}">
                            {{ $lead->source === 'lead_form' ? 'Form' : 'WA Click' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.leads.status', $lead->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    class="text-xs border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-400 {{ $badgeCls }}">
                                @foreach(\App\Models\Lead::STATUSES as $k => $info)
                                    <option value="{{ $k }}" {{ $lead->status === $k ? 'selected' : '' }}>{{ $info['label'] }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-gray-400 text-xs whitespace-nowrap">{{ $lead->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="text-indigo-600 hover:text-indigo-800 mr-2">Detail</a>
                        <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Hapus lead ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada leads.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $leads->links() }}</div>
</div>
@endsection
