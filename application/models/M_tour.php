<?php

class M_tour extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }

    /* ************* add insert data *************** */
    public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
        $num = $this->db->insert_id();

        return $num;
    }
/* ************* add insert num row data *************** */
    /*function insert_data_num($table,$data)
    { 
         $query = $this->db->insert($table,$data);
        $num = $query->num_rows();
        return $num;
    }*/
/* ************* update data *************** */
    public function update_data($table, $where, $data)
    {
        $this->db->where($where);
        $update = $this->db->update($table, $data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
/*get count for pagination */
    public function get_count($table1, $table2, $id1, $id2, $column = '', $where, $orderby)
    {
        if ($column != '') {
            $this->db->select($column);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$id2.'='.$table1.'.'.$id1);
        if ($where != '') {
            foreach ($where as $key => $value) {
                $this->db->or_like("$key", "$value");
            }
            //$this->db->where($where);	
        }
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
        }

        $que = $this->db->get();

        return $que->num_rows();
    }
/* ************* get single   data *************** */
    public function getSingle($table, $where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->result_array();

        $num = $data->num_rows();

        if ($num) {
            return $get;
        } else {
            return false;
        }
    }
    /* ************* get single   data *************** */
    public function getSingleRow($table, $where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->row_array();

        $num = $data->num_rows();

        if ($num) {
            return $get;
        } else {
            return false;
        }
    }
/* ************* get all data as where class *************** */
    public function getwhere($table, $where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->result();
        if ($get) {
            return $get;
        } else {
            return false;
        }
    }
/* ************* get all data as where class *************** */
    public function getwheres($table, $where)
    {
        $this->db->where($where);
        $data = $this->db->get($table);
        $get = $data->result_array();
        if ($get) {
            return $get;
        } else {
            return false;
        }
    }
/* ************* get all data as where class order by *************** */
    public function getwheres_orderby($table, $where, $orderby)
    {
        $this->db->where($where);
        if ($orderby != '') {
            $this->db->order_by($orderby);
        }
        $data = $this->db->get($table);
        $get = $data->result_array();
        if ($get) {
            return $get;
        } else {
            return false;
        }
    }
/* ************* get all data as where class getwhere_limit *************** */
    public function getwhere_limit($table, $where, $limit, $orderby)
    {
        $this->db->where($where);
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
        }
        $this->db->limit($limit);
        $data = $this->db->get($table);

        $get = $data->result_array();
        if ($get) {
            return $get;
        } else {
            return false;
        }
    }
/***************Start Get All Data******************************/
    public function getdata($table)
    {
        $this->db->select('*');
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }
/***************End Get All Data*******************************/

/***************Start Get All Data orderby******************************/
    public function getdata_orderby($table, $orderby)
    {
        $this->db->select('*');
        if ($orderby != '') {
            $this->db->order_by($orderby);
        }
        $data = $this->db->get($table);
        $get_data = $data->result_array();
        if ($get_data) {
            return $get_data;
        } else {
            return false;
        }
    }
/***************End Get All Data orderby*******************************/

/* ************* Delete data *************** */
    public function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->limit('1');
        $del = $this->db->delete($table);
        if ($del) {
            return true;
        } else {
            return false;
        }
    }
/*************Query two table join *******************/
    public function get_data_twotable_column_where($table1, $table2, $id1, $id2, $column = '', $where, $orderby)
    {
        if ($column != '') {
            $this->db->select($column);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$id2.'='.$table1.'.'.$id1);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
        }
        $que = $this->db->get();

        return $que->result_array();
    }
/************End Join Two Table*******************/
/*************Query two table join limit *******************/
    public function get_data_twotable_column_where_limit($table1, $table2, $id1, $id2, $column = '', $where, $orderby, $limit)
    {
        if ($column != '') {
            $this->db->select($column);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$id2.'='.$table1.'.'.$id1);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
            $this->db->limit($limit);
        }
        $que = $this->db->get();

        return $que->result_array();
    }
/************End Join Two Table limit*******************/
/*************Query two table join *******************/
    public function get_data_twotable_like($table1, $table2, $id1, $id2, $column = '', $where, $orderby, $num, $offset)
    {
        if ($column != '') {
            $this->db->select($column);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$id2.'='.$table1.'.'.$id1);
        if ($where != '') {
            foreach ($where as $key => $value) {
                $this->db->or_like("$key", "$value");
            }
        }
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
        }
        if ($num != '') {
            $this->db->limit($num, $offset);
        }
        if ($offset != '' and $num != '') {
            $this->db->limit($num, $offset);
        }
        $que = $this->db->get();

        return $que->result_array();
    }
/************End Join Two Table*******************/

/* ************* Start Join  data  for title subtitle *************** */
    public function join_profile_registration()
    {
        $this->db->select('*');
        $this->db->from('tbl_profile');
        $this->db->join('tbl_registration', 'tbl_profile.userid=tbl_registration.id');
            /*$this->db->where('tbl_product_desc',$where);*/
            /*$this->db->order_by('c.track_title','asc');  */
            $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
/* ************* End Join  data  for title subtitle *************** */
    public function convertmoney($money)
    {
        if ($money > 0) {
            setlocale(LC_MONETARY, 'en_US');
            if (function_exists('money_format')) {
                echo money_format('%10.2n', $money);
            } else {
                echo '$'.$money;
            }
        } else {
            setlocale(LC_MONETARY, 'en_US');
            if (function_exists('money_format')) {
                echo money_format('%10.2n', $money);
            } else {
                echo '$'.$money;
            }
        }
    }
    public function convertmoney_controler($money)
    {
        setlocale(LC_MONETARY, 'en_US');
        if (function_exists('money_format')) {
            return money_format('%10.2n', $money);
        } else {
            return '$'.$money;
        }
    }
    public function check_address($street1)
    {
        //$this->db->select('street1');
        $this->db->where('street1', $street1);
        $query = $this->db->get('db_locations');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function rate_star($event)
    {
        $query = $this->db->select('start')
                         ->where('event_id', $event)
                         ->where('rate', '1')
                         ->get('venues_info');
        if ($query->num_rows() > 0) {
            $data3 = $query->result_array();

            return  count($data3);
        } else {
            return false;
        }
    }
    public function calculate_star($event)
    {
        $query = $this->db->select('start')
                         ->where('event_id', $event)
                         ->where('rate', '1')
                         ->get('venues_info');
        if ($query->num_rows() > 0) {
            $data3 = $query->result_array();
            $total = '';
            foreach ($data3 as $data) {
                $total += $data['start'];
            }
            $sum_star = $total / count($data3);

            return $sum_star;
        } else {
            return false;
        }
    }

    public function check_user_event($event)
    {
        $query = $this->db->select('user_id')
                         ->where('event_id', $event)
                         ->where('rate', '1')
                         ->get('venues_info');
        if ($query->num_rows() > 1) {
            return false;
        } else {
            return true;
        }
    }

    public function check_user_event_star($event, $user_id)
    {
        if (empty($user_id)) {
            return 'no';
        }
        $query = $this->db->select('start')
                        ->where('event_id', $event)
                        ->where('user_id', $user_id)
                        ->where('rate', '1')
                        ->get('venues_info');

        if ($query->num_rows() > 0) {
            return 'no';
        } else {
            return 'oke';
        }
    }

    public function sum_star($event, $data)
    {
        $update = $this->db->where('event_id', $event)
                           ->update('events', $data);
    }
    public function insert_info($table, $data)
    {
        $insert = $this->db->insert($table, $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    public function m_show_comment_venues($event)
    {
        $query = $this->db->select('info_venues,user_id,id')
                        ->where('event_id', $event)
                        ->where('status', '1')
                        ->order_by('id', 'DESC')
                        ->get('venues_info');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function name_show($name)
    {
        $query = $this->db->select('lastname,email')
                        ->where('id', $name)
                        ->get('users');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function delete_comment($event, $user, $id)
    {
        $delete = $this->db->where('event_id', $event)
                ->where('id', $id)
                ->where('status', '1')
                ->where('user_id', $user)
                ->delete('venues_info');
        if ($delete) {
            return true;
        } else {
            return false;
        }
    }

    public function check_chat_tour($tour, $user)
    {
        $query = $this->db->where('tour_id', $tour)
                                ->where('user_id', $user)
                                ->get('tour');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    ///session online
     public function update_status($user, $id_session, $tour)
     {
         $data = array(
        'id_session' => $id_session,
        'status' => '1',
        'time' => time(),
        );
         $this->db->where('user_id', $user)
                 ->where('tour_id', $tour)
                 ->update('groups_chat_tour', $data);
     }
    public function delete_status($user, $id_session, $tour)
    {
        $data = array(
        'id_session' => '',
        'status' => '0',
        'time' => time(),
        );
        $this->db->where('user_id', $user)
                 ->where('tour_id', $tour)
                 ->update('groups_chat_tour', $data);
    }
    public function check_session($timeout, $name)
    {
        $data = array(
        'id_session' => '',
        'status' => '0',
        );
        $this->db->where('time <', $timeout)
                ->where('user_id', $name)
                 ->update('groups_chat_tour', $data);
    }
    public function check_id_session($id_ss)
    {
        $data = array(
        'id_session' => '',
        'status' => '0',
        );
        $this->db->where('id_session', $id_ss)
                 ->update('groups_chat_tour', $data);
    }
    public function check_sid_exist($id_ss)
    {
        $res = $this->db->select('*')->where('id_session', $id_ss)->get('groups_chat_tour');
        if ($res->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function check_times($id_ss, $time)
    {
        $data = array(
        'time' => $time,
        'status' => '1',
        );
        $this->db->where('id_session', $id_ss)
                 ->update('groups_chat_tour', $data);
    }

    public function test_sesion($id_user)
    {
        $res = $this->db->select('id_session')->where('user_id', $id_user)->get('groups_chat_tour');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return false;
        }
    }
      //end test
      public function list_member_tour($tour)
      {
          $list = $this->db->select('user_member')
                 ->where('tour_id', $tour)
                 ->get('tours_member');
          if ($list->num_rows() > 0) {
              return $list->result_array();
          } else {
              return false;
          }
      }
    public function list_name_memeber($tour_id)
    {
        $list = $this->list_member_tour($tour_id);
        if ($list != false) {
            $name = array();
            foreach ($list as $l) {
                $n = $this->name_show($l['user_member']);
                if ($n != false) {
                    $name[] = $n;
                } else {
                    return false;
                }
            }

            return $name;
        } else {
            return false;
        }
    }

    public function check_member_tour($user, $tour)
    {
        $query = $this->db->where('user_member', $user)
                ->where('tour_id', $tour)
                ->get('tours_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function gettax($type, $relate_id)
    {
        $list = $this->db->select()
                 ->where('relate_id', $relate_id)
                 ->where('type', $type)
                 ->order_by('id', 'DESC')
                 ->get('tax_tours');
        if ($list->num_rows() > 0) {
            return $list->result_array();
        } else {
            return false;
        }
    }
    public function member_tour($tour_id)
    {
        $list = $this->db->select('user_member')
                 ->where('tour_id', $tour_id)
                 ->get('tours_member');
        if ($list->num_rows() > 0) {
            return $list->result_array();
        } else {
            return false;
        }
    }
    public function member_tour_email($user_id)
    {
        $list = $this->db->select('email,lastname')
                     ->where('id', $user_id)
                     ->get('users');
        if ($list->num_rows() > 0) {
            return $list->row_array();
        } else {
            return false;
        }
    }
    public function choose_tour($id)
    {
        return $this->db->select('*')
                 ->where('tour_id', $id)
                 ->get('tour')->row_array();
    }
    public function name_artist($name_id)
    {
        return $this->db->select('artist_name')
                        ->where('id', $name_id)
                        ->get('users')->row_array();
    }
    public function show_book_venues($location_id)
    {
        $show = $this->db->select('*')
                          ->where('location_id', $location_id)
                          ->get('venues_books');
        if ($show->num_rows() > 0) {
            return $show->result_array();
        } else {
            return false;
        }
    }
    public function show_book_venues_all()
    {
        $show = $this->db->select('*')
                          ->order_by('id', 'desc')
                          ->get('venues_books');
        if ($show->num_rows() > 0) {
            return $show->result_array();
        } else {
            return false;
        }
    }

    public function get_tour_name($id)
    {
        $name_tour = $this->db->select('tour')
                          ->where('tour_id', $id)
                          ->get('tour')->row_array();
        return $name_tour['tour'];

    }

    public function check_tour_member($user_id)
    {
        $dataReturn = $this->db->select('tour_id')->where('user_member', $user_id)
            ->get('tour_member')->result_array();
        return $dataReturn;    
    }
}
