<div id="printReceipt" style="display:none;">
    <h2>Transaction Receipt</h2>
    <p>Transaction Number: {{ $transaction->transaction_number }}</p>
    <p>Total Amount: {{ $transaction->total_amount }}</p>
    <p>Discount: {{ $transaction->discount }}</p>
    <p>Status: {{ $transaction->status }}</p>

    <h3>Products:</h3>
    <ul>
        @foreach ($transaction->orders as $order)
            <li>
                {{ $order->product->name }} - Quantity: {{ $order->quantity }} - Price: {{ $order->total_price }}
            </li>
        @endforeach
    </ul>
</div>
