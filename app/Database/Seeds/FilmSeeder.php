<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FilmSeeder extends Seeder
{
  public function run()
  {
    $faker = \Faker\Factory::create();
    $data = [];
    $jadwal = [];
    $bioskop = [];
    $bioskoprelations = [];

    $jadwal_film_id = [];
    for ($i = 1; $i <= 10; $i++) {
      $film_id = $faker->uuid;
      $jadwal_film_id[] = $film_id;
      $data[] = [
        'id' => $film_id,
        'title' => $faker->sentence(2),
        'description' => $faker->paragraph,
        'price' => $faker->randomFloat(0, 30000, 600000),
        'stock' => random_int(0, 99),
        'author' => $faker->name,
        'publisher' => $faker->company,
        'genre' => $faker->word,
        'cover' => 'assets/img/' . $i . '.jpg',
      ];
    }

    for ($i = 1; $i <= sizeof($jadwal_film_id); $i++) {
      for ($j = 1; $j <= 10; $j++) {
        $jadwal[] = [
          'film_id' => $jadwal_film_id[$i - 1],
          'date' => $faker->dateTimeBetween('now', '+1 years')->format('Y-m-d'),
          'time' => $faker->time(),
        ];
      }
    }

    for ($i = 1; $i <= 3; $i++) {
        $bioskop[] = [
          'nama' => $faker->sentence(2),
          'lokasi' => $faker->sentence(2),
          'fasilitas' => $faker->sentence(2),
          'image' => 'assets/img/' . $i . '.jpg',
        ];
    }


    for ($i = 1; $i <= 3; $i++) {
      for ($j = 1; $j <= 3; $j++) {
        $bioskoprelations[] = [
          'bioskop_id' => $i,
          'film_id' => $jadwal_film_id[$j + $i - 1],
        ];
      }
    }



    //
    //    $data[] = [
    //      'id' => $faker->uuid,
    //      'title' => $faker->sentence(2),
    //      'description' => $faker->paragraph,
    //      'price' => $faker->randomFloat(0, 30000, 600000),
    //      'stock' => random_int(0, 99),
    //      'author' => $faker->name,
    //      'publisher' => $faker->company,
    //      'genre' => $faker->word,
    //      'cover' => 'https://user-images.githubusercontent.com/86828535/227701782-d7dfda50-0e1f-4f26-a893-58cf2972ac08.png',
    //    ];




    $this->db->table('films')->insertBatch($data);
    $this->db->table('schedules')->insertBatch($jadwal);
    $this->db->table('bioskops')->insertBatch($bioskop);
    $this->db->table('bioskoprelations')->insertBatch($bioskoprelations);
  }
}
