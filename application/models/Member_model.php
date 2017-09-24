<?php

class Member_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * Get items member.
     *
     * @param string $table
     * @param string $where
     *
     * @return array items member
     **/
    public function getUserByName($table, $where)
    {
        return $this->db->get_where($table, $where)->result();
    }
    /**
     * Stats fan page epk.
     *
     * @param string $fans
     * @param string $age_l
     * @param string $age_r
     * @param string $gender
     *
     * @return int
     **/
    public function stast_fan($fans, $age_l, $age_r, $gender = null)
    {
        if (count($fans) == 0) {
            return '0.0';
        }

        $num_stats = 0;
        foreach ($fans as $row) {
            $cal_age = date('Y', time()) - date('Y', $row['birthday']);
            if ($cal_age >= $age_l && $cal_age <= $age_r) {
                if (!empty($gender)) {
                    if ($gender == $row['gender']) {
                        ++$num_stats;
                    }
                } else {
                    ++$num_stats;
                }
            }
        }

        return number_format($num_stats * 100 / count($fans), 1);
    }

    /**
     * Short Text Bio.
     *
     * @param string $text
     *
     * @return string
     **/
    public function short_Text_Bio($text)
    {
        //$text = trim($text," ");  
      //$text = preg_replace('/\s+/', '', $text);
      $desLength = strlen($text);
      //var_dump($desLength);exit;            
      $stringMaxLength = 200;
        if ($desLength > $stringMaxLength) {
            $des = substr($text, 0, $stringMaxLength);
            $text = $des.'...';

            return $text;
        } else {
            return $text;
        }
    }
}
