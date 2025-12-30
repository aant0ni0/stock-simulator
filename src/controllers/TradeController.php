<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Flash.php';
require_once __DIR__ . '/../services/TradeService.php';


class TradeController extends Controller
{
    public function buy(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $stockId = (int)($_POST['stock_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);

        $redirect = $_SERVER['HTTP_REFERER'] ?? '/portfolio';

        try {
            $service = new TradeService();
            $service->buy($_SESSION['user']['id'], $stockId, $quantity);


            Flash::add('success', 'Stock bought successfully.');
            header("Location: $redirect", true, 303);
            exit;
        } catch (RuntimeException $e) {
            Flash::add('error', $e->getMessage());
            header("Location: $redirect", true, 303);
            exit;
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

        $redirect = $_SERVER['HTTP_REFERER'] ?? '/portfolio';

        if ($stockId <= 0 || $quantity <= 0) {
            $this->render('error', ['message' => 'Invalid stock ID or quantity']);
            return;
        }

        try {
            $service = new TradeService();
            $service->sell($_SESSION['user']['id'], $stockId, $quantity);

            Flash::add('success', 'Stock sold successfully.');
            header("Location: $redirect", true, 303);
            exit;
        } catch (RuntimeException $e) {
            Flash::add('error', $e->getMessage());
            header("Location: $redirect", true, 303);
            exit;
        }
    }

    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $stockId = (int)($_POST['stock_id'] ?? 0);
        $qty = (float)($_POST['quantity'] ?? 0);
        $action = $_POST['action'] ?? '';

        $redirect = $_SERVER['HTTP_REFERER'] ?? '/portfolio';

        if ($stockId <= 0 || $qty <= 0) {
            Flash::add('error', 'Invalid data');
            header("Location: $redirect", true, 303);
            exit;
        }

        $service = new TradeService();

        try {
            if ($action === 'buy') {
                $service->buy($_SESSION['user']['id'], $stockId, $qty);
                Flash::add('success', 'Stock bought successfully.');
            } elseif ($action === 'sell') {
                $service->sell($_SESSION['user']['id'], $stockId, $qty);
                Flash::add('success', 'Stock sold successfully.');
            } else {
                Flash::add('error', 'Invalid action');
                header("Location: $redirect", true, 303);
                exit;
            }

            $finalRedirect = $_SERVER['HTTP_REFERER'] ?? ('/asset?id=' . $stockId);
            header("Location: $finalRedirect", true, 303);
            exit;

        } catch (RuntimeException $e) {
            Flash::add('error', $e->getMessage());
            header("Location: $redirect", true, 303);
            exit;
        }
    }
}