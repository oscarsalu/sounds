<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_manager_blogs extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    /**
    * Get record users by id_user
    * @param int $user_id
    * @return array $users
    **/
    public function users($user_id){
        $result = $this->db->select("*,users.id")
        ->from('users')
        ->where('users.id', $user_id)    
        ->join('photos', 'users.id = photos.user_id','left')
        ->join('countries', 'users.countries = countries.id')
        ->get()->result_array();
        return $result;
    }
    /**
    * Get List record user
    * @return array $users
    **/
    public function list_users(){
        $result = $this->db->select("*,users.id")
        ->from('users')                                                                 
        ->join('countries', 'users.countries = countries.id')
        ->join('genres', 'users.genre = genres.id')
        ->get()->result_array();
        return $result;
    }
    /**
    * Get List record blogs
    * @param int $per_page
    * @param int $start
    * @return array $users
    **/
    public function list_blog($per_page,$start){
        $result = $this->db->select('*,blogs.id as id_blog')
                  ->from('blogs')
                  ->join('users', 'blogs.user_id = users.id')
                  ->where('users.is_admin',1)
                  ->order_by('blogs.id', 'DESC')
                  ->limit($per_page,$start)->get()->result_array();           
        return $result;                
    }
    /**
    * Get List record blogs
    * @param int $per_page
    * @param int $start
    * @return array $users
    **/
    public function all_spam($per_page,$start){
        $keywords = $this->db->get('blogs_keyword')->result_array();  
        if(!empty($keywords)) {
            $this->db->group_start();
            foreach($keywords as $key){
                $this->db->or_like('content', $key['keyword']);    
                $this->db->or_like('title', $key['keyword']);   
                $this->db->or_like('introduction', $key['keyword']);                                         
            }
            $this->db->group_end();    
        }   
        $this->db->where('blocked',0); 
        $blog_spam = $this->db->limit($per_page,$start)->get('blogs')->result_array();
        return $blog_spam; 
    }
    public function num_spam(){
        $keywords = $this->db->get('blogs_keyword')->result_array();      
        if(!empty($keywords)) {
            $this->db->group_start();
            foreach($keywords as $key){
                $this->db->or_like('content', $key['keyword']);    
                $this->db->or_like('title', $key['keyword']);   
                $this->db->or_like('introduction', $key['keyword']);                                         
            }
            $this->db->group_end();    
        }   
        $this->db->where('blocked',0);
        return $this->db->order_by('time', 'DESC')->get('blogs')->num_rows();
    }
    public function num_blog_admin(){
        $result = $this->db->select('*,blogs.id as id_blog')
                  ->from('blogs')
                  ->join('users', 'blogs.user_id = users.id')
                  ->where('users.is_admin',1)
                  ->order_by('blogs.id', 'DESC')
                  ->get()->num_rows();           
        return $result;                
    }
    public function get_keyword(){
        $results = $this->db->get('blogs_keyword')->result_array();
        $html = ' ';
        $i = 1;
        foreach($results as $result)
        {  
            $html .= "<tr>
                         <th style='vertical-align: middle;' scope='row'>".$i."</th>
                         <td style='vertical-align: middle;'><input class='form-control' type='text' name='key_' id='key_' value='".$result['keyword']."'></td>
                         <td style='vertical-align: middle;'>
                             <a class='update_key btn btn-primary btn-sm'><i class='fa fa-check'></i></span></a>
                             <a class='delete_key btn btn-danger btn-sm'><i class='fa fa-close'></i></span></a>
                         </td><input type='hidden' id='id_key' value='".$result['id']."'>
                     </tr>"; 
            $i++;                                                     
        }
        return $html;
    }
    
    public function getAllBlog(){
        $results = $this->db->get('blogs')->result_array();
        return $results; 
    }
    
    public function getBlogBlocked($per_page,$start){
        $keywords = $this->db->get('blogs_keyword')->result_array();
        $this->db->where('blocked',1);
        return $this->db->limit($per_page,$start)->order_by('time', 'DESC')->get('blogs')->result_array();   
    }
    public function numBlogBlocked(){
        $this->db->where('blocked',1);
        return $this->db->get('blogs')->num_rows(); 
    }
    public function take_down($id){
        $updateArr = array(
            'blocked' => "1",
        );
        $this->db->update('blogs',$updateArr,array('id' => $id));
        $blog = $this->db->where('id',$id)->get('blogs')->row();
        if(isset($blog)){
            $notiArr = array(
                'user_id'  => $blog->user_id,
                'is_read'  => '0', 
                'messages' => $this->input->post('message'),
                'time'     => time(),                     
            );
            $this->db->insert('notifications',$notiArr);
            $user_blog = $this->db->where('id',$blog->user_id)->get("users")->row();
            if(isset($user_blog)){
                if($user_blog->num_down_blogs >3){
                    $this->db->where('id',$user_blog->id)->update('users',array(
                        'lock'=> 1
                    ));
                }else{
                     $this->db->where('id',$user_blog->id)->update('users',array(
                        'num_down_blogs'=> $user_blog->num_down_blogs + 1
                    ));
                }    
            }     
        }
    }
    public function unblock($id){
        $updateArr = array(
            'blocked' => "2",
        );
        $this->db->update('blogs',$updateArr,array('id' => $id));
        $blog = $this->db->where('id',$id)->get('blogs')->row();
        if(isset($blog)){
            $notiArr = array(
                'user_id'  => $blog->user_id,
                'is_read'  => '0', 
                'messages' => $this->input->post('message'),
                'time'     => time(),                     
            );
            $this->db->insert('notifications',$notiArr);
            $user_blog = $this->db->where('id',$blog->user_id)->get("users")->row();
            if(isset($user_blog)){
                if($user_blog->num_down_blogs > 0){
                     $this->db->where('id',$user_blog->id)->update('users',array(
                        'num_down_blogs'=> $user_blog->num_down_blogs - 1
                    ));     
                }
            }       
        }
    }
}    