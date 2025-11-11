<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product; // <-- Import the Product Model

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        // This public property will automatically be available as $product in the view
        public Product $product 
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
