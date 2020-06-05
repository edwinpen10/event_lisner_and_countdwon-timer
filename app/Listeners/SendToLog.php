<?php

namespace App\Listeners;

use App\Events\ProductWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\ProductLog;
class SendToLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductWasCreated $event)
    {
        $product = $event->product;
        $productlog = new ProductLog();
        $productlog->name_product=$product->name;
        $productlog->description="Product was Created, product name: $product->name";
        $productlog->save();
        Log::info("Product was Created, product name: $product->name");
    }
    
}
