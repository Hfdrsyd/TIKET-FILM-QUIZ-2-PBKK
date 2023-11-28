<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Daftar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main class="h-screen grid place-items-center">
    <div class="bg-white p-6 xs:p-8 md:p-10 rounded-3xl md:shadow-2xl space-y-6 w-full max-w-[26rem] mx-auto">
      <div class='space-y-1'>
        <h2 class='text-2xl font-bold'>Masukkan film</h2>
        <p class='text-black/70'>Untuk mendapatkan akun Filmku</p>
      </div>
      <form action="<?= route_to('film.create') ?>" method="POST" class="space-y-2.5" enctype="multipart/form-data">
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php } ?>
        <input required type="text" id="title" name="title" placeholder="Film Title" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <input required type="text" id="description" name="description" placeholder="Film Description" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <input required type="number" id="price" name="price" placeholder="Price" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <input required type="text" id="author" name="author" placeholder="director" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <input required type="text" id="publisher" name="publisher" placeholder="studio" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
          <input required type="text" id="stock" name="stock" placeholder="stock" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
          <input required type="text" id="genre" name="genre" placeholder="Genre" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <input required type="file" id="cover" name="cover" accept="image/*" class="w-full min-h-[2.25rem] md:min-h-[2.5rem] rounded-lg shadow-sm px-3.5 border border-gray-300 focus:outline-none">
        <button type="submit" class="btn btn-primary bg-primary w-full !mt-6">Create Film Session</button>
    </form>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>