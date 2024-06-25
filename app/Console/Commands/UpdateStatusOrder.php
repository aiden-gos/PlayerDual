<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateStatusOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('status', 'accepted')
            ->whereRaw('end_at <= NOW()')
            ->get();
        // Update status to 'completed'
        foreach ($orders as $order) {
            $order->update(['status' => 'completed']);
            Log::info('Order ' . $order->id . ' has been completed');
        }

        $orders = Order::where('status', 'pre-ordered')
            ->whereRaw('start_at <= NOW()')
            ->get();
        // Update status to 'accepted'
        foreach ($orders as $order) {
            $order->update(['status' => 'accepted']);
            Log::info('Order ' . $order->id . ' has been accepted(from pre-ordered)');
        }

        $orders = Order::where('status', 'pending')
            ->whereRaw('DATE_ADD(updated_at, INTERVAL 10 MINUTE) <= NOW()')
            ->get();
        // Update status to 'rejected'
        foreach ($orders as $order) {
            $order->update(['status' => 'rejected']);
            Log::info('Order ' . $order->id . ' has been rejected');
        }

        $orders = Order::where('status', 'pre-ordering')
            ->whereRaw('DATE_ADD(updated_at, INTERVAL 10 MINUTE) <= NOW()')
            ->get();
        // Update status to 'rejected'
        foreach ($orders as $order) {
            $order->update(['status' => 'rejected']);
            Log::info('Order ' . $order->id . ' has been rejected');
        }

        return Command::SUCCESS;
    }
}
