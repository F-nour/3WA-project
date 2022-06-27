<?php

namespace App\Controller\Admin;

use App\Controller\Guest\ProductController;
use App\Model\Table\Product;
use Library\Http\NotFoundException;

class AdminProductController extends ProductController
{
    public function addProduct()
    {
        if (auth()->isAdmin()) {
            $this->displayAdmin('Ajouter un produit', 'admin/product/add');
        } else {
            $this->redirect('/login');
        }
    }

    /**
     * @brief Method to add a product.
     * @method insertProduct()
     * @return void
     */
    public function isertProduct(): void
    {
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $errors = productForm()->productForm($_POST);
        if (count($errors > 0)) {
            $errors = $_SESSION['error'];
            $this->redirect('/admin/product/add');
        }
        $this->productManager->createProduct([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'price_halfday' => $_POST['price_halfday'],
            'price_day' => $_POST['price_day'],
            'traveling_region' => $_POST['traveling_region'],
            'traveling_country' => $_POST['traveling_country'],
            'img' => $_POST['img']
        ]);
        $this->createActuality(
            'Nouvelle offre de service : ' . $_POST['title'],  $_POST['content'], $_POST['img']);
            flash()->addSuccess('product' , 'Le produit a bien été ajouté');
    }

    public function modifyProduct(): void
    {
        if (auth()->isAdmin()) {
            $this->displayAdmin(
                'Modifier le produit ' . $_GET['id'],
                'admin/product/modify',
                ['product' => $this->productManager->getProductById($_GET['id'])]
            );
        } else {
            $this->redirect('/login');
        }
    }

    public function updateProduct(): void
    {
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $errors = productForm()->updateProduct($_POST);
        $event = $this->productManager->getProductById($_GET['id']);
        if ($event == null) {
            throw new NotFoundException('Ce produit n\'existe pas');
        }
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/admin/product/modifyProduct?id=' . $event);
        }
        $this->productManager->updateProduct([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'price_halfday' => $_POST['price_halfday'],
            'price_day' => $_POST['price_day'],
            'traveling_region' => $_POST['traveling_region'],
            'traveling_country' => $_POST['traveling_country'],
            'img' => $_POST['img']
        ], $_GET['id']);
        flash()->addSuccess('product', "Le produit a été modifié");
        $this->redirect('/products');
    }

    public function deleteProduct(): void
    {
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $product = $this->productManager->getProductById($_GET['id']);
        if ($product == null) {
            throw new NotFoundException('Ce produit n\'existe pas');
        }
        $this->productManager->deleteProduct($_GET['id']);
        $this->createActuality(
            "Suppression de l'offre de servie : " . $product->getTitle(),
            "Depuis ce jour, nous ne proposons plus l'offre de serivce " . $product->getTitle() . ".");
        flash()->addSuccess('product', "Le produit a été supprimé");
        $this->redirect('/products');
    }
}