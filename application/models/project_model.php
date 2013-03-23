<?php
class Project_model extends CI_Model {

    public $id = false;
    public $table = 'projects';
    public $primary_key = 'id';

    public function __construct($id = false)
    {
        parent::__construct();
        $this->id = $id;
        unset($id);

    }

    public function save($data,$condition = false){

        $id = $this->id;

        if($id){
            $conditions = array($this->primary_key=>$id);
            if($this->db->update($this->table,$data,$conditions))
            return true;
        }

        if($condition){
            $conditions = $condition;
            if($this->db->update($this->table,$data,$conditions))
            return true;
        }

        if($this->db->insert($this->table,$data))
            return true;

    }

    public function saveField($name, $value) {
        return $this->save(array($name => $value));
    }

    public function findAll(){
        $query = $this->db->from($this->table)->get();

        if($query->num_rows()>0)
            return $query->result();
        else
            return false;
    }

    public function find($field = null ){
        $id = $this->id;
        $query = $this->db->from($this->table)
                    ->where($this->primary_key,$id)
                    ->get();
        if($query->num_rows()>0)
            return $query->row();
        else
            return false;
    }

    public function get($field){
        $id = $this->id;
        if($field)
            $this->db->select($field);

        $query = $this->db->from($this->table)
            ->where($this->primary_key,$id)
            ->get();
        if($query->num_rows()>0)
            return $query->row()->$field;
        else
            return false;
    }

    public function getList($conditions = false){
        if($conditions){
            $this->db->where($conditions);
        }

        $query = $this->db->from($this->table)->get();

        if($query->num_rows()>0)
        {
            $projects =  $query->result();
            return $projects;
        }
        else
            return false;

    }

    public function deleteProject($id = null){
        if($id){
            $this->db->where(array($this->primary_key=>$id));
            if($this->db->delete($this->table))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function getProjectKeywords($id = null)
    {

        $id = $this->id;
        $query = $this->db->from('project_keywords')
            ->where(array('project_id'=>$id))
            ->get();
        if($query->num_rows()>0)
        {
            return $query->result();
        }

    }

    public function saveKeyword($data){
        $project_id = $this->id;
        $data['project_id'] = $project_id;
        if($this->db->insert('project_keywords',$data))
            return $this->lastInsertId();
        else
            return false;

    }
    public function getProjectServices($id = null)
    {

        $id = $this->id;
        $query = $this->db->from('project_services')
            ->where(array('project_id'=>$id))
            ->get();
        if($query->num_rows()>0)
        {
            return $query->result();
        }

    }
    public function saveService($data){
        $project_id = $this->id;
        $data['project_id'] = $project_id;
        if($this->db->insert('project_services',$data))
            return $this->lastInsertId();
        else
            return false;

    }

    public function insertAdditional($data){
        $project_id = $this->id;
        $data['project_id'] = $project_id;
        if($this->db->insert('meta',$data))
            return $this->lastInsertId();
        else
            return false;

    }

    public function updateAdditional($data,$key){
        $project_id = $this->id;
        if($this->db->update('meta',$data,array('key'=>$key,'project_id'=>$project_id)))
            return true;
        else
            return false;
    }

    public function checkExistingAdditional($data){
        $project_id = $this->id;
        $key = $data['key'];
        $result = $this->db->from('meta')
            ->where(array('project_id'=>$project_id,'key'=>$key))
            ->get();
        if($result->num_rows()>0)
            return true;
        else
            return false;
    }

    public function getAdditionalData(){
        $id = $this->id;
        $query = $this->db->from('meta')
            ->where(array('project_id'=>$id))
            ->get();
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }

    public function deleteAdditional($id){
        if($id){
            $this->db->where(array('id'=>$id));
            if($this->db->delete('meta'))
                return true;
            else
                return false;
        }
        else
            return false;
    }
    public function deleteService($id){
        if($id){
            $this->db->where(array('id'=>$id));
            if($this->db->delete('project_services'))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function deleteKeyword($id){
        if($id){
            $this->db->where(array('id'=>$id));
            if($this->db->delete('project_keywords'))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function terminateProject($id){
        if($id){
            $this->db->where(array('id'=>$id));
            if($this->db->update($this->table,(array('terminate'=>1))))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    public function lastInsertId(){
        return $this->db->insert_id();
    }

    public function getMeta($key){
        $project_id = $this->id;
        $query = $this->db->from('meta')
            ->where(array('project_id'=>$project_id,'key'=>$key))
            ->get();
        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
            return false;

    }



}
?>