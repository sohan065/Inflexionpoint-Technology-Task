<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductPurchased $event)
    {
        $product = $event->product;

        // Your logic to update the product quantity
        $newQuantity = $product->quantity - 1;
        $product->update(['quantity' => $newQuantity]);
    }
}
