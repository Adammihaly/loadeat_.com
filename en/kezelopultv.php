<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Loadeat • Panel</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css ">
	<link rel="stylesheet" type="text/css" href="../css/kpult.css">
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


?>



	<div id="phone-menu">
		<div id="phone-menu-header">
			<span>Meni</span>
			<i class="bi bi-x-circle-fill" id="phone-menu-close"></i>
		</div>
		<ul id="phone-menu-content">
			<li>
				<a href="#####" class="phone-menu-button">
					<i class="bi bi-house-fill"></i>
					<span>Home Page</span>
				</a>
			</li>
			<!-- <li>
				<a href="#####" class="phone-menu-button" id="phone-chat-button">
					<i class="bi bi-chat-left-text-fill"></i>
					<span>Chat</span>
				</a>
			</li> -->
			<li>
				<a href="#####" class="phone-menu-button" id="phone-chat-button">
					<i class="bi bi-question-diamond-fill"></i>
					<span>Help</span>
				</a>
			</li>
			<li>
				<a href="../php/logout.php" class="phone-menu-button">
					<i class="bi bi-box-arrow-up-right"></i>
					<span>Log Out</span>
				</a>
			</li>
		</ul>
	</div>
	<div id="chat-menu">
		<div id="chat-menu-header">
			<span>Beszélgetések</span>
			<i class="bi bi-x-circle-fill" id="chat-menu-close"></i>
		</div>
		<ul id="chat-menu-content">
			<li class="chat-head">
				<a href="####" class="chat-head-content" target="_blank">
					<img src="img/img3.jpg">
					<div>
						<span class="chat-head-title">Kis János</span>
						<span>Én : szép napot</span>
					</div>
				</a>
			</li>
			<li class="chat-head">
				<a href="####" class="chat-head-content" target="_blank">
					<img src="img/img3.jpg">
					<div>
						<span class="chat-head-title">Erika Teller</span>
						<span>Erika: igen</span>
					</div>
				</a>
			</li>
			<li class="chat-head">
				<a href="####" class="chat-head-content" target="_blank">
					<img src="img/img3.jpg">
					<div>
						<span class="chat-head-title">Halász Dév</span>
						<span>Én: Mennyi?</span>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<div class="menu">
		<div class="left-item">
			<a href="#"><img src="../img/logo.jpg" alt="logo" class="logo"></a>
		</div>
		<div id="phone-list-icon">
			<i class="bi bi-list" style="font-size: 1.5rem;"></i>
		</div>
		<div class="right-item flex-center">
		<!--	<a href="#" class="flex-center button"><i class="bi bi-chat-left-text-fill" id="chat-button"></i></a>&nbsp;
			<a href="#" class="flex-center button"><i class="bi bi-question-diamond-fill" id="chat-button"></i></a> -->

			<a href="">
				<div class="profile flex-center">
					<img src="../img/logo.jpg">
					<span><?php echo $Felhasznalonev ?></span>
				</div>
			</a>
			<a href="../php/logout.php" class="flex-center button"><i class="bi bi-box-arrow-up-right"></i></a>
		</div>
	</div>


	<?php

	require_once '../php/conn.php';

	$sql = "SELECT * FROM tulaj_prof WHERE ID = $ProfilID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$vaneetterem = $row['etterem'];

	if ($vaneetterem != 1) {
		echo "<a class='etterem' href='etteremreg'>
		<img src='img/add.png' alt=''>
		<h3>Dodaj restoran</h3>
	</a>";
	}
	else
	{
		echo "<a class='etterem' href='adatvaltoztatas'>
		<img src='img/edit.png' alt=''>
		<h3>Menadžment restorana</h3>
	</a>";
	}

	


}

	?>


	



	<div class="content">
		<div id="recent">
			<div class="content-header flex-center">
				<i class="bi bi-calendar-fill p25"></i>
				<h1 style="margin-bottom: 2rem">Active reservations</h1>
				<p style="margin: 0 10% 1rem; font-family: var(--s-font);">You can find the active reservations below. Following a meal, a given reservation will move to the Reservation history.
In case of a reservation, clicking the arrow pointing down will show the reservation details.</p>
			</div>
			<?php


			$nincsetterem = 1;
			$etteremID = '';
			$szamlalo1 = 0;


			$sqll = "SELECT * FROM foglalasok WHERE vendegID = $ProfilID";
		$resultt = $conn->query($sqll);
	while ($roww = $resultt->fetch_assoc()) {

		$etteremID = $roww['etteremID'];
		if ($etteremID == null) {
			$nincsetterem = 0;
		}
	


			$sql = "SELECT * FROM etterem WHERE ID = $etteremID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$etteremNev = $row['etteremnev']; 
		$etteremTelepules = $row['telepules'];
		$menuID = $row['menuID'];

	}



if ($nincsetterem != 0) {
	

	$sql = "SELECT * FROM menuk WHERE menuID = $menuID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$menu1nev = $row['menu1_nev'];
		$menu2nev = $row['menu2_nev']; 
		$menu3nev = $row['menu3_nev']; 

		$menu1arhuf = $row['menu1_arhuf']; 
		$menu2arhuf = $row['menu2_arhuf']; 
		$menu3arhuf = $row['menu3_arhuf']; 

		$menu1areur = $row['menu1_areur']; 
		$menu2areur = $row['menu2_areur']; 
		$menu3areur = $row['menu3_areur'];

		$menu1arrsd = $row['menu1_arrsd'];
		$menu2arrsd = $row['menu2_arrsd']; 
		$menu3arrsd = $row['menu3_arrsd'];  
 


	}

	

	if ($etteremID != null) {
		
			$sql = "SELECT * FROM foglalasok WHERE vendegID = $ProfilID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$datum = $row['datum'];
		$idopont = $row['idopont'];
		$nev = $row['nev'];
		$tel = $row['tel'];
		$szuldat = $row['szulDatum'];
		$letszam = $row['letszam'];
		$penznem = $row['penznem'];
		$elsomenu = $row['elsomenu'];
		$masodikmenu = $row['masodikmenu'];
		$harmadikmenu = $row['harmadikmenu'];
		$idopont = $row['idopont'];
		$fizetes = $row['fizetes'];


		if ($fizetes == 'Helyszíni készpénzes fizetés') {
			$fizetes = 'Cash payment on the spot';
		}
		else if ($fizetes == 'Helyszíni bankkártyás fizetés') {
			$fizetes = 'Card payment on the spot';
		}
		else if ($fizetes == 'Online fizetés') {
			$fizetes = 'Online';
		}

		$foglalasazon = $row['foglalasID'];
		$vegosszeg = 0;
		$penznemk = '';

		if ($penznem == 'huf') { 
			$vegosszeg = ($elsomenu*$menu1arhuf) + ($masodikmenu*$menu2arhuf) + ($harmadikmenu*$menu3arhuf);
			$penznemk = 'Ft';
		}
		else if ($penznem == 'eur') {
			$vegosszeg = ($elsomenu*$menu1areur) + ($masodikmenu*$menu2areur) + ($harmadikmenu*$menu3areur);
			$penznemk = 'EUR';
		}
		else if ($penznem == 'rsd') {
			$vegosszeg = ($elsomenu*$menu1arrsd) + ($masodikmenu*$menu2arrsd) + ($harmadikmenu*$menu3arrsd);
			$penznemk = 'RSD';
		}

		$mainap = new DateTime();
		$datum2 = new DateTime($datum);
		$datum2->add(new DateInterval('P1D'));
		

		if ($datum != null && $mainap < $datum2) {
			
			$szamlalo1++;

			echo "
			<div class='order'>
				<div class='order-header'>
					<div>
						<i class='p10 bi bi-tag-fill'></i>
						<span>$etteremNev</span>
					</div>
					<div>
						<i class='p10 bi bi-geo-alt-fill'></i>
						<span>$etteremTelepules</span>
					</div>
					<div>
						<i class='p10 bi bi-clock-fill'></i>
						<span>$datum $idopont</span>
					</div>
				</div>
				<i class='p10 bi bi-arrow-down-circle-fill extend-order'></i>
				<div class='order-content'>
					<div>
						<div>
							<span>Order</span>
							<span> ";

							if ($elsomenu > 0) {
								echo $menu1nev . '-----' . $elsomenu . 'x';
							}

							echo "</span>
							<span>";

							if ($masodikmenu > 0) {
								echo $menu2nev . '-----' . $masodikmenu . 'x';
							}

							echo "</span>
							<span>";

							if ($harmadikmenu > 0) {
								echo $menu3nev . '-----' . $harmadikmenu . 'x';
							}

							echo "</span>
							<span>Final amount: $vegosszeg $penznemk</span>
							<span>Payment: $fizetes</span>
							<span>Reservation ID: $foglalasazon</span>
						</div>
						<div>
							<span>Customer data</span>
							<span>Name: $nev</span>
							<span>Tel: $tel</span>
							<span>Birth date: $szuldat</span>
							<span>The number of guests: $letszam</span>
						</div>
					</div>
				</div>
			</div>
			";


		}
		
	}
	}}}

	if ($szamlalo1 == 0) {
		echo "<div class='order'>
				<div class='order-header-empty'>
					<i class='bi bi-bag-dash-fill p15'></i>
					<span>There is no active bookings... yet!</span>
				</div>
			</div>";
	}

			?>
		</div>

		<div id="history">
			<div class="content-header">
				<i class="bi bi-hourglass-split p25"></i>
				<h1 style="margin-bottom: 2rem">Reservation history</h1>
				<p style="margin: 0 10% 1rem; font-family: var(--s-font);">Below you can find the past reservations, in the cases of which meals have already happened. If there is history, clicking the little arrow will show details.</p>
			</div>
			<?php


			$nincsetterem = 0;
			$etteremID = '';
			$szamlalo2 = 0;

			$sqll = "SELECT * FROM foglalasok WHERE vendegID = $ProfilID";
		$resultt = $conn->query($sqll);
	while ($roww = $resultt->fetch_assoc()) {

		$etteremID = $roww['etteremID'];
		if ($etteremID == null) {
			$nincsetterem = 1;
		}
	


			$sql = "SELECT * FROM etterem WHERE ID = $etteremID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$etteremNev = $row['etteremnev']; 
		$etteremTelepules = $row['telepules'];
		$menuID = $row['menuID'];

	}



if ($nincsetterem != 1) {
	

	$sql = "SELECT * FROM menuk WHERE menuID = $menuID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$menu1nev = $row['menu1_nev'];
		$menu2nev = $row['menu2_nev']; 
		$menu3nev = $row['menu3_nev']; 

		$menu1arhuf = $row['menu1_arhuf']; 
		$menu2arhuf = $row['menu2_arhuf']; 
		$menu3arhuf = $row['menu3_arhuf']; 

		$menu1areur = $row['menu1_areur']; 
		$menu2areur = $row['menu2_areur']; 
		$menu3areur = $row['menu3_areur'];

		$menu1arrsd = $row['menu1_arrsd'];
		$menu2arrsd = $row['menu2_arrsd']; 
		$menu3arrsd = $row['menu3_arrsd'];  
 


	}

	

	if ($etteremID != null) {
		
			$sql = "SELECT * FROM foglalasok WHERE vendegID = $ProfilID";
		$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {

		$datum = $row['datum'];
		$idopont = $row['idopont'];
		$nev = $row['nev'];
		$tel = $row['tel'];
		$szuldat = $row['szulDatum'];
		$letszam = $row['letszam'];
		$penznem = $row['penznem'];
		$elsomenu = $row['elsomenu'];
		$masodikmenu = $row['masodikmenu'];
		$harmadikmenu = $row['harmadikmenu'];
		$idopont = $row['idopont'];
		$fizetes = $row['fizetes'];


		if ($fizetes == 'Helyszíni készpénzes fizetés') {
			$fizetes = 'Cash payment on the spot';
		}
		else if ($fizetes == 'Helyszíni bankkártyás fizetés') {
			$fizetes = 'Card payment on the spot';
		}
		else if ($fizetes == 'Online') {
			$fizetes = 'Online';
		}

		$foglalasazon = $row['foglalasID'];
		$vegosszeg = 0;
		$penznemk = '';

		if ($penznem == 'huf') { 
			$vegosszeg = ($elsomenu*$menu1arhuf) + ($masodikmenu*$menu2arhuf) + ($harmadikmenu*$menu3arhuf);
			$penznemk = 'Ft';
		}
		else if ($penznem == 'eur') {
			$vegosszeg = ($elsomenu*$menu1areur) + ($masodikmenu*$menu2areur) + ($harmadikmenu*$menu3areur);
			$penznemk = 'EUR';
		}
		else if ($penznem == 'rsd') {
			$vegosszeg = ($elsomenu*$menu1arrsd) + ($masodikmenu*$menu2arrsd) + ($harmadikmenu*$menu3arrsd);
			$penznemk = 'RSD';
		}

		$mainap = new DateTime();
		$datum2 = new DateTime($datum);
		$datum2->add(new DateInterval('P1D'));
		

		if ($datum != null && $mainap > $datum2) {
			
			$szamlalo2++;

			echo "
			<div class='order'>
				<div class='order-header'>
					<div>
						<i class='p10 bi bi-tag-fill'></i>
						<span>$etteremNev</span>
					</div>
					<div>
						<i class='p10 bi bi-geo-alt-fill'></i>
						<span>$etteremTelepules</span>
					</div>
					<div>
						<i class='p10 bi bi-clock-fill'></i>
						<span>$datum $idopont</span>
					</div>
				</div>
				<i class='p10 bi bi-arrow-down-circle-fill extend-order'></i>
				<div class='order-content'>
					<div>
						<div>
							<span>Order</span>
							<span> ";

							if ($elsomenu > 0) {
								echo $menu1nev . '-----' . $elsomenu . 'x';
							}

							echo "</span>
							<span>";

							if ($masodikmenu > 0) {
								echo $menu2nev . '-----' . $masodikmenu . 'x';
							}

							echo "</span>
							<span>";

							if ($harmadikmenu > 0) {
								echo $menu3nev . '-----' . $harmadikmenu . 'x';
							}

							echo "</span>
							<span>Final amount: $vegosszeg $penznemk</span>
							<span>Payment: $fizetes</span>
							<span>Reservation ID: $foglalasazon</span>
						</div>
						<div>
							<span>Customer data</span>
							<span>Name: $nev</span>
							<span>Tel: $tel</span>
							<span>Birth date: $szuldat</span>
							<span>The number of guests: $letszam</span>
						</div>
					</div>
				</div>
			</div>
			";


		}
		
	}
	}}}

	if ($szamlalo2 == 0) {
		echo "<div class='order'>
				<div class='order-header-empty'>
					<i class='bi bi-bag-dash-fill p15'></i>
					<span>There is no active bookings... yet!</span>
				</div>
			</div>";
	}

			?>
		</div>
	</div>

	<script type="text/javascript" defer>
		const chatButton = document.getElementById("chat-button");
		const chatMenu = document.getElementById("chat-menu");
		const chatMenuClose = document.getElementById("chat-menu-close");
		const chatMenuContent = document.getElementById("chat-menu-content");

		const phoneMenuButton = document.getElementById("phone-list-icon");
		const phoneMenu = document.getElementById("phone-menu");
		const phoneMenuClose = document.getElementById("phone-menu-close");
		const phoneChatButton = document.getElementById("phone-chat-button");

		const extendOrder = document.querySelectorAll(".extend-order");
		extendOrder.forEach((element) => {
			element.addEventListener('click', function()
			{
				element.classList.toggle("rotate");
				element.nextElementSibling.classList.toggle("extend");
			});
		});

		chatButton.addEventListener('click', () =>
		{
			if (chatMenu.classList.contains('open'))
			{
				chatMenu.classList.remove('open');
			}
			else
			{
				chatMenu.classList.add('open');
				chatMenu.scrollTop = 0;

				UpdateChat();
			}
		});
		chatMenuClose.addEventListener('click', () =>
		{
			chatMenu.classList.remove('open');
		});
		document.addEventListener('click', (event) =>
		{
			if(!chatMenu.contains(event.target) && event.target !== chatButton)
			{
				if (chatMenu.classList.contains('open'))
					chatMenu.classList.remove('open');
			}
		});
		phoneMenuButton.addEventListener('click', () =>
		{
			phoneMenu.classList.toggle('open');
		});
		phoneMenuClose.addEventListener('click', () =>
		{
			phoneMenu.classList.remove('open');
		});
		phoneChatButton.addEventListener('click', () =>
		{
			phoneMenu.classList.remove('open');
			setTimeout(() => {chatMenu.classList.add('open');}, 0);
			UpdateChat();
		});

		function UpdateChat()
		{
			let childCount = chatMenuContent.childElementCount;
			for(let i = 0; i < childCount; ++i)
			{
				if((i % 2) == 0)
					chatMenuContent.children[i].style.backgroundColor = "#d1d0cf";
				else
					chatMenuContent.children[i].style.backgroundColor = "#FFF";
			}
		}
	</script>
</body>
</html>