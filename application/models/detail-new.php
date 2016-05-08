<?php

class Detail extends CI_model{

function det($prdct_id){

$commentList="";
$commentList.='
<div id="more_info_block" class="clear">
<ul id="more_info_tabs" class="idTabs idTabsShort clearfix">
<li>
<a id="more_info_tab_more_info" class="selected" href="#idTab1">En savoir plus</a>
</li>
<li>
<a href="#idTab4">Accessoires</a>
</li>
<li>
<a class="idTabHrefShort" href="#idTab5">Comments</a>
</li>
</ul>
<div id="more_info_sheets" class="sheets align_justify">
<div class="title_hide_show selected" style="display:none">En savoir plus</div>
<div id="idTab1" class="rte content_hide_show fadeInDown animated" data-delay="200" data-animate="fadeInDown">
<div class="clearfix">
<h5>Phasellus semper semper sem a luctus.</h5>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta velit in turpis auctor et emper diam vehicula. Phasellus semper semper sem a luctus. Nulla iaculis, neque a congue auctor, neque neque venenatis sapien, sit amet faucibus augue augue dignissim tellus. Cum sociis natoque penatibus et magnis dis parturient montes, semper sem scetur ridiculus mus.
<br>
<br>
Aenean vel metus neque. Nunc vestibulum, massa in suscipit condimentum, arcu tortor oreet Proin faucibus, risus vel convallis imperdiet, elit tortor luctus augue, nec pellentesque lectus mi eget erat. Aliquam at tortor turpis, vel hendrerit elit. Donec nec malesuada mi. Donec ullamcorper facilisis nisl eget ultrices.
</p>
<p>Maecenas elementum quam at enim vulputate rutrum. Suspendisse potenti. Nulla et diam nibh. Nam ac est vitae arcu euismod blandit lacinia ac mi. Sed et erat nisi. Donec nec quam erat, in fringilla nulla. Cras quis nisl ac odio malesuada fermentum. Vivamus felis massa, convallis non luctus id, congue sed quam.</p>
</div>
<div class="clearfix">
<img class="img_right" height="350" width="400" alt="" src="http://demo3.eggthemes.com/et_bestchoice/img/cms/image_des_2.jpg">
<h5>Sociis natoque penatibus et magnis dis part</h5>
<p>
Maecenas elementum quam at enim vulputate rutrum. Suspendisse potenti. Nulla et diam nibh. Nam ac est vitae arcu euismod blandit lacinia ac mi. Sed et erat nisi.
<br>
<br>
Donec nec quam erat, in fringilla nulla. Cras quis nisl ac odio malesuada fermentum. Vivamus felis massa, convallis non luctus id, congue sed quam.
<br>
<br>
Donec laoreet, justo nec commodo consectetur, elit metus voltpat urna, a adipiscing quam magna sit amet urna. Etiam vel nisi eu elit aliquet dapibus. Proin faucibus, risus vel convallis imperdiet, elit tortor luctus augue, nec pellentesque lectus mi eget erat. Aliquam at tortor turpis, vel hendrerit elit. Donec nec malesuada mi. Donec ullamcorper facilisis nisl eget ultrices.
</p>
<p>
- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
<br>
<br>
- Phasellus semper semper sem a luctus.
<br>
<br>
- Nulla iaculis, neque a congue auctor, neque neque venenatis sapien, sit amet faucibus augue augue tellus. Proin faucibus, risus vel convallis imperdiet, elit tortor luctus augue
<br>
<br>
Cum sociis natoque peat- ibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas elementum quam at enim vulputate rutrum. Suspene potenti. Nulla et diam nibh. Nam ac est vitae arcu euismod blait lacinia ac mi. Sed et erat nisi.
</p>
</div>
</div>
<div class="title_hide_show" style="display:none">Accessoires</div>
<ul id="idTab4" class="bullet content_hide_show block_hidden_only_for_screen not-animated" data-delay="200" data-animate="fadeInDown">
<div class="block products_block accessories_block clearfix">
</ul>
<script type="text/javascript">
/* <![CDATA[ */var productcomments_controller_url="http://demo3.eggthemes.com/et_bestchoice/index.php?fc=module&amp;module=productcomments&amp;controller=default&amp;id_lang=5";var confirm_report_message="Are you sure you want report this comment?";var secure_key="d6ef075ad0e5a2729980b60ac434098f";var productcomments_url_rewrite="0";var productcomment_added="Your comment has been added!";var productcomment_added_moderation="Your comment has been added and will be available once approved by a moderator";var productcomment_title="New comment";var productcomment_ok="OK";var moderation_active=0;/* ]]> */
</script>
<div id="mobile_tab_comment" class="title_hide_show" style="display:none">Comments</div>
<div id="idTab5" class="content_hide_show block_hidden_only_for_screen not-animated" data-delay="200" data-animate="fadeInDown">
<div id="product_comments_block_tab">
<p class="align_center">
<a id="new_comment_tab_btn" class="open-comment-form" href="#new_comment_form">Be the first to write your review !</a>
</p>
</div>
</div>
<div style="display: none;">
<div id="new_comment_form">
<form id="id_new_comment_form" action="#">
<h2 class="title">Donnez votre avis</h2>
<div class="product clearfix">
<img alt="Praesent dapibus ullamcorper molest lorem" src="http://demo3.eggthemes.com/et_bestchoice/img/p/2/8/2/282-home_default.jpg">
<div class="product_desc">
<p class="product_name">
<strong>Praesent dapibus ullamcorper molest lorem</strong>
</p>
<p>Pellentesque venenatis dignissim libero ac luctus. Sed ultrices ornare odio in lacinia. Vestibulum tempor lectus ac enim malesuada ullamcorper. Duis id urna quis turpis ullamcorper sollicitudin. Sed sit amet nulla ipsum, a mattis mauris.</p>
</div>
</div>
<div class="new_comment_form_content">
<h2>Donnez votre avis</h2>
<div id="new_comment_form_error" class="error" style="display: none;">
<ul></ul>
</div>
<ul id="criterions_list">
<li>
<label>Quality:</label>
<div class="star_content">
<input type="hidden" value="3" name="criterion[1]">
<div class="cancel">
<a title="Cancel Rating"></a>
</div>
<div class="star star_on">
<a title="1">1</a>
</div>
<div class="star star_on">
<a title="2">2</a>
</div>
<div class="star star_on">
<a title="3">3</a>
</div>
<div class="star">
<a title="4">4</a>
</div>
<div class="star">
<a title="5">5</a>
</div>
</div>
<div class="clearfix"></div>
</li>
</ul>
<label for="comment_title">
Titre:
<sup class="required">*</sup>
</label>
<input id="comment_title" type="text" value="" name="title">
<label for="content">
Commenter:
<sup class="required">*</sup>
</label>
<textarea id="content" name="content"></textarea>
<label>
Votre nom:
<sup class="required">*</sup>
</label>
<input id="commentCustomerName" type="text" value="" name="customer_name">
<div id="new_comment_form_footer">
<input id="id_product_comment_send" type="hidden" value="43" name="id_product">
<p class="fl required">
<sup>*</sup>
Les champs obligatoires
</p>
<p class="fr">
<button id="submitNewMessage" type="submit" name="submitMessage">Envoyer</button>
  ou 
<a onclick="$.fancybox.close();" href="#">résilier</a>
</p>
<div class="clearfix"></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>


';
  
  //return $detailproduct;
return $commentList;
exit();
  
  
  }}

  
 
 ?>
 