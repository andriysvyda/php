<?php

include "Auction.php";
include "Collections.php";

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Auction'])) {
    $_SESSION['Auction'] = new Collections();
    $_SESSION['Auction']->defaultAuctions();
}

$actionToDo = $_POST['action'];

if ($actionToDo == 'add') {
    if (Auction::validationDataAuctions($_POST)) {
        $_SESSION['Auction']->addAuction(
            new Auction(5, $_POST)
        );
    }
} elseif ($actionToDo == 'edit') {
    if (Auction::validationDataAuctions($_POST)) {
        $_SESSION['Auction']->editAuction(
            $_POST
        );
    }
} elseif ($actionToDo == 'filter') {
    echo $_SESSION['Auction']->displayFilteredAuction($_POST['name'], $_POST['time']);
} elseif ($actionToDo == 'save') {
    $_SESSION['Auction']->saveAuction();
} elseif ($actionToDo == 'load') {
    $_SESSION['Auction']->loadAuction();
}

echo $_SESSION['Auction']->displayAuction();
?>
<br>

<button onclick="ShowAddForm()"> ADD</button>
<button onclick="ShowEditForm()"> EDIT</button>
<button onclick="ShowFilterForm()"> FILTER</button>

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

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> startlot:
        <input type='text' name='startlot'>
    </label><br>
    <label> firstprice:
        <input type='number' name='firstprice'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit' value='filter'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='save'>
    <input type='hidden' name='action' value='save'>
    <input type='submit' value='Save to file'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='load'>
    <input type='hidden' name='action' value='load'>
    <input type='submit' value='Upload from file'>
</form>

<style>
    #addForm {
        display: none;
    }

    #editForm {
        display: none;
    }

    #filterForm {
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

    function ShowFilterForm() {
        document.querySelector('#filterForm').style.display = 'inline';
    }
</script>