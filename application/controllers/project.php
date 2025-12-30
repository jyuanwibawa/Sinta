<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_project', 'project');
    }

    /*
       Display all records in page
    */
    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $data = [
            'all' => $this->project->get_all(),
            'title' => 'Project',
            'page' => 'data/regis_data',
        ];
        $this->load->view('index', $data);
    }

    /*
   
      Display a record
    */
    public function show($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $data = [
            'show' => $this->project->get(decrypt_url($id)),
            'title' => 'Detil',
            'page' => 'data/detil_data',
        ];
        $this->load->view('index', $data);
    }

    /*
      Save the submitted record
    */
    public function store()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('shm', 'Shm', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->project->store();
            $this->session->set_flashdata('success', "Saved Successfully!");
        }

        redirect(base_url('project'));
    }

    /*
      Update the submitted record
    */
    public function update($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('shm', 'Shm', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url('project/edit/' . $id));
        } else {
            $this->project->update(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
            redirect(base_url('project'));
        }
    }

    /*
      Delete a record
    */
    public function delete($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->project->delete(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('project'));
    }
}
