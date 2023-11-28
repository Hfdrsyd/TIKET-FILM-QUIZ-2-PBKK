<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Schedules;
use App\Models\Films;
use CodeIgniter\API\ResponseTrait;

class SchedulesController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        
    }


    public function show($id)
    {
        $model_schedule = new Schedules();
        $model_film = new Films();

        $schedules = $model_schedule->where('film_id', $id)->findAll();

        $film = $model_film->find($id);

        if ($film) {
            // Retrieve session data
            $session = \Config\Services::session();
            $role = $session->get('role');       

            return view('schedule/detail', [
                'film' => $film,
                'schedules' => $schedules,
                'role' => $role
            ]);
        } else {
            return redirect()->route('home.index')->with('error', 'ID Film invalid.');
        }
    }

    public function create()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if($role !== 'admin'){
            return redirect()->route('home.index');
        }

        $model = new Schedules();
        $data = [
            'film_id' => $this->request->getVar('film_id'),
            'date' => $this->request->getVar('date'),
            'time' => $this->request->getVar('time')
        ];

        $same_date = $model->where('film_id', $data['film_id'])
                            ->where('date', $data['date'])
                            ->first();
        if($same_date){
            $same_time = $model->where('film_id', $data['film_id'])
                                ->where('time', $data['time'])
                                ->first();
            if($same_time){
                $model = new Films();
                $film = $model->find($data['film_id']);

                return view('film/schedule', [
                    'film' => $film,
                    'role' => $role,
                    'error' => 'Jadwal sudah ada.'
                ]);
            }
        }

        $model->insert($data);

        return redirect()->route('home.index');
    }

    public function update($id)
    {
        $model = new Schedules();
        $data = [
            'film_id' => $this->request->getVar('film_id'),
            'date' => $this->request->getVar('date'),
            'time' => $this->request->getVar('time')
        ];

        $model->update($id, $data);

        // $response = [
        //     'status'   => 200,
        //     'error'    => null,
        //     'messages' => 'Data Updated',
        //     'data' => $data
        // ];

        // return $this->respond($response);
    }

    public function delete($id)
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if($role !== 'admin'){
            return redirect()->route('home.index');
        }
        $model = new Schedules();
        $data = $model->find($id);

        if ($data) {
            $model->delete($id);
            return redirect()->route('home.index')->with('success', 'record Jadwal berhasil dihapus');
        } else {
            return redirect()->route('home.index')->with('error', 'record Jadwal tidak ditemukan');
        }
    }

    public function add($id)
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if($role !== 'admin'){
            return redirect()->route('home.index');
        }

        $model = new Films();
        $film = $model->find($id);

        if ($film) {
            return view('film/schedule', [
                'film' => $film,
                'role' => $role,
                'error' => null
            ]);
        } else {
            return redirect()->route('home.index')->with('error', 'record Jadwal tidak ditemukan');
        }
    }

}
