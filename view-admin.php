<div class="wrap">
<h2><?php _e('Configure your WBP')?></h2>
<p>
<?php _e('In order to create your planetarium, you should crawl (read all the blogs, searching for new posts). There are two methods by console,
and via Web. In order to use via web you should set a password');?>. <a href="http://cesar.la/wbp"><?php _e("Read more")?></a>
</p>
<form method="post">
Key: <input type="input" name="key" value="<?php echo wbp_html::get_key()?>" /><br/>
<?php if (wbp_html::get_crawl_link()): ?>
<p><?php _e("Todays crawl URL")?>: <a href="<?php echo wbp_html::get_crawl_link();?>"><?php echo wbp_html::get_crawl_link()?></a></p>
<p><?php _e("(developer note:) In order to crawl via URL it you should call the follow URL: ");?><em><?php echo get_option('siteurl')."?wbp_key=&lt;?php echo md5(\$key.date(z))?&gt;";?></em></p>
<?php endif; ?>
<input type="submit" value="Set key" />
</form>
<h2><?php _e('Blogs at the Planetarium')?></h2>
<?php echo $GLOBALS['msg'] ?>
<form method="post">
    <input type="input" name="url" value="http://" />
    <input type="submit" name="submit" value="Add blog!" />
</form>
<br />
<!-- I am not good in design, so I copy it -->
<table class="widefat" id="active-plugins-table">
	<thead>
	<tr>
		<th scope="col"><?php _e("Title");?></th>
		<th scope="col"><?php _e("URL");?></th>
		<th scope="col"><?php _e("RSS");?></th>
        <th></th>
	</tr>
	</thead>
	<tbody class="plugins">
    <?php foreach(wbp_blogs::GetAll() as $url=>$blog) : ?>
	<tr class='active'>
		<td class='name'><a href="<?php echo $url?>"><?php echo $blog['title']?></a></td>
		<td class='url'><?php echo $url?></td>
		<td class='rss'><?php echo $blog['rss']?></td>
		<td class='togl action-links'><a href="options-general.php?page=wp-blogs-planetarium/wbp.php&del=<?php echo md5($url);?>" class="delete"><?php _e("Delete it!");?></a></td>
	</tr><?php endforeach; ?>	</tbody>
</table>

</div>
