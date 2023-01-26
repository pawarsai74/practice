<?php

namespace App\Controllers;

use App\Models\MembersModel;
use App\Models\ParentsModel;

class Home extends BaseController
{
    public function index()
    {
        $parents = new ParentsModel();

        $data['parents'] = $parents->findAll();

        return view('members', $data);
    }

    public function add_member()
    {
        $name = $this->request->getPost('m_name');
        $parent_id = $this->request->getPost('parent');

        $data =[
            'name' => $name,
            'parent_id' => $parent_id
        ];

        $members = new MembersModel();
        $members->insert($data);

        $response = ['success' => 'true'];
        return $this->response->setJSON($response);
    }

    public function get_data()
    {
        $parents = new ParentsModel();
        $members = new MembersModel();
//changes here
        $data = $parents->get_members();
        return $this->response->setJSON($data);
    }
}
