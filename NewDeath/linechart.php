<?php
include('koneksi.php');
$produk = mysqli_query($conn,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['country'];
	
	$query = mysqli_query($conn,"SELECT sum(new_mati) as jumlah FROM tb_covid WHERE id ='".$row['id']."'");
	$jumlah_produk[] = $row['new_mati'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="chart.js"></script>
</head>
<center><body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik Covid Negara',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderColor: 'rgb(75, 192, 192)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
	</center>
</body>
</html>