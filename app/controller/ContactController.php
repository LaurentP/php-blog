<?php

namespace App\Controller;

use App\Asset\Mailer;

class ContactController extends Controller
{
    public function index()
    {
        $result = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hp']) && empty($_POST['hp'])) {
            $result = Mailer::send($_POST);
        }

        $this->render('/contact/index.php', [
            'result' => $result
        ]);
    }
}