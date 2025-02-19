<?php
include('config.php');
include('fungsi.php');

if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $kategori = $_POST['kategori'];

    // Validasi NIP, jika kosong atau tidak valid, ganti dengan tanda strip "-"
    if (empty($nip) || strlen($nip) != 18 || !ctype_digit($nip)) {
        $nip = '-';
    }

    // Simpan ke tabel alternatif
    $query = "INSERT INTO alternatif (nama, nip, kategori) VALUES ('$nama', '$nip', '$kategori')";
    if (mysqli_query($koneksi, $query)) {
        // Redirect langsung ke halaman alternatif.php setelah data berhasil disimpan
        echo "<script>window.location.href = 'alternatif.php';</script>";
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
    }
}

include('header.php');
?>

<section class="content">
    <h2>Tambah Alternatif</h2>
    <form class="ui form" method="post" action="">
        <div class="field">
            <label>Nama</label>
            <input type="text" name="nama" placeholder="Nama Guru" required>
        </div>
        <div class="field">
            <label>NIP</label>
            <input type="text" name="nip" id="nip" placeholder="NIP" pattern="\d{18}" title="NIP harus terdiri dari 18 angka" maxlength="18" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
            <div class="ui checkbox">
                <input type="checkbox" id="no_nip" name="no_nip" onchange="handleNipOption()">
                <label for="no_nip">Tidak memiliki NIP</label>
            </div>
        </div>
        <div class="field">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="Guru Umum">Guru Umum</option>
                <option value="Guru Jurusan">Guru Jurusan</option>
            </select>
        </div>
        <br>
        <button class="ui green button" type="submit" name="tambah">SIMPAN</button>
    </form>
    <br>
    <a href="alternatif.php" class="ui button">Kembali</a>
</section>

<script>
    // JavaScript untuk menangani opsi NIP
    function handleNipOption() {
        const nipInput = document.getElementById('nip');
        const noNipCheckbox = document.getElementById('no_nip');

        if (noNipCheckbox.checked) {
            nipInput.value = '-'; // Set ke "-"
            nipInput.setAttribute('readonly', true); // Nonaktifkan input
            nipInput.removeAttribute('required'); // Hapus required
        } else {
            nipInput.value = ''; // Kosongkan input
            nipInput.removeAttribute('readonly'); // Aktifkan input
            nipInput.setAttribute('required', 'required'); // Tambahkan kembali required
        }
    }

    // JavaScript untuk membatasi input NIP hanya 18 angka
    const nipInput = document.getElementById('nip');
    nipInput.addEventListener('input', function (event) {
        // Menghapus karakter selain angka
        this.value = this.value.replace(/[^0-9]/g, '');

        // Membatasi panjang input hanya 18 karakter
        if (this.value.length > 18) {
            this.value = this.value.substring(0, 18);
        }
    });
</script>

<?php include('footer.php'); ?>
