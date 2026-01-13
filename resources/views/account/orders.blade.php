<x-app-layout :title="'Orders - CICT-DG'">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --surface: #ffffff;
            --border: rgba(15,23,42,0.08);
            --accent: #8B0000;
            --accent-2: #A00000;
            --bg: #f8fafc;
        }

        body { background: var(--bg) !important; }

        .orders-shell { max-width: 1100px; margin: 0 auto; padding: 120px 24px 80px; }
        .hero { display:flex; justify-content:space-between; gap:14px; flex-wrap:wrap; margin-bottom:20px; }
        .hero h1 { margin:0; font-size:32px; font-weight:800; letter-spacing:-0.4px; color:var(--ink); }
        .hero p { margin:6px 0 0 0; color:var(--muted); max-width:640px; line-height:1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing:0.18em; font-size:11px; font-weight:700; color:var(--accent); margin:0; }
        .chip { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:999px; background: rgba(15,23,42,0.06); color:var(--ink); font-weight:700; }
        .chips { display:flex; flex-wrap:wrap; gap:8px; }

        .list { display:flex; flex-direction:column; gap:12px; }
        .card { background: var(--surface); border:1px solid var(--border); border-radius:18px; padding:16px; box-shadow:0 16px 48px rgba(15,23,42,0.06); }
        .card-header { display:flex; justify-content:space-between; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:8px; }
        .card-header h3 { margin:0; font-weight:800; color:var(--ink); font-size:18px; }
        .sub { color:var(--muted); font-weight:600; font-size:13px; }
        .status { padding:8px 12px; border-radius:10px; font-weight:800; font-size:12px; letter-spacing:0.4px; border:1px solid transparent; }
        .pending { background: rgba(218,165,32,0.12); color:#a16207; border-color: rgba(218,165,32,0.3); }
        .completed { background: rgba(52,211,153,0.12); color:#0f766e; border-color: rgba(52,211,153,0.3); }
        .cancelled { background: rgba(248,113,113,0.12); color:#b91c1c; border-color: rgba(248,113,113,0.3); }

        .meta { display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap:10px; margin:12px 0; }
        .meta-block { padding:12px; border:1px solid var(--border); border-radius:12px; background:#fff; }
        .meta-label { color:var(--muted); font-weight:700; font-size:12px; letter-spacing:0.2px; }
        .meta-value { font-weight:800; color:var(--ink); font-size:18px; }

        .actions { display:flex; flex-wrap:wrap; gap:8px; margin-top:8px; }
        .btn { padding:10px 14px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; text-decoration:none; color:var(--ink); }
        .btn.primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; border:none; box-shadow:0 12px 30px rgba(139,0,0,0.18); }
        .btn.secondary { border-color: var(--accent); color: var(--accent); }
        .btn.danger { border-color: #dc2626; color:#dc2626; }
        .btn:hover { transform: translateY(-1px); box-shadow:0 10px 24px rgba(15,23,42,0.08); }

        .empty { text-align:center; padding:80px 20px; }
        .empty h2 { margin:12px 0 8px; font-size:28px; font-weight:900; color:var(--ink); }
        .empty p { margin:0 0 14px; color:var(--muted); font-weight:600; }

        .filter-row { display:flex; flex-wrap:wrap; gap:8px; margin:12px 0 20px; }
        .filter-chip { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:800; color:var(--ink); text-decoration:none; transition: all 0.18s ease; }
        .filter-chip span { font-weight:700; font-size:12px; color:var(--muted); }
        .filter-chip.active { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; border-color: transparent; box-shadow:0 12px 30px rgba(139,0,0,0.18); }
        .filter-chip.active span { color: rgba(255,255,255,0.85); }
        .filter-chip:hover { transform: translateY(-1px); box-shadow:0 10px 24px rgba(15,23,42,0.08); }

        @media(max-width:768px) { .orders-shell { padding-top: 90px; } }
    </style>

    @php
        $currentStatus = $status ?? 'all';
        $counts = $statusCounts ?? ['all' => $orders->total(), 'pending' => 0, 'processing' => 0, 'completed' => 0];
    @endphp

    <div class="orders-shell">
        <div class="hero">
            <div>
                <p class="eyebrow">Orders</p>
                <h1>Order history</h1>
                <p>Track receipts, download proof, or cancel if it is still pending.</p>
            </div>
            <div style="display:flex; align-items:flex-start; justify-content:flex-end; flex:1;">
                <div class="filter-row" style="margin:0;">
                    @php
                        $filters = [
                            'all' => 'All',
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'completed' => 'Completed',
                        ];
                    @endphp
                    @foreach($filters as $key => $label)
                        <a
                            href="{{ route('account.orders', $key === 'all' ? [] : ['status' => $key]) }}"
                            class="filter-chip {{ $currentStatus === $key ? 'active' : '' }}"
                        >
                            <span>{{ $label }}</span>
                            <strong>{{ $counts[$key] ?? 0 }}</strong>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        @if($orders->count() > 0)
            <div class="list">
                @foreach($orders as $order)
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                                <div class="sub">{{ $order->created_at->format('M d, Y · g:i A') }}</div>
                            </div>
                            <span class="status {{ $order->status === 'completed' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending') }}">{{ ucfirst($order->status) }}</span>
                        </div>

                        <div class="meta">
                            <div class="meta-block">
                                <div class="meta-label">Items</div>
                                <div class="meta-value">{{ $order->items->count() }}</div>
                            </div>
                            <div class="meta-block">
                                <div class="meta-label">Total</div>
                                <div class="meta-value">₱{{ number_format($order->total, 2) }}</div>
                            </div>
                        </div>

                        <div class="actions">
                            <a class="btn primary" href="{{ route('orders.show', $order) }}">View</a>
                            <a class="btn secondary" href="{{ route('orders.receipt.pdf', $order) }}">Receipt</a>
                            @if($order->canBeCancelled())
                                <form method="POST" action="{{ route('orders.cancel', $order) }}" onsubmit="confirmCancel(event, this);">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn danger">Cancel</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('orders.destroy', $order) }}" onsubmit="confirmDelete(event, this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($orders->hasPages())
                <div style="margin-top:20px;">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
                <div class="card empty">
                <div style="font-size:40px;">📦</div>
                <h2>No orders yet</h2>
                <p>When you place an order it will appear here.</p>
                <a class="btn primary" style="text-decoration:none;" href="{{ route('shop.index') }}">Start shopping</a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancel(event, form) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Cancel order?',
                text: 'This will cancel the order.',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Cancel order'
            }).then(result => { if (result.isConfirmed) form.submit(); });
        }

        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Delete order?',
                text: 'This removes the record permanently.',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Delete'
            }).then(result => { if (result.isConfirmed) form.submit(); });
        }
    </script>
</x-app-layout>
