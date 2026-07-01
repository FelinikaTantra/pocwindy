<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\PageView;
use App\Models\ProductView;
use App\Models\Product;
use App\Models\Setting;
use App\Models\WhatsappClick;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    /**
     * Track a page view (called via AJAX on every frontend page load).
     */
    public function trackPageView(Request $request): JsonResponse
    {
        PageView::create([
            'page_url'    => $request->input('url', $request->header('referer', '/')),
            'session_id'  => $request->input('session_id'),
            'ip_address'  => $request->ip(),
            'viewed_date' => today(),
        ]);

        return response()->json(['ok' => true]);
    }

    /**
     * Track a product view (called via AJAX when product modal opens).
     */
    public function trackProductView(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');
        if (!$productId) return response()->json(['ok' => false]);

        // Deduplicate: one view per session per product per day
        $exists = ProductView::where('product_id', $productId)
            ->where('session_id', $request->input('session_id'))
            ->where('viewed_date', today())
            ->exists();

        if (!$exists) {
            ProductView::create([
                'product_id'  => $productId,
                'session_id'  => $request->input('session_id'),
                'ip_address'  => $request->ip(),
                'viewed_date' => today(),
            ]);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Track a WhatsApp button click and redirect.
     */
    public function trackWhatsappClick(Request $request): \Illuminate\Http\RedirectResponse
    {
        WhatsappClick::create([
            'product_id'   => $request->input('product_id'),
            'product_name' => $request->input('product_name'),
            'referrer_page'=> $request->input('referrer_page', $request->header('referer', '/')),
            'session_id'   => $request->input('session_id'),
            'ip_address'   => $request->ip(),
        ]);

        $waNumber = preg_replace('/[^0-9]/', '', Setting::where('key', 'whatsapp')->value('value') ?? '');
        $message  = $request->input('message', 'Halo, saya tertarik dengan produk Anda.');

        return redirect("https://wa.me/{$waNumber}?text=" . rawurlencode($message));
    }

    /**
     * Handle lead form submission (popup form).
     */
    public function submitLead(Request $request): JsonResponse
    {
        $request->validate([
            'name'         => 'required|string|max:150',
            'whatsapp'     => 'required|string|max:20',
            'product_id'   => 'nullable|exists:products,id',
            'product_name' => 'nullable|string|max:255',
        ]);

        Lead::create([
            'name'          => $request->name,
            'whatsapp'      => $request->whatsapp,
            'product_id'    => $request->product_id,
            'product_name'  => $request->product_name,
            'source'        => 'lead_form',
            'status'        => 'new',
            'referrer_page' => $request->referrer_page,
        ]);

        return response()->json(['ok' => true, 'message' => 'Terima kasih! Kami akan segera menghubungi Anda.']);
    }
}
