<?php

class M_chat_keyword extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //Function to check word is allowed in chat
    public function check_spam_word($word)
    {
        $word = $this->db
            ->like('keyword', $word)
            ->get('chat_keyword')->row_array();
       return $word; 
    }
}
