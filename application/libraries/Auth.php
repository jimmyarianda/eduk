<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth 
{
    
    public $CI;
    
    public function __construct() 
    {
        $this->CI = &get_instance();
    }
    
    public function logged_in() 
    {
        return $this->CI->session->userdata('usr_loggedin');
    }
    
    // public function status() 
    // {
    //     return $this->CI->session->userdata('usr_status');
    // }
    
    public function level() 
    {
        return $this->CI->session->userdata('usr_level');
    }
    
    public function auth() 
    {
        if ($this->logged_in() === TRUE) {
            if ($this->level() === 'Admin') {
                redirect('admin/dashboard');
            } elseif ($this->level() === 'User') {
                redirect('user/dashboard');
            }
        } 
    }
    
    public function restrict() 
    {
        if (!$this->logged_in()) {
            redirect('login');
        }
    }

    public function is_admin()
    {
        if ($this->level() === 'Admin') {
            redirect('admin/dashboard');
        }
    }

    public function not_admin()
    {
        if ($this->level() !== 'Admin') {
            redirect('user/dashboard');
        }
    }
}
