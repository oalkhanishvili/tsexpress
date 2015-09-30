<?php

class Gfp extends CI_Controller
{
      function __construct()
      {
            parent::__construct();
            $this->load->database();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
      }

      public function index()
      {
       
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
 
       if ($this->form_validation->run() == FALSE)
      {
             $this->load->view('pages/email_check');
       }
       else
      {
         $email= $this->input->post('email');

      $this->load->helper('string');
      $rs= random_string('alnum', 12);

      $data = array(
                     'rs' => $rs
                  );
      $this->db->where('email', $email);
      $this->db->update('users', $data);

      //now we will send an email

      // $config['protocol'] = '';
      // $config['mailpath'] = '/usr/sbin/sendmail';
      $config['charset'] = 'utf-8';
      $config['wordwrap'] = TRUE;


      $this->load->library('email', $config);

      $this->email->from('noreply@tsexpress.ge', 'Tsexpress');
      $this->email->to($email);

      $this->email->subject('პაროლის აღდგენა');
      $this->email->message('გთხოვთ გადახვიდეთ მითითებულ ლინკზე პაროლის აღსადგენად.
             http://tsexpress.ge/get_password/index/'.$rs );

      $this->email->send();
      echo $this->email->print_debugger();
      echo "გთხოვთ შეამოწოთ წერილი ელ.მისამართზე.";
      echo "<br><a href=".site_url().">დაბრუნდით მთავარ გვერდზე</a>";
             }
       }

            public function email_check($str)
            {
      $query = $this->db->get_where('users', array('email' => $str), 1);
       
            if ($query->num_rows()== 1)
            {
                   return true;
                  }
                  else
                  {    
                   $this->form_validation->set_message('email_check', 'ასეთი ელ.პოსტა სისტემაში არ მოიძებნა.');
             return false;

            }
         }    
}
