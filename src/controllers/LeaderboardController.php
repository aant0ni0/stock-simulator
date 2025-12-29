<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../repository/LeaderboardRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class LeaderboardController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $leaderBoardRepo = new LeaderboardRepository();
        $leaders = $leaderBoardRepo->getLeaderboard();

        $userRepo = new UserRepository();
        foreach ($leaders as &$leader) {
            $leader['change_24h'] = $userRepo->get24hChange($leader['id']);
        }
        unset($leader);

        $this->render('leaderboard', [
            'page' => 'leaderboard',
            'leaders' => $leaders,
            'currentUserId' => $_SESSION['user']['id']
        ]);
    }
}
