<?php

function defaultDataLots()
{
    return [
        [
            "id" => 1,
            "name" => "Glasses",
            "startl" => "12.10.2022",
            "endl" => "15.10.2022",
            "fprice" => 6000,
            "lprice" => 9000,

        ],
        [
            "id" => 2,
            "name" => "Istartl",
            "startl" => "16.10.2022",
            "endl" => "22.10.2022",
            "fprice" => 10000,
            "lprice" => 15000,
        ],
        [
            "id" => 3,
            "name" => "Istartl",
            "startl" => "16.10.2022",
            "endl" => "22.10.2022",
            "fprice" => 10000,
            "lprice" => 15000,
        ],
    ];
}

function CreateNewLot($array, $id)
{
    return [
        'id' => $id,
        'name' => $array['name'],
        'startl' => $array['startl'],
        'endl' => $array['endl'],
        'fprice' => $array['fprice'],
        'lprice' => $array['lprice'],
    ];
}

function validationDataLots($array)
{
    return !(
        empty($array['name']) ||
        empty($array['startl']) ||
        empty($array['endl']) ||
        empty($array['fprice']) ||
        empty($array['lprice']) ||
        $array['startl'] < 0 ||
        $array['fprice'] < 0 ||
        !isset($array)
    );
}

function sortBySmth($arr, $startl, $fprice)
{
    return array_filter(
        $arr,
        function ($value) use ($startl, $fprice) {
            return ($startl == $value["startl"] && $value["fprice"] < $fprice);
        }
    );
}

function displayTableLots($array, $caption)
{
    $table = '<table>';
    $table .= "<caption> $caption </caption>";
    $table .= '<tr> <th>id</th> <th>name</th> <th>startl</th> <th>endl</th> <th>fprice</th> <th>lprice</th> </tr>';

    foreach ($array as $item) {
        $table .= "<tr>" .
            "<td>$item[id]</td><td>$item[name]</td><td>$item[startl]</td>" .
            "<td>$item[endl]</td><td>$item[fprice]</td><td>$item[lprice]</td>" .
            "</tr>";
    }

    $table .= '</table>';
    echo $table;
}

if (!isset($_SESSION)) {
    session_start();
}

// setting default values
if (empty($_SESSION)) {
    $_SESSION['Auction'] = defaultDataLots();
}

$actionToDo = $_POST['action'];

// adding client
if ($actionToDo == 'add') {
    if (validationDataLots($_POST)) {
        $nextLotIdE = count($_SESSION['Lots']) + 1;
        $_SESSION['Lots'][] = CreateNewLot($_POST, $nextLotIdE);
    }
} // editing client
elseif ($actionToDo == 'edit') {
    if (validationDataLots($_POST)) {
        $idToEdit = $_POST['id'];
        foreach ($_SESSION['Lots'] as $key => $value) {
            if ($value['id'] == $idToEdit) {
                $_SESSION['Lots'][$key] = CreateNewLot($_POST, $idToEdit);
                break;
            }
        }
    }
} // filtering Lots
elseif ($actionToDo == 'filter') {
    displayTableLots(
        sortBySmth($_SESSION['Lots'], $_POST['name'], $_POST['fprice']),
        'Specified Lots'
    );
} // saving data to Lots.txt
elseif ($actionToDo == 'save') {
    $file = fopen("Lots.txt", "w");
    fwrite($file, serialize($_SESSION['Lots']));
    fclose($file);
} // loading data from Lots.txt
elseif ($actionToDo == 'load') {
    $_SESSION['Lots'] = unserialize(file_get_contents("Lots.txt"));
}

// display all Lots
displayTableLots($_SESSION['Lots'], 'Lots');

unset($_POST);
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
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> endl:
        <input type='text' name='startl'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
    </label><br>
    <label> lprice:
        <input type='number' name='lprice'>
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
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
    </label><br>
    <label> lprice:
        <input type='number' name='lprice'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit' value='edit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
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
