=== WP Blogs' Planetarium === 
Contributors: crodas
Tags: rss agregator, blogs planetarium, planetarium
Requires at least: 2.0.2
Tested up to: 2.7.1
Stable Tag: trunk/


Turns your WP into a blogs' planetarium.

== Description == 

This project help to turn your WP installation into a Blogs' Planetarium similtar to the PHP Planetarium (http://planet-php.net/).

== Instalation == 

1. Upload the plugin into your WP plugin directory.
2. Enable the plugin.
3. Add some blogs and configure your crawling method. 
   * Via crontab task: simply exec it, i.e 
       * php /www/wp/index.php
   * Via web. In order to use via web you should set a key
     and crawl in the follow manner:
        http://wordpress-blog.com/?wbp_key=<?php echo md5($key.date("z"))?>
4. Start crawling (IMHO at every 1 hour is enough)




