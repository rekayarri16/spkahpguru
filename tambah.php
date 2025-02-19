<?php
	include('config.php');
	include('fungsi.php');

	// mendapatkan data edit
	if(isset($_GET['jenis'])) {
		$jenis	= $_GET['jenis'];
	}

	if (isset($_POST['tambah'])) {
		$jenis	= $_POST['jenis'];
		$nama 	= $_POST['nama'];

		// Panggil fungsi untuk menambah data
		tambahData($jenis,$nama);

		// Redirect langsung ke halaman kriteria.php tanpa perlu klik OK
		echo "<script>window.location.href = 'kriteria.php';</script>";
		exit();
	}

	include('header.php');
?>

<section class="content">
	<h2>Tambah <?php echo htmlspecialchars($jenis); ?></h2>

	<form class="ui form" method="post" action="tambah.php">
		<div class="inline field">
			<label>Nama <?php echo htmlspecialchars($jenis); ?></label>
			<input type="text" name="nama" placeholder="<?php echo htmlspecialchars($jenis); ?> baru" required>
			<input type="hidden" name="jenis" value="<?php echo htmlspecialchars($jenis); ?>">
		</div>
		<br>
		<input class="ui green button" type="submit" name="tambah" value="SIMPAN">
	</form>
	<br>
	<a href="kriteria.php" class="ui button">Kembali</a>
</section>

<?php include('footer.php'); ?>
