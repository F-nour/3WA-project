<?php

namespace App\Controller\Guest;

use Library\Core\AbstractController;

class ProductController extends AbstractController
{

    public function __construct() {
        parent::__construct();
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