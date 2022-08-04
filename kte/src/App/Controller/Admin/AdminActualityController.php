<?php

namespace App\Controller\Admin;

use App\Controller\Guest\HomepageController;
use Library\Http\NotFoundException;

class AdminActualityController extends HomepageController
{
    public function editActuality() {
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $actuality = $this->actualityManager->getActualityById($_GET['id']);
        $this->displayAdmin('Edition de l\'actualité N° ' . $_GET['id'], 'admin/actuality/edit', [
            'actuality' => $actuality
        ]);
    }

    public function updateActuality() {
        if (!auth()->isAdmin()) {
            $this->redirect('/login');
        }
        $actuality = $this->actualityManager->getActualityById($_GET['id']);
        if ($actuality === null) {
            throw new NotFoundException('Actualité non trouvée');
        }
        $this->actualityManager->updateActuality([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'img' => $_POST['img'],
            'date' => $_POST['date']
        ], $actuality->getId());
        flash()->addSuccess('updateActuality', "L'actualité a été modifiée");
        $this->redirect('/admin/actuality');
    }
}