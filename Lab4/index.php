<?php

//include "Auction.php";
//include "AuctionCollections.php";
//include 'DBConnect.php';

$dbh = new PDO('mysql:host=localhost;dbname=auctionTable', 'root', '');

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});


$auctionsRepository = new Repository($dbh);




if (!isset($_SESSION)) {
    session_start();
}

//if (empty($_SESSION['Auction'])) {
//    $_SESSION['Auction'] = new AuctionCollections();
//    $_SESSION['Auction']->defaultAuctions();
//}

$actionToDo = $_POST['action'];

if ($actionToDo == 'add') {
    if (Auction::validationDataAuctions($_POST)) {

        $auctionsRepository->createAuction($_POST);
    }
} elseif ($actionToDo == 'edit') {
    if (Auction::validationDataAuctions($_POST)) {

        $auctionsRepository->updateAuction($_POST);
    }
} elseif ($actionToDo == 'delete') {
    $auctionsRepository->deleteAuction($_POST);
}
echo (new Display)->displayAuction($auctionsRepository->readAuctionTable())
?>
<br>

<button onclick="ShowAddForm()"> ADD</button>
<button onclick="ShowEditForm()"> EDIT</button>
<button onclick="ShowDeleteForm()"> DELETE</button>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    ADD <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> startlot:
        <input type='text' name='startlot'>
    </label><br>
    <label> endlot:
        <input type='text' name='endlot'>
    </label><br>
    <label> firstprice:
        <input type='number' name='firstprice'>
    </label><br>
    <label> lastprice:
        <input type='number' name='lastprice'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit' value='add'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='editForm'>
    EDIT <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> startlot:
        <input type='text' name='startlot'>
    </label><br>
    <label> endlot:
        <input type='text' name='endlot'>
    </label><br>
    <label> firstprice:
        <input type='number' name='firstprice'>
    </label><br>
    <label> lastprice:
        <input type='number' name='lastprice'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit' value='edit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='deleteForm'>
    Delete <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <input type='hidden' name='action' value='delete'>
    <input type='submit' value='delete'>
</form>

<br>

<style>
    #addForm {
        display: none;
    }

    #editForm {
        display: none;
    }


    table, th, td {
        border: 1px solid;
        text-align: center;
        background-color: darkorange;
    }

    th {
        width: 100px;
    }

    td {
        height: 50px;
    }
</style>

<script>
    function ShowAddForm() {
        document.querySelector('#addForm').style.display = 'inline';
    }

    function ShowEditForm() {
        document.querySelector('#editForm').style.display = 'inline';
    }

    function ShowDeleteForm() {
        document.querySelector('#deleteForm').style.display = 'inline';
    }
</script>