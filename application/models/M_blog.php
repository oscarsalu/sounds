<?php

class M_blog extends CI_Model
{
    public function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }
    /**
     * Get comments blog.
     *
     * @param int $blog_id
     *
     * @return array $blogs_comment
     **/
    public function getcomment_blog($blog_id)
    {
        $this->db->where('id_blog', $blog_id);
        $query = $this->db->get('blogs_comment')->result_array();

        return $query;
    }
    /**
     * List Blog ((99sound)).
     *
     * @param int $offets
     * @param int $offets
     *
     * @return array $blogs
     **/
    public function list_blog_admin($offets, $start)
    {
        $result = $this->db
                  ->where('type', 'admin')
                  ->where('blocked!=', 1)
                  ->order_by('id', 'DESC')
                  ->limit($offets, $start)
                  ->get('blogs')->result_array();

        return $result;
    }
    /**
     * Featured post.
     *
     * @return array $blogs
     **/
    public function featured_post()
    {
        $result = $this->db
          ->where('type', 'admin')
          ->where('blocked!=', 1)
          ->order_by('id', 'DESC')
          ->limit(5)
          ->get('blogs')->result_array();

        return $result;
    }
    /**
     * List Most popular.
     *
     * @return array $blogs
     **/
    public function most_popular()
    {
        $result = $this->db
          ->where('type', 'admin')
          ->where('blocked!=', 1)
          ->order_by('count_read', 'DESC')
          ->limit(5)
          ->get('blogs')->result_array();

        return $result;
    }
    /**
     * count blog blog 99sound.
     *
     * @return int
     **/
    public function num_blogs_admin()
    {
        $num = $this->db
            ->where('type', 'admin')
            ->where('blocked!=', 1)
            ->get('blogs')->num_rows();

        return $num;
    }
    /**
     * Count Blog Artist.
     *
     * @return int
     **/
    public function num_blogs_artist($artist_id)
    {
        $num = $this->db->where('user_id', $artist_id)
            ->where('type', 'Artist')
            ->where('blocked!=', 1)
            ->get('blogs')->num_rows();

        return $num;
    }
    /**
     * count Blogs amper.
     *
     * @return int
     **/
    public function num_blogs_amper($artist_id)
    {
        $num = $this->db->where('user_id', $artist_id)
            ->where('type', 'Amper')
            ->where('blocked!=', 1)
            ->get('blogs')->num_rows();

        return $num;
    }
    /**
     * Get Blog less Artist.
     *
     * @param int $artist_id
     * @param int $limit
     *
     * @return array $blogs
     **/
    public function get_blogs_less_artist($artist_id, $limit = 3)
    {
        return $this->db->where('user_id', $artist_id)
            ->where('type', 'Artist')
            ->where('blocked!=', 1)
            ->order_by('id', 'DESC')->limit($limit)
            ->get('blogs')->result_array();
    }
    /**
     * Get Blog less AMPER.
     *
     * @param int $user_id
     *
     * @return array $blogs
     **/
    public function get_blogs_less_amper($user_id, $limit = 3 )
    {
        return $this->db->where('user_id', $user_id)
            ->where('type', 'Amper')
            ->where('blocked!=', 1)
            ->order_by('id', 'DESC')->limit($limit)
            ->get('blogs')->result_array();
    }
    /**
     * Get Blog ALL AMPER.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array $blogs
     **/
    public function get_blogs_all_amper($user_id, $page = 0, $offset = 12)
    {
        return $this->db->where('user_id', $user_id)
            ->where('type', 'Amper')
            ->where('blocked!=', 1)
            ->limit($page, $offset)
            ->order_by('id', 'DESC')
            ->get('blogs')->result();
    }
    /**
     * Get Blog ALL.
     *
     * @param int $user_id
     * @param int $page
     * @param int $offset
     *
     * @return array $blogs
     **/
    public function allblogs()
    {
        $this->db->select('*')
        ->from('blogs')->join('users', 'blogs.user_id = users.id')
        ->order_by('blogs.id', 'DESC');

        return $this->db->get()->result_array();
    }
    /**
     * Count Hits blogs.
     *
     * @param int $id
     **/
    public function Counter_hits($id)
    {
        $data_read = $this->db->where('id', $id)->get('blogs')->row();
        $this->db->where('id', $id)->update('blogs', array('count_read' => $data_read->count_read + 1));
    }

    //function get all blogs of artist on epk dashboard
    public function get_artist_blogs($user_id)
    {
         return $this->db->where('user_id', $user_id)
            ->where('type', 'Artist')
            ->where('blocked!=', 1)
            ->order_by('id', 'DESC')
            ->get('blogs')->result_array();
    }

    public function list_blogs_epk($user_id)
    {
        //code added to get photos for epk
        $epk_data = $this->db->where('user_id', $user_id)->select('epk_blog')->get('customize_epk')->row_array();
        if($epk_data['epk_blog'])
        {
            $dataArray = array_reverse(explode(',', $epk_data['epk_blog']));
            return $this->db->where('user_id', $user_id)
                ->where('blocked!=', 1)
                ->where('type', 'Artist')
                ->where_in('id', $dataArray)->order_by('id', 'DESC')
                ->get('blogs')->result_array();
        }
        else
        {
            return $this->db->where('user_id', $user_id)
                ->order_by('id', 'DESC')
                ->where('blocked!=', 1)
                ->where('type', 'Artist')
                ->get('blogs')->result_array();
        }
    }
}
