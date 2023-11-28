<?php
$session = \Config\Services::session();

if (!$session->has('username') || !$session->has('role') || !$session->has('id')) {
  header('Location: ' . route_to('home.login'));
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film Detail Page</title>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body>
  <?php echo view('layouts/navbar') ?>
  <main class="min-h-screen w-10/12 mx-auto py-32">
    <div class="flex items-center gap-2.5">
      <a href="/" class="text-slate-400">Home</a>
      <p class="text-slate-400">/</p>
      <a href="/" class="text-slate-400">Film</a>
      <p class="text-slate-600">/</p>
      <p class="text-slate-600"><?= $film['title'] ?></p>
    </div>
    <section class="mt-6 flex flex-col lg:flex-row gap-12">
      <div>
        <div class="p-3.5 bg-white rounded shadow w-fit">
          <img src="<?= base_url($film['cover']) ?>" alt="">
        </div>
      </div>
      <div class="space-y-7 lg:w-1/2">
        <div>
          <p class="text-slate-400"><?= $film['author'] ?></p>
          <p class="text-3xl font-medium"><?= $film['title'] ?></p>
        </div>
          <div class="">
              <div class="flex items-center gap-10">
                  <p class="font-medium pb-2.5 text-slate-300 cursor-pointer hover:text-gray-800" onclick="showContent('detail')">Detail film</p>
                  <p class="font-medium pb-2.5 text-slate-300 cursor-pointer hover:text-gray-800" onclick="showContent('format')">Harga tiket</p>
                  <p class="font-medium pb-2.5 text-slate-300 cursor-pointer hover:text-gray-800" onclick="showContent('deskripsi')">Deskripsi film</p>
                  <p class="font-medium pb-2.5 text-slate-300 cursor-pointer hover:text-gray-800" onclick="showContent('rating')">Rating film</p>
              </div>
              <div class="h-px w-full bg-slate-200"></div>
          </div>
          <div id="formatContent" class="content hidden">
              <div>
                  <p class="text-[17px] font-medium">Harga</p>
                  <div class="mt-2">
                      <div class="bg-slate-100 max-w-[14rem] rounded-lg px-3.5 py-2.5">
                          <p class="text-sm text-slate-400">Harga per-tiket</p>
                          <p class="text-sky-700">Rp <?= number_format($film['price']) ?></p>
                      </div>
                  </div>
              </div>
          </div>
          <div id="deskripsiContent" class="content">
              <div class="space-y-1.5">
                  <p class="font-medium text-[17px]">Deskripsi film</p>
                  <p class="text-[15px] text-slate-600"><?= $film['description'] ?></p>
              </div>
          </div>

          <div id="detailContent" class="content hidden">
              <div>
                  <p class="text-[17px] font-medium">Harga</p>
                  <div class="mt-2">
                      <div class="bg-slate-100 max-w-[14rem] rounded-lg px-3.5 py-2.5">
                          <p class="text-sm text-slate-400">Harga per-tiket</p>
                          <p class="text-sky-700">Rp <?= number_format($film['price']) ?></p>
                      </div>
                  </div>
              </div>
              <div class="space-y-1.5">
                  <p class="font-medium text-[17px]">Deskripsi film</p>
                  <p class="text-[15px] text-slate-600"><?= $film['description'] ?></p>
              </div>
              <div class="space-y-1.5">
                  <p class="font-medium text-[17px]">Rating</p>
                  <div class="rating-container">
                      <span class="rating-star" onclick="rateFilm(1)">★</span>
                      <span class="rating-star" onclick="rateFilm(2)">★</span>
                      <span class="rating-star" onclick="rateFilm(3)">★</span>
                      <span class="rating-star" onclick="rateFilm(4)">★</span>
                      <span class="rating-star" onclick="rateFilm(5)">★</span>
                  </div>
              </div>
          </div>

          <div id="ratingContent" class="content hidden">
              <div class="space-y-1.5">
                  <div class="rating-container">
                      <span class="rating-star" onclick="rateFilm(1)">★</span>
                      <span class="rating-star" onclick="rateFilm(2)">★</span>
                      <span class="rating-star" onclick="rateFilm(3)">★</span>
                      <span class="rating-star" onclick="rateFilm(4)">★</span>
                      <span class="rating-star" onclick="rateFilm(5)">★</span>
                  </div>
              </div>
          </div>

          <?php if ($role === 'admin') { ?>
          <form action="<?= base_url('film/delete/' . $film['id']) ?>" method="POST">
              <?= csrf_field() ?>
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn btn-outline-danger" style="margin-top: 20px;">Delete</button>
          </form>
          <form action="<?= base_url('schedule/add/' . $film['id']) ?>" method="POST">
              <button type="submit" class="btn btn-outline-danger" style="margin-top: 20px;">Tambah Jadwal Tayang</button>
          </form>
          <?php } ?>

      </div>
      <div class="bg-white rounded-lg shadow p-6 grow h-fit space-y-2.5 min-w-[15rem]">
        <p class="font-medium">Ingin beli berapa?</p>
        <p class="text-sm">Jumlah Tiket :</p>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-6">
            <button id="decrement-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-6 h-6 flex items-center justify-center">
              -
            </button>
            <p id="quantity-display">1</p>
            <button id="increment-btn" type="button" class="p-1.5 rounded-sm bg-white shadow-sm w-6 h-6 flex items-center justify-center">
              ﹢
            </button>
          </div>
          <p id="ticket-stock" class="text-slate-400 text-sm">Stok : <?= $film['stock'] - 1 ?></p>
        </div>
        <div class="h-px w-full bg-slate-200"></div>
        <div class="flex items-center justify-between text-sm">
          <input type="hidden">
          <p class="">Subtotal</p>
          <p id='subtotal-price'>Rp <?= number_format($film['price']) ?></p>
        </div>
        <br><p class="font-medium">Mau Duduk Dimana?</p>
        <form id="form1">
          <input required type="number" id="seat_input" class="seat_input" placeholder="Seat Number" oninput="updateHiddenInput()">
        </form>
        <br><p class="font-medium">Mau Nonton Kapan?</p>
        <p class="text-sm">Jadwal Tayang :</p>
        <?php if (!empty($schedules)) : ?>
          <div class="schedule-list">
            <?php foreach ($schedules as $schedule) : ?>
              <div class="schedule-item text-xs" data-schedule-id="<?= $schedule['id'] ?>" onclick="selectSchedule(<?= $schedule['id'] ?>)">
                <!-- Display schedule details -->
                <?= $schedule['date'] ?> // <?= $schedule['time'] ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
            <p class="text-sm">Film Ini Sedang Tidak Tayang</p>
        <?php endif; ?>
        <!-- <button class="rounded-lg bg-white text-sky-700 border-[1.5px] border-sky-600 w-full min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm mt-3">Tambah Keranjang</button> -->
        <form action="<?= route_to('transaction.prepare') ?>" method="POST">
          <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger">
              <?= session()->getFlashdata('error') ?>
            </div>
          <?php } ?>
          <input type="hidden" id="film_id" name="film_id" value=<?= $film['id'] ?>>
          <input type="hidden" id="user_id" name="user_id" value=<?= session()->get('id') ?>>
          <input type="hidden" id="count" name="count" value=<?= 1 ?>>
          <input type="hidden" step=".01" id="total_price" name="total_price" value=<?= $film['price'] ?>>
          <input type="hidden" id="jadwal_id" name="jadwal_id" value="">
          <input type="hidden" id="seat" name="seat" value="">
          <button type="submit" class="rounded-lg bg-sky-700/90 hover:bg-sky-700 text-white w-full min-h-[2.25rem] md:min-h-[2.5rem] flex items-center justify-center text-sm mt-4">Beli Sekarang</button>
        </form>
      </div>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
      function rateFilm(rating) {
          // You can handle the rating here, for example, send it to the server or update the UI.
          console.log('User rated the film:', rating);

          // Update UI to reflect the selected rating
          for (let i = 1; i <= 5; i++) {
              const starElement = document.getElementById('star' + i);
              if (i <= rating) {
                  starElement.style.color = '#ff9800'; // Set selected color
              } else {
                  starElement.style.color = '#ffc107'; // Set unselected color
              }
          }
      }

      function showContent(contentId) {
          // Hide all content elements
          var contentElements = document.querySelectorAll('.content');
          contentElements.forEach(function(element) {
              element.classList.add('hidden');
          });

          // Show the selected content element
          var selectedContent = document.getElementById(contentId + 'Content');
          selectedContent.classList.remove('hidden');
      }
    $(document).ready(function() {
      var quantity = 1; // Initial quantity
      var stock = <?= $film['stock'] ?>

      // Function to update the quantity display
      function updateQuantity() {
        $('#quantity-display').text(quantity);
        $('#count').val(quantity)
        $('#ticket-stock').text("Stok : " + (stock - quantity))
      }

      function updatePrice() {
        var subtotal = quantity * <?= $film['price'] ?>;
        $('#subtotal-price').text('Rp ' + subtotal);
        $('#total_price').val(subtotal);
      }

      // Event listener for the decrement button
      $('#decrement-btn').click(function() {
        if (quantity > 1) {
          quantity--;
          updateQuantity();
          updatePrice();
        }
      });

      // Event listener for the increment button
      $('#increment-btn').click(function() {
        if (quantity < stock) {
          quantity++;
          updateQuantity();
          updatePrice();
        }
      });
    });
  </script>
  <script>
    function selectSchedule(scheduleId) {
      const scheduleItems = document.querySelectorAll('.schedule-item');
      scheduleItems.forEach(item => {
        item.classList.remove('selected');
      });

      const selectedSchedule = document.querySelector(`.schedule-item[data-schedule-id='${scheduleId}']`);
      selectedSchedule.classList.add('selected');

      document.getElementById('jadwal_id').value = scheduleId;
    }
  </script>
  <script>
    function updateHiddenInput() {
      var inputValue = document.getElementById('seat_input').value;

      document.getElementById('seat').value = inputValue;
    }
  </script>

  <style>
    .schedule-list {
      max-height: 200px; /* Adjust the height as needed */
      overflow-y: auto;
    }

    .schedule-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .schedule-item.selected {
        border-color: #007bff;
        background-color: #cce5ff;
    }
  </style>
</body>

</html>