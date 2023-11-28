<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Users;
use App\Models\CommentModel;
use Faker\Provider\Uuid;
class Comments extends BaseController
{
    public function index()
    {
        $model = new CommentModel();

        // Fetch all books
        $data['comments'] = $model->findAll();

        // Retrieve session data
        $session = \Config\Services::session();
        $role = $session->get('role');
        
        // Pass data to the view
        return view('welcome_message', [
            'comments' => $data['comments'],
            'role' => $role
        ]);
    }
    public function show($id)
    {
        $model = new CommentModel();

        $model_users = new Users();
        $users = $model_users->where('id', $id)->first();
        $data['comments'] = $model->select('comments.id as comments_id, comments.*,user.*')
        ->join('users', 'users.id = comments.user_id')
        ->where('comments.user_id', $id)->findAll();

        return view('comments/', $data);
    }
    public function create()
    {
        $model = new CommentModel(); 
        $data = [
            'user_id' => $this->request->getVar('user_id'),
            'comment' => $this->request->getVar('comment'),
        ];
        $model->insert($data);
        return redirect()->route('home.index');
    }
}
