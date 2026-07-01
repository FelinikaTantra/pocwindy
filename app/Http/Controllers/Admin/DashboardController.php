<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lead;
use App\Models\PageView;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\WhatsappClick;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Core counts ──────────────────────────────────────────────────────
        $totalProducts  = Product::count();
        $totalCategories = Category::count();

        // ── Lead funnel ──────────────────────────────────────────────────────
        $totalLeads    = Lead::count();
        $newLeads      = Lead::where('status', 'new')->count();
        $dealsCount    = Lead::where('status', 'deal')->count();

        $leadsByStatus = [];
        foreach (array_keys(Lead::STATUSES) as $s) {
            $leadsByStatus[$s] = Lead::where('status', $s)->count();
        }

        // Recent leads
        $recentLeads = Lead::with('product')->latest()->take(8)->get();

        // ── Visitor & WA analytics ────────────────────────────────────────
        $visitorsToday   = PageView::whereDate('viewed_date', today())->distinct('session_id')->count();
        $visitorsThisWeek = PageView::whereBetween('viewed_date', [now()->startOfWeek(), now()->endOfWeek()])
                            ->distinct('session_id')->count();
        $visitorsThisMonth = PageView::whereMonth('viewed_date', now()->month)
                            ->whereYear('viewed_date', now()->year)
                            ->distinct('session_id')->count();

        $waClicksToday  = WhatsappClick::whereDate('created_at', today())->count();
        $waClicksMonth  = WhatsappClick::whereMonth('created_at', now()->month)->count();

        // Conversion rate today
        $conversionRate = $visitorsToday > 0
            ? round(($waClicksToday / $visitorsToday) * 100, 1)
            : 0;

        // ── Visitors last 7 days for sparkline ───────────────────────────────
        $last7Days = collect(range(6, 0))->map(fn($d) => now()->subDays($d)->format('Y-m-d'));

        $viewsByDay = PageView::whereBetween('viewed_date', [now()->subDays(6), now()])
            ->select('viewed_date', DB::raw('count(distinct session_id) as cnt'))
            ->groupBy('viewed_date')
            ->pluck('cnt', 'viewed_date');

        $sparkline = $last7Days->map(fn($d) => $viewsByDay->get($d, 0));
        $sparkLabels = $last7Days->map(fn($d) => date('d/m', strtotime($d)));

        // ── Top products by views ─────────────────────────────────────────────
        $topProducts = ProductView::select('product_id', DB::raw('count(*) as views'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('views')
            ->take(5)
            ->get()
            ->filter(fn($pv) => $pv->product);

        // Products viewed but no WA click
        $viewedProductIds = ProductView::distinct('product_id')->pluck('product_id');
        $clickedProductIds = WhatsappClick::whereNotNull('product_id')->distinct('product_id')->pluck('product_id');
        $coldProducts = Product::whereIn('id', $viewedProductIds->diff($clickedProductIds))->take(3)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalCategories',
            'totalLeads', 'newLeads', 'dealsCount', 'leadsByStatus',
            'recentLeads',
            'visitorsToday', 'visitorsThisWeek', 'visitorsThisMonth',
            'waClicksToday', 'waClicksMonth', 'conversionRate',
            'sparkline', 'sparkLabels',
            'topProducts', 'coldProducts'
        ));
    }
}
