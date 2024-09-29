<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Myth\Auth\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Admin';
        //$users = new UserModel();
        //$data['users'] = $users->findAll();

        $db = db_connect();
        //$builder = $db->table('users');
        //$builder->select('users.id as userid, username, email, name as role');
        //$builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        //$builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        //$query = $builder->get();

        // Define the subquery using the Query Builder
        $subquery = $db->table('users')
            ->select('users.id as userid, username, email, auth_groups.name as role, 
              ROW_NUMBER() OVER (PARTITION BY users.id ORDER BY auth_groups.name) as rn', false)
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->getCompiledSelect();

        // Now, use the subquery as a CTE in the main query
        $query = $db->table("($subquery) as UserRoles")
            ->select('userid, username, email, role')
            ->where('rn', 1)
            ->get();

        $data['users'] = $query->getResult();
        return view('admin/index', $data);
    }
}
