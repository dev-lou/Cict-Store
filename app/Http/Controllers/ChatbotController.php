<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\GeminiChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private GeminiChatService $chatService;

    public function __construct(GeminiChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * Handle incoming chat messages
     */
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'context' => 'array|nullable',
        ]);

        $message = $validated['message'];
        $context = $validated['context'] ?? [];

        // Pull current active services from the database to ground responses
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get(['title', 'category']);

        $serviceSummary = $services
            ->groupBy('category')
            ->map(function ($items, $category) {
                return $category . ': ' . $items->pluck('title')->join(', ');
            })
            ->values()
            ->join(' | ');

        $messageWithServices = $serviceSummary
            ? $message . "\n\nAvailable services (from database): " . $serviceSummary . "\nIf details are missing, direct the user to the Services page."
            : $message . "\n\nNo services are listed in the database right now. Let users know they can browse services on the Services page.";

        Log::info('Chatbot message received', ['message' => $message]);

        $response = $this->chatService->chat($messageWithServices, $context);

        // Attach helpful navigation quick_links when the user intent matches common patterns
        $lower = strtolower($message);
        $quick = [];

        // ordering intent
        if (preg_match('/\b(order|where to order|how to order|buy|purchase|shop)\b/', $lower)) {
            $quick[] = ['text' => 'Shop', 'url' => route('shop.index')];
            $quick[] = ['text' => 'How to order', 'url' => route('shop.index') . '#how-to-order'];
        }

        // services / printing intent
        if (preg_match('/\b(service|printing|print|custom order|printing services)\b/', $lower)) {
            $quick[] = ['text' => 'Services', 'url' => route('services.index')];
        }

        // contact / support intent
        if (preg_match('/\b(contact|support|help|phone|email)\b/', $lower)) {
            $quick[] = ['text' => 'Contact', 'url' => route('contact.index')];
        }

        // orders / tracking intent
        if (preg_match('/\b(track|tracking|status|order status|my order)\b/', $lower)) {
            // only include orders link if route exists for account.orders
            $quick[] = ['text' => 'My Orders', 'url' => route('account.orders')];
        }

        if (!empty($quick)) {
            // ensure response is an array and attach quick_links
            if (!is_array($response)) $response = ['success' => false, 'error' => 'Unexpected response'];
            $response['quick_links'] = $quick;
        }

        return response()->json($response);
    }

    /**
     * Get quick action buttons
     */
    public function quickActions()
    {
        return response()->json([
            'actions' => $this->chatService->getQuickActions()
        ]);
    }
}
