<?php

class Collections
{
    public $auctions;

    public function __construct()
    {
    }

    public function defaultAuctions()
    {
        $this->auctions = [
            new Auction(1, [
                "id" => 1,
                "name" => "Watch",
                "startlot" => "11.10.2022",
                "endlot" => "16.10.2022",
                "firstprice" => 6000,
                "lastprice" => 9000,
            ]),
            new Auction(2, [
                "id" => 2,
                "name" => "TV",
                "startlot" => "18.10.2022",
                "endlot" => "22.10.2022",
                "firstprice" => 30000,
                "lastprice" => 51000,
            ]),
            new Auction(3, [
                "id" => 3,
                "name" => "PC",
                "startlot" => "25.10.2022",
                "endlot" => "26.10.2022",
                "firstprice" => 25000,
                "lastprice" => 40000,
            ]),
            new Auction(4, [
                "id" => 4,
                "name" => "Keyboard",
                "startlot" => "15.10.2022",
                "endlot" => "28.10.2022",
                "firstprice" => 3000,
                "lastprice" => 5000,
            ])
        ];
        return $this;
    }

    public function getAuctionById($id)
    {
        foreach ($this->auctions as $auction) {
            if ($auction->id == $id) {
                return $auction;
            }
        }
        return null;
    }

    public function filterAuction($startlot, $firstprice)
    {
        return array_filter(
            $this->auctions,
            function ($value) use ($startlot, $firstprice) {
                return ($value["firstprice"] == $firstprice and $value["startlot"] > $startlot);
            }
        );
    }

    public function addAuction($auction)
    {
        $this->$auction[] = $auction;
    }

    public function editAuction($array)
    {
        $auction = $this->getAuctionById($array['id']);
        if (!(empty($auction))) {
            $auction->name = $array['id'];
            $auction->startlot = $array['startlot'];
            $auction->endlot = $array['endlot'];
            $auction->firstprice = $array['firstprice'];
            $auction->lastprice = $array['lastprice'];
        }
    }

    public function saveAuction()
    {
        $file = fopen("auction.txt", "w");
        fwrite($file, serialize($this->auctions));
        fclose($file);
    }

    public function loadAuction()
    {
        $this->auctions = unserialize(file_get_contents("auction.txt"));
    }

    public function displayAuction()
    {
        $table = '<table>';
        $table .= "<caption> Auction </caption>";
        $table .= '<tr> <th>id</th> <th>name</th> <th>startlot</th> <th>endlot</th> <th>firstprice</th> <th>lastprice</th> </tr>';

        foreach ($this->auctions as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->name</td><td>$item->startlot</td>" .
                "<td>$item->endlot</td><td>$item->firstprice</td><td>$item->lastprice</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }

    public function displayFilteredAuction($startlot, $firstprice)
    {
        $array = $this->filterAuction($startlot, $firstprice);
        $table = '<table>';
        $table .= "<caption> Auction </caption>";
        $table .= '<tr> <th>id</th> <th>name</th> <th>startlot</th> <th>endlot</th> <th>firstprice</th> <th>lastprice</th> </tr>';

        foreach ($array as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->name</td><td>$item->startlot</td>" .
                "<td>$item->endlot</td><td>$item->firstprice</td><td>$item->lastprice</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}