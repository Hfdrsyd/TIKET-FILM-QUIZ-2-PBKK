<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Films;
use App\Models\Users;
use App\Models\Bioskops;
use App\Models\CommentModel;
use App\Models\Schedules;
use Faker\Provider\Uuid;

class FilmsController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Films();

        // Fetch all books
        $data = $model->findAll();

        // Retrieve session data
        $session = \Config\Services::session();
        $role = $session->get('role');

        $model_comments = new CommentModel();
        $user_id = $session->get('id');
        $comments = $model_comments->select('comments.id as comments_id, comments.*, users.*')
        ->join('users', 'users.id = comments.user_id')->findAll();
        $model = new Bioskops();
        $bioskop = $model->findAll();
        // Pass data to the view
        return view('welcome_message', [
            'films' => $data,
            'role' => $role,
            'comments' => $comments,
            'user_id' => $user_id,
            'bioskops' => $bioskop
        ]);
    }


    public function show($id)
    {
        $model = new Films();

        $model_schedules = new Schedules();
        $schedules = $model_schedules->where('film_id', $id)->findAll();

        $film = $model->find($id);

        if ($film) {
            // Retrieve session data
            $session = \Config\Services::session();
            $role = $session->get('role');
            
            

            return view('film/detail', [
                'film' => $film,
                'schedules' => $schedules,
                'role' => $role
            ]);
        } else {
            return redirect()->route('home.index')->with('error', 'Film not found.');
        }
    }


    public function create()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if($role !== 'admin'){
            return redirect()->route('home.index');
        }

        $model = new Films();

        $cover = $this->request->getFile('cover'); 

        if ($cover->isValid() && !$cover->hasMoved()) {
            $newCoverName = $cover->getRandomName(); 
            $cover->move('assets/img', $newCoverName);

            $data = [
                'id' => Uuid::uuid(),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'stock' => $this->request->getVar('stock'),
                'author' => $this->request->getVar('author'),
                'publisher' => $this->request->getVar('publisher'),
                'genre' => $this->request->getVar('genre'),
                'cover' => 'assets/img/' . $newCoverName, // Store the file path in the database
            ];

            $model->insert($data);

            $film = $model->find($data['id']);

            return view('film/schedule', [
                'film' => $film,
                'role' => $role,
                'error' => null
            ]);
        } else {
            // Handle file upload error
            return redirect()->back()->with('error', 'Failed to upload the cover image.');
        }
    }
    public function update($id)
    {
        $model = new Films();
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'genre' => $this->request->getVar('genre'),
            'cover' => $this->request->getVar('cover'),
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
        $model = new Films();
        $data = $model->find($id);

        if ($data) {
            $model->delete($id);
            return redirect()->route('home.index')->with('success', 'Film berhasil dihapus');
        } else {
            return redirect()->route('home.index')->with('error', 'Film tidak ditemukan');
        }
    }

}
