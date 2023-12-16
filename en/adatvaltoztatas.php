<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/adatvaltoztatas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css ">
    <title>Loadeat • Restoran</title>
</head>

<body>


<?php

session_start();
if(!isset($_SESSION['ID']))
{
    header("Location: bejelentkezes");
    exit();
}
else
{
    $ProfilID = $_SESSION['ID'];
    $Felhasznalonev = $_SESSION['Felhasznalonev'];
}

require_once '../php/conn.php';



$sql = "SELECT * FROM etterem WHERE profID = $ProfilID";
        $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $tulajdonosNev = $row['tulajdonosNev'];
        $igazolvanyAzonosito = $row['igazolvanyazonosito'];
        $megye = $row['megye'];
        $tel = $row['telefon'];
        $tulajCim = $row['tulajcim'];
        $iban = $row['iban'];

        $etteremneve = $row['etteremnev'];
        $orszag = $row['orszag'];
        $telepules = $row['telepules'];
        $cim = $row['cim'];
        $fizetes = '';
        $onlineFizetes = $row['onlinefizetes'];
        if ($onlineFizetes == 1) {
            $fizetes .= 'Online, ';
        }
        $helykeszpenz = $row['helykeszpenz'];
        if ($helykeszpenz == 1) {
            $fizetes .= 'Helyszíni készpénzes,';
        }
         $helykartya = $row['helykartya'];
        if ($helykartya == 1) {
            $fizetes .= 'Helyszíni kártyás';
        }
        $etteremleiras = $row['etteremleiras'];
        $menuID = $row['menuID'];

    }


    $sql = "SELECT * FROM menuk WHERE menuID = $menuID";
        $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $menunev1 = $row['menu1_nev'];
        $menutartalom1 = $row['menu1_tartalom'];
        $menuareur1 = $row['menu1_areur'];
        $menuarhuf1 = $row['menu1_arhuf'];
        $menuarrsd1 = $row['menu1_arrsd'];

         $menunev2 = $row['menu2_nev'];
        $menutartalom2 = $row['menu2_tartalom'];
        $menuareur2 = $row['menu2_areur'];
        $menuarhuf2 = $row['menu2_arhuf'];
        $menuarrsd2 = $row['menu2_arrsd'];


         $menunev3 = $row['menu3_nev'];
        $menutartalom3 = $row['menu3_tartalom'];
        $menuareur3 = $row['menu3_areur'];
        $menuarhuf3 = $row['menu3_arhuf'];
        $menuarrsd3 = $row['menu3_arrsd'];
        

    }





?>

    <div class="conntent">
        <form action="">
            <section id="tulajdonosAdatai">
                <h1>Restaurant owner information</h1>
                <table>
                    <tr>
                        <td>Full Name/Business Name:</td>
                        <td id="teljesnev"><?php echo $tulajdonosNev; ?>
                        </td>
                        <td><button id="teljesnevButton" onclick="modifyData('teljesnev')">Change</button></td>
                    </tr>
                    <tr>
                        <td> Tax number:</td>
                        <td id="szemelyi"><?php echo $igazolvanyAzonosito; ?></td>
                        <td><button id="szemelyiButton" onclick="modifyData('szemelyi')">Change</button></td>
                    </tr>
                    <tr>
                        <td> District / County / Province:</td>
                        <td id="szuldatum"><?php echo $megye; ?></td>
                        <td><button id="szuldatumButton" onclick="modifyData('szuldatum')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td id="telszam"><?php echo $tel; ?></td>
                        <td><button id="telszamButton" onclick="modifyData('telszam')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Residential address (Country, city, street and number):</td>
                        <td id="pontoscim"><?php echo $tulajCim; ?></td>
                        <td><button id="pontoscimButton" onclick="modifyData('pontoscim')">Change</button></td>
                    </tr>
                    <tr>
                        <td> IBAN number:</td>
                        <td id="ibanszam"><?php echo $iban; ?></td>
                        <td><button id="ibanszamButton" onclick="modifyData('ibanszam')">Change</button></td>
                    </tr>
                </table>
            </section>
        </form>

        <form method="POST" action="../php/editrestoran.php" id="teljesnevForm" style="display: none;">
            <input type="hidden" id="teljesnevEditingFieldId" >
            <input type="text" name="nev" id="teljesnevInputField" placeholder="" required>
            <button name="subnev">Save</button>
        </form>

        <form id="szemelyiForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="szemelyiEditingFieldId">
            <input type="text" name="igazolvanyszam" placeholder=""  id="szemelyiInputField" required>
            <button name="subigaz">Save</button>
        </form>

        <form id="szuldatumForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="szuldatumEditingFieldId">
            <input type="text" name="szuldatum" required="required" placeholder="District / County / Province" id="szuldatumInputField">
            <button name="subszuldat">Save</button>
        </form>

        <form id="telszamForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="telszamEditingFieldId">
            <input type="number" name="tel" placeholder="Tel" id="telszamInputField" required>
            <button name="subtel">Save</button>
        </form>

        <form id="pontoscimForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="pontoscimEditingFieldId">
            <input type="text" name="cim" placeholder=""  id="pontoscimInputField" required>
            <button name="subcim">Save</button>
        </form>

        <form id="ibanszamForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="ibanszamEditingFieldId">
            <input type="text" name="iban" placeholder="Pl: RS42 1177 3058 0568 9984 0000 0000" id="ibanszamInputField" required>
            <button name="subiban">Save</button>
        </form>





        <div>
            <section id="etteremAdatai">
                <h1>Restaurant data</h1>
                <table>
                    <tr>
                        <td>Name of the restaurant:</td>
                        <td id="etteremnev"><?php echo $etteremneve; ?></td>
                        <td><button id="etteremnevButton" onclick="modifyData('etteremnev')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Country of the restaurant:</td>
                        <td id="orszag"><?php echo $orszag; ?></td>
                        <td><button id="orszagButton" onclick="modifyData('orszag')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Name of the restaurant's settlement:</td>
                        <td id="telepules"><?php echo $telepules; ?></td>
                        <td><button id="telepulesButton" onclick="modifyData('telepules')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Street and address:</td>
                        <td id="utcahazszam"><?php echo $cim; ?></td>
                        <td><button id="utcahazszamButton" onclick="modifyData('utcahazszam')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Payment methods:</td>
                        <td id="fizetesiLehetosegek"><?php echo $fizetes; ?></td>
                        <td><button id="fizetesiLehetosegekButton" onclick="modifyData('fizetesiLehetosegek')">Change</button></td>
                    </tr>
                    <tr>
                        <td>The restaurant's description:</td>
                        <td id="etteremLeiras"><?php echo $etteremleiras; ?></td>
                        <td><button id="etteremLeirasButton">Change</button></td>
                    </tr>
                    <tr>
                        <td>Pictures of the restaurant (max. 5 pieces):</td>
                        <td>
                            <div class="root" id="rootDiv1" style="display: none;">
                                <form method="POST" action="../php/editrestoran.php" enctype="multipart/form-data">                                    
                                   <input type="file" name="kepek[]" accept=".jpg, .jpeg, .png, .webp" multiple="multiple" required>
                                    <button name="subetkepek">Sačuvaj</button>
                                </form>
                            </div>
                        </td>
                        <td><button id="megnyitasGomb1">Change</button></td>
                    </tr>
                </table>
            </section>
        </div>

        <form id="etteremnevForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="etteremnevEditingFieldId">
            <input type="text" name="etteremnev" placeholder="" required id="etteremnevInputField">
            <button name="subetteremnev">Save</button>
        </form>

        <form id="orszagForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="orszagEditingFieldId">
            <input type="text" name="orszag" placeholder="" required id="orszagInputField">
            <button name="suborszag">Save</button>
        </form>

        <form id="telepulesForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="telepulesEditingFieldId">
            <input type="text" name="telepules" placeholder="" required id="telepulesInputField">
            <button name="subtelep">Save</button>
        </form>

        <form id="utcahazszamForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="utcahazszamEditingFieldId">
            <input type="text" name="utcahazszam" placeholder="" required id="utcahazszamInputField">
            <button name="subetcim">Save</button>
        </form>

        <form id="fizetesiLehetosegekForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="fizetesiLehetosegekEditingFieldId">
            <input type="checkbox" name="kartya" id="fizetesiLehetosegekInputField" style="width: 15px;">
            <label for="kartya">Card payment on the spot</label>
            <br>
            <input type="checkbox" name="keszpenz" id="fizetesiLehetosegekInputField" style="width: 15px;">
            <label for="kartya">Cash payment on the spot</label>
            <br>
            <button name="subfizetes">Save</button>
        </form>

        <form id="etteremLeirasForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="etteremLeirasEditingFieldId">
            <input type="text" name="bemutatas" placeholder="" maxlength="1000" required id="etteremLeirasInputField">
            <button name="subetleiras">Save</button>
        </form>

        <form id="etteremKepekForm" style="display: none;">
            <input type="hidden" id="etteremKepekEditingFieldId">
            <input type="image" id="etteremKepekInputField">
            <button type="submit" id="etteremKepekSaveButton">Save</button>
        </form>

        <div>
            <section id="elsoMenu">
                <table>
                    <h2>First menu</h2>
                    <tr>
                        <td>Name of menu:</td>
                        <td id="elsoMenunev"><?php echo $menunev1; ?></td>
                        <td><button id="elsoMenunevButton" onclick="modifyData('elsoMenunev')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Contents and description of menu:</td>
                        <td id="elsoMenutartalom"><?php echo $menutartalom1; ?></td>
                        <td><button id="elsoMenutartalomButton" onclick="modifyData('elsoMenutartalom')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Euros (Global):</td>
                        <td id="elsoMenuareur"><?php echo $menuareur1; ?> EUR</td>
                        <td><button id="elsoMenuareurButton" onclick="modifyData('elsoMenuareur')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Forints (Hungary):</td>
                        <td id="elsoMenuarhuf"><?php echo $menuarhuf1; ?> HUF</td>
                        <td><button id="elsoMenuarhufButton" onclick="modifyData('elsoMenuarhuf')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Dinars (Serbia):</td>
                        <td id="elsoMenuarrsd"><?php echo $menuarrsd1; ?> RSD</td>
                        <td><button id="elsoMenuarrsdButton" onclick="modifyData('elsoMenuarrsd')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Pictures of the first menu (max. 5 pieces):</td>
                        <td>
                            <div id="rootDiv2" class="root" style="display: none;">
                                <form method="POST" action="../php/editrestoran.php" enctype="multipart/form-data">                                    
                                   <input type="file" name="kepek[]" accept=".jpg, .jpeg, .png, .webp" multiple="multiple" required>
                                    <button name="submenu1kepek">Save</button>
                                </form>
                            </div>
                        </td>
                        <td><button id="megnyitasGomb2">Change</button></td>
                    </tr>
                </table>
            </section>
        </div>

        <form id="elsoMenunevForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="elsoMenunevEditingFieldId">
            <input type="text" name="elsomenunev" placeholder="" required id="elsoMenunevInputField">
            <button name="submenu1nev">Save</button>
        </form>

        <form id="elsoMenutartalomForm" style="display: none;" method="POST" action="php/editrestoran.php">
            <input type="hidden" id="elsoMenutartalomEditingFieldId">
            <input type="text" name="elsomenutartalom" placeholder="" maxlength="2000" id="elsoMenutartalomInputField" required>
            <button name="submenu1tart">Save</button>
        </form>

        <form id="elsoMenuareurForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="elsoMenuareurEditingFieldId">
            <input type="number" name="elsomenuareur" placeholder="X EUR" required id="elsoMenuareurInputField">
            <button name="submenu1areur">Save</button>
        </form>

        <form id="elsoMenuarhufForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="elsoMenuarhufEditingFieldId">
            <input type="number" name="elsomenuarhuf" placeholder="X HUF" required id="elsoMenuarhufInputField">
            <button name="submenu1arhuf">Save</button>
        </form>

        <form id="elsoMenuarrsdForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="elsoMenuarrsdEditingFieldId">
            <input type="number" name="elsomenuarrsd" placeholder="X RSD" required id="elsoMenuarrsdInputField">
            <button name="submenu1arrsd">Save</button>
        </form>


        


        <div>
            <section id="masodikMenu">
                <table>
                    <h2>Secound menu:</h2>
                    <tr>
                        <td>Name of menu:</td>
                        <td id="masodikMenunev"><?php echo $menunev2; ?></td>
                        <td><button id="masodikMenunevButton" onclick="modifyData('masodikMenunev')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Contents and description of menu:</td>
                        <td id="masodikMenutartalom"><?php echo $menutartalom2; ?></td>
                        <td><button id="masodikMenutartalomButton" onclick="modifyData('masodikMenutartalom')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Euros (Global):</td>
                        <td id="masodikMenuareur"><?php echo $menuareur2; ?> EUR</td>
                        <td><button id="masodikMenuareurButton" onclick="modifyData('masodikMenuareur')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Forints (Hungary):</td>
                        <td id="masodikMenuarhuf"><?php echo $menuarhuf2; ?> HUF</td>
                        <td><button id="masodikMenuarhufButton" onclick="modifyData('masodikMenuarhuf')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Dinars (Serbia):</td>
                        <td id="masodikMenuarrsd"><?php echo $menuarrsd2; ?> RSD</td>
                        <td><button id="masodikMenuarrsdButton" onclick="modifyData('masodikMenuarrsd')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Pictures of the first menu (max. 5 pieces): </td>
                        <td>
                            <div id="rootDiv3" class="root" style="display: none;">
                                <form method="POST" action="../php/editrestoran.php" enctype="multipart/form-data">                                    
                                   <input type="file" name="kepek[]" accept=".jpg, .jpeg, .png, .webp" multiple="multiple" required>
                                    <button name="submenu2kepek">Save</button>
                                </form>
                            </div>
                        </td>
                        <td><button id="megnyitasGomb3">Change</button></td>
                    </tr>
                </table>
            </section>
        </div>

        <form id="masodikMenunevForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="masodikMenunevEditingFieldId">
            <input type="text" name="masodikmenunev" placeholder="" required id="masodikMenunevInputField">
            <button name="submenu2nev">Save</button>
        </form>

        <form id="masodikMenutartalomForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="masodikMenutartalomEditingFieldId">
            <input type="text" name="masodikmenutartalom" placeholder="" maxlength="2000" required id="masodikMenutartalomInputField">
            <button name="submenu2tart">Save</button>
        </form>

        <form id="masodikMenuareurForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="masodikMenuareurEditingFieldId">
            <input type="number" name="masodikmenuareur" placeholder="X EUR" required id="masodikMenuareurInputField">
            <button name="submenu2areur">Save</button>
        </form>

        <form id="masodikMenuarhufForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="masodikMenuarhufEditingFieldId">
            <input type="number" name="masodikmenuarhuf" placeholder="X HUF" required id="masodikMenuarhufInputField">
            <button name="submenu2arhuf">Save</button>
        </form>

        <form id="masodikMenuarrsdForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="masodikMenuarrsdEditingFieldId">
            <input type="number" name="masodikmenuarrsd" placeholder="X RSD" required id="masodikMenuarrsdInputField">
            <button name="submenu2arrsd">Save</button>
        </form>

        


        <div>
            <section id="harmadikMenu">
                <table>
                    <h2>Third menu</h2>
                    <tr>
                        <td>Name of menu:</td>
                        <td id="harmadikMenunev"><?php echo $menunev3; ?></td>
                        <td><button id="harmadikMenunevButton" onclick="modifyData('harmadikMenunev')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Contents and description of menu:</td>
                        <td id="harmadikMenutartalom"><?php echo $menutartalom3; ?></td>
                        <td><button id="harmadikMenutartalomButton" onclick="modifyData('harmadikMenutartalom')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Euros (Global):</td>
                        <td id="harmadikMenuareur"><?php echo $menuareur3; ?> EUR</td>
                        <td><button id="harmadikMenuareurButton" onclick="modifyData('harmadikMenuareur')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Forints (Hungary):</td>
                        <td id="harmadikMenuarhuf"><?php echo $menuarhuf3; ?> HUF</td>
                        <td><button id="harmadikMenuarhufButton" onclick="modifyData('harmadikMenuarhuf')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Price of menu in Dinars (Serbia):</td>
                        <td id="harmadikMenuarrsd"><?php echo $menuarrsd3; ?> RSD</td>
                        <td><button id="harmadikMenuarrsdButton" onclick="modifyData('harmadikMenuarrsd')">Change</button></td>
                    </tr>
                    <tr>
                        <td>Pictures of the first menu (max. 5 pieces):</td>
                        <td>
                            <div id="rootDiv4" class="root" style="display: none;">
                                <form method="POST" action="../php/editrestoran.php" enctype="multipart/form-data">                                    
                                   <input type="file" name="kepek[]" accept=".jpg, .jpeg, .png, .webp" multiple="multiple" required>
                                    <button name="submenu3kepek">Save</button>
                                </form>
                            </div>
                        </td>
                        <td><button id="megnyitasGomb4">Change</button></td>
                    </tr>
                </table>
            </section>
        </div>

        <form id="harmadikMenunevForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="harmadikMenunevEditingFieldId">
            <input type="text" name="harmadikmenunev" placeholder="" required id="harmadikMenunevInputField">
            <button name="submenu3nev">Save</button>
        </form>

        <form id="harmadikMenutartalomForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="harmadikMenutartalomEditingFieldId">
            <input type="text" name="harmadikmenutartalom" placeholder="" maxlength="2000" id="harmadikMenutartalomInputField" required>
            <button name="submenu3tart">Save</button>
        </form>

        <form id="harmadikMenuareurForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="harmadikMenuareurEditingFieldId">
            <input type="number" name="harmadikmenuareur" placeholder="X EUR" required id="harmadikMenuareurInputField">
            <button name="submenu3areur">Save</button>
        </form>

        <form id="harmadikMenuarhufForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="harmadikMenuarhufEditingFieldId">
            <input type="number" name="harmadikmenuarhuf" placeholder="X HUF" required id="harmadikMenuarhufInputField">
            <button name="submenu3arhuf">Save</button>
        </form>

        <form id="harmadikMenuarrsdForm" style="display: none;" method="POST" action="../php/editrestoran.php">
            <input type="hidden" id="harmadikMenuarrsdEditingFieldId">
            <input type="number" name="harmadikmenuarrsd" placeholder="X RSD" required id="harmadikMenuarrsdInputField">
            <button name="submenu3arrsd">Save</button>
        </form>

     <div class="buttons">
<?php
            echo "<a href='etterem?eid=$etteremID' target='_blank'>Restaurant preview</a>";
?>
</div>   


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modositasButtons = document.querySelectorAll("[id$='Button']");

            modositasButtons.forEach(function(button) {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const fieldId = button.id.replace("Button", "");
                    const field = document.getElementById(fieldId);
                    const editForm = document.getElementById(fieldId + "Form");
                    const editingFieldIdInput = document.getElementById(fieldId + "EditingFieldId");
                    const inputField = document.getElementById(fieldId + "InputField");
                    const saveButton = document.getElementById(fieldId + "SaveButton");

                    if (editForm.style.display === "none") {
                        const oldValue = field.innerText;
                        editingFieldIdInput.value = fieldId;
                        if (fieldId === "szuldatum") {
                            inputField.value = oldValue;
                        } else {
                            inputField.value = oldValue;
                        }
                        editForm.style.display = "block";
                        field.innerText = "";
                    }

                    saveButton.addEventListener("click", function() {
                        const fieldId = editingFieldIdInput.value;
                        const field = document.getElementById(fieldId);
                        const newValue = inputField.value;

                        if (fieldId.includes("areur")) {
                            if (newValue !== "") {
                                field.innerText = newValue + " EUR";
                            } else {
                                field.innerText = "Nincs érték megadva";
                            }
                        } else if (fieldId.includes("arhuf")) {
                            if (newValue !== "") {
                                field.innerText = newValue + " HUF";
                            } else {
                                field.innerText = "Nincs érték megadva";
                            }
                        } else if (fieldId.includes("arrsd")) {
                            if (newValue !== "") {
                                field.innerText = newValue + " RSD";
                            } else {
                                field.innerText = "Nincs érték megadva";
                            }
                        } else if (fieldId === "szuldatum") {
                            if (newValue !== "") {
                                field.innerText = newValue;
                            } else {
                                field.innerText = "Nincs dátum";
                            }
                        } else {
                            if (newValue !== "") {
                                field.innerText = newValue;
                            } else {
                                field.innerText = "Nincs érték megadva";
                            }
                        }
                        editForm.style.display = "none";
                    });
                });
            });
        });

        function fileRootDiv(divId) {
            const rootDiv = document.getElementById(divId);
            if (rootDiv.style.display === "none" || rootDiv.style.display === "") {
                rootDiv.style.display = "block";
            } else {
                rootDiv.style.display = "none";
            }
        }

        document.getElementById("megnyitasGomb1").addEventListener("click", function() {
            event.preventDefault();
            fileRootDiv("rootDiv1");
        });

        document.getElementById("megnyitasGomb2").addEventListener("click", function() {
            event.preventDefault();
            fileRootDiv("rootDiv2");
        });

        document.getElementById("megnyitasGomb3").addEventListener("click", function() {
            event.preventDefault();
            fileRootDiv("rootDiv3");
        });

        document.getElementById("megnyitasGomb4").addEventListener("click", function() {
            event.preventDefault();
            fileRootDiv("rootDiv4");
        });
    </script>

    <script>
        function validateForm() {
            var fileInput = document.getElementById('etteremKepekInputField');
            var files = fileInput.files;
            
            if (files.length > 5) {
                alert('Legfeljebb 5 képet választhatsz ki az étteremről. Kérlek használd az utasítások szerint oldalunkat.');
                return false;
            }
            
            return true;
        }
    </script>

</body>

</html>