<?php

class IndexModel extends Model
{
    /**
     * @param $array array
     * Adds new options to the database
     */
    public function setNewOptions($array)
    {
        $sql = "INSERT INTO options (string) VALUES (:option)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':option', $option, PDO::PARAM_STR);

        foreach ($array as $option) {
            $stmt->execute();
        }
    }

    /**
     * @return array
     * Gets all existing options from the database
     */
    public function getAllOptions()
    {
        $sql = "SELECT * FROM options ";
        $stmt = $this->dbh->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}