<?php

namespace App\Controller\Guest;

use App\Model\Manager\ProductManager;
use App\Model\Table\Product;
use Library\Core\AbstractController;

class ProductController extends AbstractController
{

    protected $productManager;
    protected $product;

    public function __construct()
    {
        $this->productManager = new ProductManager();
        $this->product = new Product();
    }

    /**
     * @brief Method to get the product page.
     * @method void index
     */
    public function index(): void
    {
        if (auth()->isAuthenticated()) {
            $this->displayAdmin('Gérer les produits', 'product', ['products' => $this->productManager->getAllProducts()]
            );
        }
        $this->display('Prestations de services', 'product', ['products' => $this->productManager->getAllProducts()]);
    }
}