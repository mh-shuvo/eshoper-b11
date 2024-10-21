<?php
namespace Atova\Eshoper\Foundation;

use Atova\Eshoper\Foundation\Database;

class Migration {

    private $db;
    private $migrationDir;

    public function __construct() {
        // Initialize the DatabaseHandler instance
        $this->db = new Database();

        // Set the directory where migration files are stored
        $this->migrationDir = base_path("databases/migrations/");
    }

    // Method to run all migration files
    public function runMigrations() {
        
        if(!(bool) getConfig("database.REQUIRED_DB",false)){
            return;
        }

        // Get all .sql files in the migration directory
        $files = glob($this->migrationDir . "*.sql");

        // Check if there are any migration files
        if (empty($files)) {
            // echo "No migration files found.";
            return;
        }

        // Loop through each SQL file and execute
        foreach ($files as $file) {
            $this->runMigrationFile($file);
        }
    }

    // Method to run a single migration file
    private function runMigrationFile($file) {
        // Read SQL file content
        $sql = file_get_contents($file);

        if ($sql === false) {
            // echo "Failed to read migration file: $file";
            return;
        }

        // Execute the SQL using DatabaseHandler
        $this->db->query($sql);

        // Execute and check for success
        if (!$this->db->execute()) {
            throwException("Error executing $file: " . $this->db->getErrors());
        }
    }
}
