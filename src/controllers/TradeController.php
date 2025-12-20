<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/TradeService.php';

class TradeController extends Controller{
    public function buy(): void{
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $stockId = (int)($_POST['stock_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);

        try{
            $service = new TradeService();
            $service->buy($_SESSION['user']['id'], $stockId, $quantity);
            header('Location: /portfolio');
            exit;
        }catch (RuntimeException $e){
            $this->render('error', ['message' => $e->getMessage()]);
        }
    }

    public function sell(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $stockId = (int)($_POST['stock_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);

        if($stockId <= 0 || $quantity <= 0){
            $this->render('error', ['message' => 'Invalid stock ID or quantity']);
            return;
        }

        try{
            $service = new TradeService();
            $service->sell($_SESSION['user']['id'], $stockId, $quantity);
            header('Location: /portfolio');
            exit;
        } catch (RuntimeException $e) {
            $this->render('error', ['message' => $e->getMessage()]);
        }
    }
}