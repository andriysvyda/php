<?php
class Repository
{
    public $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function createAuction($array)
    {
        $this->dbh->query('INSERT INTO auctionTable(name, startlot, endlot, firstprice, lastprice) VALUES (' .
            "'" . $array['name'] . "', " .
            "'" . $array['startlot'] . "', " .
            "'" . $array['endlot'] . "', " .
            "'" . $array['firstprice'] . "', " .
            "'" . $array['lastprice'] . "')"
        );
    }

    public function readAuctionTable()
    {
        return $this->dbh->query('SELECT * FROM auctionTable')->fetchAll();
    }

    public function updateAuction($array)
    {
        $this->dbh->query('UPDATE auctionTable SET ' .
            'name ="' . $array['name'] . '", ' .
            'startlot = "' . $array['startlot'] . '", ' .
            'endlot = ' . $array['endlot'] . ', ' .
            'firstprice = "' . $array['firstprice'] . '" , ' .
            'lastprice = "' . $array['lastprice'] . '"' .
            'WHERE id = ' . $array['id']);
    }

    public function deleteAuction($array)
    {
        return $this->dbh->query('DELETE FROM auctionTable WHERE id = ' . $array['id']);
    }
}
