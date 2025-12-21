<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/LeaderboardRepository.php';

class LeaderboardController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $repo = new LeaderboardRepository();
        $leaders = $repo->getLeaderboard();

        $this->render('leaderboard', [
            'leaders' => $leaders,
            'currentUserId' => $_SESSION['user']['id']
        ]);
    }
}
