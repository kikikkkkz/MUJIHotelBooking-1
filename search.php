<?php
require_once('initialize.php');
include('header.php');

//unset the last session of the checkin and checkout date
// if (isset($_SESSION['check_in'])) {
// 	unset($_SESSION['check_in']);
// }
// if (isset($_SESSION['check_out'])) {
// 	unset($_SESSION['check_out']);
// }


if(is_post_request()) {
	if(isset($_POST['checkIn'])) $checkIn = $_POST['checkIn'];
	if(isset($_POST['checkOut'])) $checkOut = $_POST['checkOut'];

	//save to session
	$_SESSION['check_in'] = $checkIn;
	$_SESSION['check_out'] = $checkOut;

	
	echo "Check In | $checkIn<br />"; 
	echo "Check Out | $checkOut";
}


?>

<!DOCTYPE html>

<html>
<head>
	<title>Booking Reservation</title>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">

	<script>
		$(document).ready(function () {
			var minDate = new Date();
			$("#checkIn").datepicker( {
				showAnim: 'fadeIn',
				numberOfMonth: 1,
				// setting today as minDate
				minDate: minDate,  
				dateFormat: 'yy-mm-dd',
				onClose: function(selectedDate) {
					$("#checkOut").datepicker("option", "minDate", selectedDate)
				}
			})

			$("#checkOut").datepicker( {
				showAnim: 'fadeIn',
				numberOfMonth: 1,
				// setting today as minDate
				minDate: minDate,  
				dateFormat: 'yy-mm-dd',
				onClose: function(selectedDate) {
					$("#checkIn").datepicker("option", "maxDate", selectedDate)
				}
			})

		})
	</script>
</head>

<body>

	<br /><h1>Start your booking</h1>
	<form action="searchresult.php" method="post">
		<table>
		<tr><th>Check In </th>
		<th>Check Out </th></tr>
		
		<tr>
			<td><input type="text" name="checkIn" id="checkIn" placeholder="When to arrive" value="<?php if(isset($_POST['checkIn'])) echo $_POST['checkIn'] ?>"> </td>
			<td><input type="text" name="checkOut" id="checkOut" placeholder="When to leave" value="<?php if(isset($_POST['checkOut'])) echo $_POST['checkOut'] ?>"> </td>
			<td><input type="submit" id="search" value="Search"></td>
		</tr>
		
		</table>
	</form>
</body>

</html>

<?php
include('footer.php');
?>