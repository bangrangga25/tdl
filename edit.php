<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = $conn->query("SELECT * FROM tasks WHERE id=$id")->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_tugas'];
    $prioritas = $_POST['prioritas'];
    $tanggal = $_POST['tanggal'];

    $conn->query("UPDATE tasks SET nama_tugas='$nama', prioritas='$prioritas', tanggal='$tanggal' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 text-white px-6 py-4">
                <h2 class="text-2xl font-bold">Edit Tugas</h2>
            </div>

            <!-- Edit Task Form -->
            <div class="p-6">
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tugas</label>
                        <input type="text" name="nama_tugas" value="<?= $task['nama_tugas'] ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                        <select name="prioritas" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="Tinggi" <?= $task['prioritas'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                            <option value="Sedang" <?= $task['prioritas'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                            <option value="Rendah" <?= $task['prioritas'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="<?= $task['tanggal'] ?>" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit" name="submit"
                            class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
                <br>
                <a href="index.php" class="text-blue-600 hover:underline">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>