<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-unpaid-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $unpaidOrders = Order::where('payment_status', '!=', 'complete')
        ->where('created_at', '<=', Carbon::now()->subDay())
        ->get();


        foreach ($unpaidOrders as $order) {
            
            $product = Product::findOrFail($order->product_id);
            $product->stock = $product->stock + $order->quantity;
            $product->save();

            $order->delete();
        }

        $this->info('Unpaid orders removed successfully.');
    }
}
