<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'parents';
    protected $primaryKey       = 'parent_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['parent_name'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_members()
    {
        $this->select('*');
        $this->from('parents as p');
        $this->join('members as m','m.parent_id = p.parent_id');
        $this->groupBy('m.member_id');
        return $this->findAll();
    }
}
