<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/TransactionRepository.php';

class TransactionController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $repo = new TransactionRepository();
        $transactions = $repo->findByUser($_SESSION['user']['id']);

        $this->render('transactions', [
            'transactions' => $transactions
        ]);
    }
}