<?php
use model\PostMeta;
use model\Menu;
use model\UserMeta;
use model\SiteMeta;

$cat = $_POST['cat'] ?? '';
if($_POST['paixu'] == 'data'){
    $paixu = 'post_modified';
}elseif($_POST['paixu'] == 'comment_count'){
    $paixu = 'comment_count';
}elseif($_POST['paixu'] == 'views'){
    $paixu = 'post_views';
}else{
    $paixu = 'id';
}
$post_meta = PostMeta::GetPostsMeta(12,$cat,$paixu);
if(!$post_meta){
    header( 'content-type: application/json; charset=utf-8' );
    $result['status']	= 0;
    echo json_encode( $result );
    exit();
}
?>
<section class="cat-2 cat-col cat-col-full">
    <div class="cat-container clearfix">
        <div id="ghost_box_1" class="cms-cat cms-cat-s7">
            <div class="single_posts">
                <?php
                foreach($post_meta as $post_meta){?>
                    <div class="col-md-2 box-2 float-left">
                        <article id="post-78060" class="post type-post status-publish format-standard">
                            <div class="entry-thumb hover-scale">
                                <a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>"><img width="500" height="340" src="<?php echo SiteMeta::GetSiteMetaItem('site_lazy_img');?>" data-original="<?php echo $post_meta['post_header_img'];?>" class="lazy show" alt="<?php echo $post_meta['post_title'];?>" style="display: block;"></a>
                                <ul class="post-categories">
                                    <li><a href="<?php echo Menu::GetMenuUrl($post_meta['post_menu']);?>" rel="category tag"><?php echo Menu::GetMenuTitle($post_meta['post_menu']);?></a></li></ul>
                            </div>
                            <a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" target="_blank" class="post_box_avatar_link" title="<?php echo $post_meta['post_author'];?>">
                                <img class="post_box_avatar_img" title="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?>" src="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['user_avatar'];?>" width="50" height="50" alt="<?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?>">
                                <span class="post_box_avatar_author_name"><?php echo UserMeta::GetAuthorMeta($post_meta['post_author'])['display_name'];?></span>
                            </a>
                            <div class="entry-detail">
                                <header class="entry-header">
                                    <h2 class="entry-title h4"><a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>" rel="bookmark"><?php echo $post_meta['post_title'];?></a>
                                    </h2>
                                    <div class="entry-meta entry-meta-1">
                                        <span class="entry-date text-muted"><i class="fas fa-bell"></i><time class="entry-date" datetime="<?php echo $post_meta['post_date'];?>" title="<?php echo UserMeta::TimeTran($post_meta['post_date']);?>"><?php echo UserMeta::TimeTran($post_meta['post_date']);?></time></span>
                                        <span class="comments-link text-muted pull-right"><i class="far fa-comment"></i><a href="<?php echo PostMeta::GetPostUrl($post_meta['ID']);?>"><?php echo $post_meta['comment_count'];?></a></span>
                                        <span class="views-count text-muted pull-right"><i class="fas fa-eye"></i><?php echo $post_meta['post_views'];?></span>
                                    </div>
                                </header>
                            </div>
                        </article>
                    </div>
                <?php } ?>
                <div class="ghost_other_more_post">
                    <a data-paged="0" data-cat="<?php echo $cat;?>" class="more-post ajax-morepost">更多文章 <i class="tico tico-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>