<?php

namespace App\Observers;

use App\Models\InventoryTransaction;
use App\Models\User;
use App\Notifications\LowStockNotification;

class InventoryTransactionObserver
{
    public function created(InventoryTransaction $transaction): void
    {
        $product = $transaction->product;

        if ($product) {
            // Kunin ang quantity bago at pagkatapos ng transaksyon
            $qtyChange = $transaction->quantity;
            
            if ($transaction->type === 'Stock_in') {
                $product->quantity += $qtyChange;
            } elseif ($transaction->type === 'Stock_out') {
                $product->quantity -= $qtyChange;
            } elseif ($transaction->type === 'Adjustment') {
                // Kung adjustment, direktang i-set o i-adjust ang quantity depende sa logic mo
                $product->quantity = $qtyChange; 
            }

            $product->save();

            // 🔔 DITO NATIN IDADAGDAG ANG LOW STOCK NOTIFICATION TRIGGER:
            if ($product->quantity <= $product->reorder_level) {
                $admins = User::all(); // Kunin ang lahat ng users/admins
                foreach ($admins as $admin) {
                    $admin->notify(new LowStockNotification($product));
                }
            }
        }
    }
}