<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Films;
use App\Models\Schedules;
use CodeIgniter\API\ResponseTrait;
use App\Models\Transactions;
use App\Models\Users;
use Faker\Provider\Uuid;

class TransactionsController extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) return view('auth/login');

    $userId = $session->get('id');
    $model = new Transactions();
    $data['transactions'] = $model->select('transactions.id as transaction_id, transactions.*, films.*, schedules.*')
    ->join('films', 'films.id = transactions.film_id')
    ->join('schedules', 'schedules.id = transactions.jadwal_id')
    ->where('transactions.user_id', $userId)->findAll();

    return view('transaction/history', $data);
  }

  public function show($id)
  {
    $transaction = new Transactions();
    $data['transaction'] = $transaction->where('id', $id)->first();

    $film = new Films();
    $data['film'] = $film->where('id', $data['transaction']['film_id'])->first();

    $schedule = new Schedules();
    $data['schedule'] = $schedule->where('id', $data['transaction']['jadwal_id'])->first();

    return view('transaction/detail', $data);
  }

  public function prepare()
  {
    $transaction = [

      'user_id' => $this->request->getVar('user_id'),
      'film_id' => $this->request->getVar('film_id'),
      'jadwal_id' => $this->request->getVar('jadwal_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
    ];

    $user = new Users();
    if (!$user->find($transaction['user_id'])) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $film = new Films();
    if (!$film->find($transaction['film_id'])) {
      return redirect()->back()->with('error', 'ID Film tidak valid');
    }

    $schedule = new Schedules();
    if (!$schedule->find($transaction['jadwal_id'])) {
      return redirect()->back()->with('error', 'ID Jadwal tidak valid');
    }

    $data['transaction'] = $transaction;
    $data['film'] = $film->where('id', $transaction['film_id'])->first();
    $data['schedule'] = $schedule->where('id', $transaction['jadwal_id'])->first();
    $data['address'] = $user->where('id', $transaction['user_id'])->first()['address'];

    return view('transaction/confirm', $data);
  }

  public function payment() {
    $data = [
      'id' => Uuid::uuid(),
      'user_id' => $this->request->getVar('user_id'),
      'film_id' => $this->request->getVar('film_id'),
      'jadwal_id' => $this->request->getVar('jadwal_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
      'address' => $this->request->getVar('address'),
      'payment_method' => $this->request->getVar('payment_method'),
    ];

    $trans = new Transactions();
    $trans->insert($data);

    $film = new Films();
    $curStock = $film->where('id', $data['film_id'])->first()['stock'];
    $film->update($data['film_id'], ['stock' => $curStock - $data['count']]);

    return redirect()->route('transaction.history');
  }

  public function update($id)
  {
    $model = new Transactions();
    $data = [
      'user_id' => $this->request->getVar('user_id'),
      'film_id' => $this->request->getVar('film_id'),
      'total_price' => $this->request->getVar('total_price'),
      'count' => $this->request->getVar('count'),
    ];

    $user = new Users();
    if (!$user->find($data['user_id'])) {
      return redirect()->back()->with('error', 'ID Pengguna tidak valid');
    }

    $film = new Films();
    if (!$film->find($data['film_id'])) {
      return redirect()->back()->with('error', 'ID Film tidak valid');
    }

    $model->update($id, $data);
  }

  public function delete($id)
  {
    $model = new Transactions();
    $data = $model->find($id);

    if ($data) {
      $model->delete($id);
    } else {
      return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }
  }
}
