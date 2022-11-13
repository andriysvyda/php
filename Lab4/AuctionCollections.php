<?php

class AuctionCollections
{
    public array $auctions=[];

    public function __construct()
    {
    }

    public function defaultAuctions()
    {
        $this->auctions = [
            new Auction(1, [
                'id' => 1,
                'name' => 'Glasses',
                'startlot' => '12.10.2022',
                'endlot' => '15.10.2022',
                'firstprice' => 6000,
                'lastprice' => 9000,
            ]),
            new Auction(2, [
                'id' => 2,
                'name' => 'Iphone',
                'startlot' => '16.10.2022',
                'endlot' => '17.10.2022',
                'firstprice' => 7000,
                'lastprice' => 11000,
            ]),
            new Auction(3, [
                'id' => 3,
                'name' => 'Ipad',
                'startlot' => '18.10.2022',
                'endlot' => '19.10.2022',
                'firstprice' => 9000,
                'lastprice' => 22000,
            ]),
            new Auction(4, [
                'id' => 4,
                'name' => 'MacBook',
                'startlot' => '20.10.2022',
                'endlot' => '21.10.2022',
                'firstprice' => 22000,
                'lastprice' => 33000,
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
                return ($value['firstprice'] == $firstprice and $value['startlot'] > $startlot);
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
}

//    public function saveAuction()
//    {
//        $file = fopen('auction.txt', 'w');
//        fwrite($file, serialize($this->auctions));
//        fclose($file);
//    }
//
//    public function loadAuction()
//    {
//        $this->auctions = unserialize(file_get_contents('auction.txt'));
//    }
//
//    public function displayAuction()
//    {
//        $table = '<table>';
//        $table .= '<caption> Auction </caption>';
//        $table .= '<tr> <th>id</th> <th>name</th> <th>startlot</th> <th>endlot</th> <th>firstprice</th> <th>lastprice</th> </tr>';
//
//        foreach ($this->auctions as $item) {
//            $table .= '<tr><td>$item->id</td><td>$item->name</td><td>$item->startlot</td>' .
//                '<td>$item->endlot</td><td>$item->firstprice</td><td>$item->lastprice</td></tr>';
//        }
//
//        $table .= '</table>';
//        return $table;
//    }
//
//    public function displayFilteredAuction($startlot, $firstprice)
//    {
//        $array = $this->filterAuction($startlot, $firstprice);
//        $table = '<table>';
//        $table .= '<caption> Auction </caption>';
//        $table .= '<tr> <th>id</th> <th>name</th> <th>startlot</th> <th>endlot</th> <th>firstprice</th> <th>lastprice</th> </tr>';
//
//        foreach ($array as $item) {
//            $table .= '<tr><td>$item->id</td><td>$item->name</td><td>$item->startlot</td>' .
//                '<td>$item->endlot</td><td>$item->firstprice</td><td>$item->lastprice</td></tr>';
//        }
//
//        $table .= '</table>';
//        return $table;
//    }
//}