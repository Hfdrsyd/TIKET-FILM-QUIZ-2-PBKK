<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bioskops;
use App\Models\BioskopRelations;
use App\Models\Films;

class BioskopController extends BaseController
{
    // public function index()
    // {
    //     $model = new Bioskops();
    //     $data = $model->findAll();
    //     $session = \Config\Services::session();
    //     $role = $session->get('role');
    //     return view('welcome_message',[
    //         'bioskops'=> $data,
    //         'role' => $role,
    //     ]);
    // }
    public function show($id){
        $modelBioskop = new Bioskops();
        $modelBioskopR = new BioskopRelations();
        $modelFilm = new Films();
        $films = $modelFilm
        ->select('bioskops.id as bioskops_id, films.id as films_id,bioskops.*, films.*')
        ->join('bioskoprelations', 'bioskoprelations.film_id = films.id')
        ->join('bioskops', 'bioskops.id = bioskoprelations.bioskop_id')
        ->where('bioskops.id', $id)
        ->findAll();
        $bioskop = $modelBioskop->find($id);
        if ($bioskop) {
            $session = \Config\Services::session();
            $role = $session->get('role');
            return view('bioskop/detail', [
                'films' => $films,
                'role' => $role
            ]);
        }
        else {
            return redirect()->route('home.index')->with('error', 'Bioskop not found');
        }
    }
}
