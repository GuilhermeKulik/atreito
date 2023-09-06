<?php

namespace Atreito\Model;

/**
 * Score Class
 * Represents the score, experience, and level of a user.
 */
class Score extends GenericModel
{
    private $userId;
    private $xpPoints;
    private $points;
    private $level;
    private $lastUpdated;
    private $streak;
    private $highestStreak;

    const XP_NEEDED_FOR_LEVEL_100 = 100000;
    const TABLE_NAME = "score";

    /**
     * Constructor
     * @param PDO $conn
     * @param int $userId
     */
    public function __construct(PDO $conn, $userId)
    {
        parent::__construct($conn);
        $this->userId = $userId;

        $userData = $this->fetch(self::TABLE_NAME, ['user_id' => $userId]);
        if ($userData) {
            $this->xpPoints = $userData['xp_points'];
            $this->points = $userData['points'];
            $this->level = $userData['level'];
            $this->lastUpdated = $userData['last_updated'];
            $this->streak = $userData['streak'];
            $this->highestStreak = $userData['highest_streak'];
        }
    }

    /**
     * Adds experience to the user.
     * @param int $xp
     */
    public function addExperience($xp)
    {
        $this->xpPoints += $xp;
        $this->points += $xp;  // Points are the same as XP for this operation
        $this->checkForLevelUp();
        $this->streakCheck();
        $this->updateScore();
    }

    /**
     * Consumes user's points.
     * @param int $pointsToConsume
     */
    public function consumePoints($pointsToConsume)
    {
        $this->points -= $pointsToConsume;
        $this->updateScore();
    }

    /**
     * Reverts the last points update.
     */
    public function revertLastUpdate()
    {
        // Assuming a history or log table, otherwise, you'll need a different strategy.
        // This is just a placeholder without a log/history table.
    }

    /**
     * Checks if user has enough XP to level up.
     */
    private function checkForLevelUp()
    {
        $xpForNextLevel = self::XP_NEEDED_FOR_LEVEL_100 * pow($this->level, 2);
        if ($this->xpPoints >= $xpForNextLevel) {
            $this->xpPoints -= $xpForNextLevel;
            $this->level++;
        }
    }

    /**
     * Check the user's streak based on last update date.
     */
    public function streakCheck()
    {
        $currentDate = new DateTime();
        $lastUpdated = new DateTime($this->lastUpdated);

        $interval = $currentDate->diff($lastUpdated);
        $hoursElapsed = $interval->h + ($interval->days * 24);

        if ($hoursElapsed <= 24) {
            $this->streak++;
            if ($this->streak > $this->highestStreak) {
                $this->highestStreak = $this->streak;
            }
        } elseif ($hoursElapsed > 24 && $hoursElapsed <= 48) {
            $this->streak = 0;
        }
    }

    /**
     * Update user's data in the database.
     */
    private function updateScore()
    {
        $data = [
            'xp_points' => $this->xpPoints,
            'points' => $this->points,
            'level' => $this->level,
            'last_updated' => date("Y-m-d H:i:s"),
            'streak' => $this->streak,
            'highest_streak' => $this->highestStreak
        ];
        $conditions = ['user_id' => $this->userId];
        
        $this->update(self::TABLE_NAME, $data, $conditions);
    }
}
