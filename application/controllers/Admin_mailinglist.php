<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property mailinglist_model $mailinglist *
 */
class Admin_mailinglist extends Front_end
{

    function __construct()
    {

        parent::__construct();

        $this->load->language('mailinglist');
        $this->load->model('mailinglist_model', 'mailinglist');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span class='incorrect'>", "</span>");
    }

    public function index()
    {
        $this->view('content/mailinglist_list');
    }


    public function ajax_list()
    {

        $list = $this->mailinglist->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->MailinglistName;
            $row[] = $customers->MailinglistEmail;
            $row[] = $customers->MailinglistMobile;
            $row[] = $customers->MailinglistIp;
            $row[] = $customers->MailinglistType;
            $row[] = $customers->MailinglistId;

            //add html for action
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mailinglist->count_all(),
            "recordsFiltered" => $this->mailinglist->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_delete($id)
    {
        $this->mailinglist->delete_by_id($id);
        $this->session->set_flashdata('success_msg', lang('success_msg_del'));
        redirect('admin_mailinglist/');    }


    /**
     * This function remove mail then redirect to overview
     * @example id=1
     * @param integer $id
     */
    public function remove($id)
    {
        //  print "ddd" .$id;
        // $mailinglist = $this->mailinglist->get_new_one($id);
        $this->mailinglist->delete($id);
        $this->session->set_flashdata('success_msg', lang('success_msg_del'));
        redirect('admin_mailinglist/');

    }


}

/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */