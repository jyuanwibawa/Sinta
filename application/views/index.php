<?php
// var_dump($this->session->userdata());
$this->load->view('/layout/vhead');
$this->load->view('/layout/vscript');
$this->load->view('/layout/vnav');
$this->load->view('/layout/vsidebar');
$this->load->view('/layout/vtitle');
$this->load->view('/' . $page);
$this->load->view('/layout/vfooter');
// $this->load->view('/layout/vscript');
?>