<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Phpml\Association\Apriori;
use Livewire\Attributes\Layout;
use App\Models\market_basket_data;

#[Layout('components.layout')]
#[Title('MBA - Market Analysis')]
class MarketAnalysis extends Component
{
    public $products = [];
    public $topRecommendations = [];
    public $topSellingItem = [];
    public $selectedProduct = '';

    // Getting product name from dropdown selection input
    #[Rule('required')]
    public $categoryProduct;

    // Mount variable data before rendering view
    public function mount()
    {
        $this->products = market_basket_data::getTypeProductData();
    }

    // Handling form submission
    public function submitForm()
    {
        $this->validate(); // Ensure the input is valid

        // You can set a flash message here if needed
        // session()->flash('message', 'Form submitted successfully.');

        // Retrieve transactions data
        $transactions = market_basket_data::getTransactionsData();

        $labels = [];

        // Set minimum support & confidence
        $apriori = new Apriori($support = 0.01, $confidence = 0.01);
        $apriori->train($transactions, $labels);

        // Input product from user
        $inputProduct = $this->categoryProduct;
        $this->selectedProduct = $inputProduct;

        // Get association rules
        $rules = $apriori->getRules();

        // Filter association rules for input product
        $recommendations = [];

        foreach ($rules as $rule) {
            // Check if input product exists in antecedent
            if (in_array($inputProduct, $rule['antecedent']) && count($rule['antecedent']) === 1 && count($rule['consequent']) === 1) {
                $recommendations[] = [
                    'antecedent' => implode(', ', $rule['antecedent']),
                    'consequent' => implode(', ', $rule['consequent']),
                    'confidence' => $rule['confidence'],
                ];
            }
        }

        // Sort recommendations by confidence and take the top 5
        usort($recommendations, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        // Get top 5 recommendations
        $this->topRecommendations = array_slice($recommendations, 0, 5);

        // Get top selling item each recommendation
        $counter = 0;
        foreach ($this->topRecommendations as $recommendation) {
            $this->topSellingItem[$counter++] = market_basket_data::getTopSellingCategory($recommendation['consequent']);
        }

        // dd($this->topSellingItem);
    }

    public function render()
    {
        return view('livewire.market-analysis', [
            'products' => $this->products,
            'topRecommendations' => $this->topRecommendations,
            'selectedProduct' => $this->selectedProduct,
            'topSellingItem' => $this->topSellingItem
        ]);
    }
}