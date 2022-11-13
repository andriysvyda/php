<?php

class Display


{
    public function displayAuction($array)
    {
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