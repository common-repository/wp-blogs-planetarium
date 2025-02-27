<?php
set_time_limit(0);

$rblog = new lastRss;
$blogs = wbp_blogs::GetAll();

function posts_exits($title) {
    $wpdb = & $GLOBALS['wpdb'];
    $table_prefix = $GLOBALS['table_prefix'];
    $title = addslashes($title);
    return $wpdb->get_var("select * from ${table_prefix}posts where post_title='$title'") !== NULL;
}

/* disable the trackback */
update_option('default_pingback_flag','');

foreach($blogs as $url => $blog) {
    echo "$url<br/>\n";
    flush();
    $content = $rblog->Get($blog['rss']);
    if ($content===false) {
        /* probably changes the RSS address?*/
        $content = $rblog->Get($url);
        if ($content===false) {
            /* page is down? */
            continue;
        }
        /* */
        $rss = isset($GLOBALS['frss']) ? $GLOBALS['frss'] : $url;
        $title = isset($result['title']) ? $result['title'] : $rss;
        $blogs[$url] = array("rss"=>$rss,"title"=>$title);
    }

        

    foreach($content['items'] as $item) {
        if (posts_exits($item['title'])) {
            continue;
        }
        print "Adding ".$item['title']."<br/>\n";
        flush();
        if (isset($item['atom:summary'])) { 
            $item['description'] = $item['atom:summary'];
        }
        $tags = isset($item['category']) ? $item['category'] : array();
        $date = isset($item['pubDate']) ? strtotime($item['pubDate']) : time();
        $npost = array();
        $npost['post_title']   = $item['title'];
        $npost['post_content'] = isset($item['content:encoded']) ? $item['content:encoded'] : $item['description']; 
        $npost['post_content'] = html_entity_decode($npost['post_content']);
        $npost['post_status']  = 'publish';
        $npost['post_author']  = 1;
        $npost['post_date']    = date("Y-m-d H:i:s",$date);
        $npost['tags_input']   = implode(",",$tags);
        $npost['post_content'] .= "<p><font size=2>".__("Read more at ").'<a href="'.$item['link'].'">'.$item['title'].'</a></font></p>';

        if ($content['encoding'] != "UTF-8") {
            $npost['post_content'] = utf8_encode($npost['post_content']);
            $npost['post_title']   = utf8_encode($npost['post_title']);
        }
        /* I don't know why */
        $id = @wp_insert_post( $npost );
        add_post_meta($id,'real_url',$item['link'],true);
    }
}

/* something could change, so re-update it */
update_option('wbp_blogs',$blogs);
?>
