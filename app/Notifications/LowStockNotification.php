<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable): array
    {
        return ['database']; 
    }

    public function toArray($notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'name' => $this->product->name,
            'sku' => $this->product->sku,
            'quantity' => $this->product->quantity,
            'reorder_level' => $this->product->reorder_level,
            'message' => 'Product ' . $this->product->name . ' is low on stock (' . $this->product->quantity . ' left).'
        ];
    }
}