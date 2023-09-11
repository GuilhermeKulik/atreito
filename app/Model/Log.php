<?php

use Atreito\Model\GenericModel;

/**
 * Log Model Class
 *
 * This class is responsible for managing the logs in the system.
 * It provides functionalities such as adding logs related to user transactions, errors, and more.
 */
class Log extends GenericModel {

    /**
     * Constructor
     * 
     * Calls the parent constructor to establish a database connection.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Adds a new log entry.
     *
     * @param int $userId The ID of the user who performed the action or encountered the error.
     * @param string $transactionType The type of transaction that took place (e.g., "User Added", "Fatal Error", "Wrong Login").
     * @param string $viewName The name of the view or screen where the action or error occurred.
     * @param string|null $errorMessage An optional error message, applicable for error logs.
     * 
     * @return int The ID of the newly inserted log entry.
     */
    public function addLog($userId, $transactionType, $viewName, $errorMessage = null) {
        $data = [
            'userId' => $userId,
            'transactionType' => $transactionType,
            'viewName' => $viewName,
        ];
        
        if ($errorMessage) {
            $data['errorMessage'] = $errorMessage;
        }

        return $this->insert('log', $data);
    }

    /**
     * Fetches all log entries based on provided filters.
     *
     * @param array $filters An associative array of columns and their corresponding values to filter the results.
     * 
     * @return array The fetched log entries.
     */
    public function getLogs($filters = []) {
        return $this->fetchAll('log', $filters);
    }

}

?>
