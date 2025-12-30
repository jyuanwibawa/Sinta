<?php
class Model_project extends CI_Model
{
    /*
        Get all the records from the database
    */
    public function get_all()
    {
        $projects = $this->db->select('*')
            ->order_by('created_at DESC')
            ->get('projects')->result();
        return $projects;
    }

    /*
        Store the record in the database
    */
    public function store()
    {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'shm' => $this->input->post('shm')
        ];

        $result = $this->db->insert('projects', $data);
        return $result;
    }

    /*
        Get an specific record from the database
    */
    public function get($id)
    {
        $project = $this->db->get_where('projects', ['id' => $id])->row();
        return $project;
    }


    /*
        Update or Modify a record in the database
    */
    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
        ];

        $result = $this->db->where('id', $id)->update('projects', $data);
        return $result;
    }

    /*
        Destroy or Remove a record in the database
    */
    public function delete($id)
    {
        $result = $this->db->delete('projects', array('id' => $id));
        return $result;
    }
}
