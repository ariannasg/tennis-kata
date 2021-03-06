<?php declare(strict_types=1);

namespace TennisKata\Test;

use PHPUnit\Framework\TestCase;
use TennisKata\TennisGame;
use TennisKata\TennisPlayer;

class TennisGameTest extends TestCase
{
    public function provideGameScoreWhenPlayersWinPoints(): array
    {
        return [
            [0, 0, 'love-love'],
            [0, 1, 'love-fifteen'],
            [0, 2, 'love-thirty'],
            [0, 3, 'love-forty'],
            [1, 0, 'fifteen-love'],
            [1, 1, 'fifteen-fifteen'],
            [1, 2, 'fifteen-thirty'],
            [1, 3, 'fifteen-forty'],
            [2, 0, 'thirty-love'],
            [2, 1, 'thirty-fifteen'],
            [2, 2, 'thirty-thirty'],
            [2, 3, 'thirty-forty'],
            [3, 0, 'forty-love'],
            [3, 1, 'forty-fifteen'],
            [3, 2, 'forty-thirty'],
            [3, 3, 'deuce'],
            [3, 4, 'forty-advantage'],
            [4, 3, 'advantage-forty'],
            [4, 4, 'deuce'],
            [5, 4, 'advantage-forty'],
            [5, 6, 'forty-advantage'],
            [6, 6, 'deuce'],
            [7, 6, 'advantage-forty'],
            [6, 7, 'forty-advantage'],
            [7, 7, 'deuce'],
            [7, 8, 'forty-advantage'],
            [7, 9, 'receiver won'],
            [9, 7, 'server won'],
            [6, 4, 'server won'],
            [5, 5, 'deuce'],
            [3, 5, 'receiver won'],
            [5, 3, 'server won'],
            [4, 0, 'server won'],
            [0, 4, 'receiver won'],
            [4, 1, 'server won'],
            [1, 4, 'receiver won'],
            [4, 2, 'server won'],
            [2, 4, 'receiver won'],
        ];
    }

    /**
     * @dataProvider provideGameScoreWhenPlayersWinPoints
     * @param int $serverPointsWon
     * @param int $receiverPointsWon
     * @param string $expectedGameScore
     */
    public function testGameScoreWhenPlayersWinPoints(
        int $serverPointsWon,
        int $receiverPointsWon,
        string $expectedGameScore
    ): void
    {
        $server = new TennisPlayer();
        $receiver = new TennisPlayer();
        $game = new TennisGame($server, $receiver);

        for ($i = 0; $i < $serverPointsWon; $i++) {
            $server->winPoint();
        }
        for ($i = 0; $i < $receiverPointsWon; $i++) {
            $receiver->winPoint();
        }

        self::assertEquals(
            $expectedGameScore,
            $game->getScore(),
            sprintf('When server wins %dpt and receiver wins %dpt, then the game score should be: "%s"',
                $serverPointsWon,
                $receiverPointsWon,
                $expectedGameScore)
        );
    }
}
