<?php  

	include "../fungsi/koneksi.php";

	$id = $_POST['jenis'];

	$query = mysqli_query($koneksi,"SELECT stokbarang.kode_brg, stokbarang.nama_brg, stokbarang.stok FROM stokbarang JOIN jenis_barang ON stokbarang.id_jenis=jenis_barang.id_jenis WHERE stokbarang.id_jenis='$id'");
    
    if (mysqli_num_rows($query)) {
    	echo "<option>--Pilih Barang--</option>";
        while($row=mysqli_fetch_assoc($query)){

        	echo "<option value=$row[kode_brg]>$row[nama_brg]</option>\n";

    	}                                                    
    }
  
?>