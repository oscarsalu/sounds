<ol class="breadcrumb">
  <li><a href="<?=base_url('admin/blogs')?>">Blogs</a></li>
  <li class="active">Read Blog</li>
</ol>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Read Details Blog</div>                    
                </div>
            </div>
            <div class="card-body" style="padding: 25px 0px;">
                
                <h1><?=$blog['title']?></h1>
                <div class="blog_introduction"><?=$blog['introduction']?></div>
                <hr />
                <div><?=$blog['content']?></div>
                <a  onclick="history.go(-1);" href="#"class="btn btn-danger add_" id="empty_admin">Back</a>
            </div>
        </div>
        
    </div>
</div>