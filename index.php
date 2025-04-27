<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM tasks ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html>

<head>
  <title>To-Do List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg">
      <!-- Header -->
      <div class="bg-blue-600 text-white px-6 py-4 text-center">
        <h2 class="text-2xl font-bold">Daftar Tugas</h2>
      </div>

      <!-- Add Task Form -->
      <div class="p-6 border-b">
        <form action="tambah.php" method="POST" class="space-y-4 md:flex md:items-end md:space-x-4">
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700">Nama Tugas</label>
            <input type="text" name="nama_tugas" placeholder="Masukkan nama tugas" required
              class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700">Prioritas</label>
            <select name="prioritas" required
              class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
              <option value="" disabled selected>Pilih Prioritas</option>
              <option value="Tinggi">Tinggi</option>
              <option value="Sedang">Sedang</option>
              <option value="Rendah">Rendah</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" required
              class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
          </div>
          <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
            Tambah
          </button>
        </form>
      </div>

      <!-- Task List -->
      <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Tugas</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prioritas</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php $no = 1;
            while ($row = $result->fetch_assoc()): ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-500"><?= $no++ ?></td>
                <td class="px-6 py-4 text-sm <?= $row['status'] == 'selesai' ? 'line-through text-gray-400' : 'text-gray-900' ?>">
                  <?= $row['nama_tugas'] ?>
                </td>
                <td class="px-6 py-4 text-sm">
                  <span class="px-2 inline-flex text-xs font-semibold rounded-full <?= strtolower($row['prioritas']) == 'tinggi' ? 'bg-red-100 text-red-800' : (strtolower($row['prioritas']) == 'sedang' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') ?>">
                    <?= $row['prioritas'] ?>
                  </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= $row['tanggal'] ?></td>
                <td class="px-6 py-4 text-sm">
                  <span class="px-2 inline-flex text-xs font-semibold rounded-full <?= $row['status'] == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                    <?= $row['status'] ?>
                  </span>
                </td>
                <td class="px-6 py-4 text-sm space-x-2">
                  <a href="edit.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                  <a href="selesai.php?id=<?= $row['id'] ?>" class="text-green-600 hover:text-green-900">Selesai</a>
                  <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus tugas ini?')" class="text-red-600 hover:text-red-900">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>

            <?php if ($result->num_rows === 0): ?>
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada tugas. Silakan tambahkan tugas baru.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>