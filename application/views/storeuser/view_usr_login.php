<script>
$(document).ready(function(){
    $('input[type="text"]').focus(function() {
        $(this).addClass('focusField');
    });
    $('input[type="text"]').blur(function() {
        $(this).removeClass('focusField');
    });    
    
    $("<?php echo $wherefocus;?>").focus();
});
</script>


<!--[if lt IE 7 ]> <body class="ie6"> <![endif]--> 
<!--[if IE 7 ]>    <body class="ie7"> <![endif]--> 
<!--[if IE 8 ]>    <body class="ie8"> <![endif]--> 
<!--[if IE 9 ]>    <body class="ie9"> <![endif]--> 
<!--[if gt IE 9]>  <body> <![endif]-->
<!--[if !IE]><!--> 
<body> <!--<![endif]-->


<div id="containermainlogin">

<div id="containerlogin">


<div class="signin_header">

<div id="logo_major">ORAKLI ECZANESI</div>


</div>

<div id="login_form">


<?php echo form_open(base_url().'l');  ?>
<!--<fieldset><legend>Üye girişi</legend>-->
<div class="signin-signin">ÜYE GİRİŞİ</div>
<ul>

<li>
<label for="username">Kullanıcı Adı veya E-posta Adresi</label>
<div>
<?php echo form_input(array('id'=> 'username', 'name'=>'username',  'value'=>set_value('username'), 'class'=>$fieldcheckname,'size'=>"20",'tabindex'=>'1'));?>
</div>
<p class="<?php echo $errorfieldusername;?>"><?php echo $messageusername;?></p>
</li>

<li>
<label for="password"><span class="form-label">Şifre</span></label>
<div>
<?php echo form_password(array('id'=> "password",'type'=>"password", 'name'=>'password', 'value'=>set_value('password'), 'class'=>$fieldcheckpass, 'size'=>"20", 'tabindex'=>'2'));?>

</div>
<?php 

//if($this->session->flashdata('login_error'))
if($loginerror!="")
{
echo '<p class="'.$errorfieldpassword.'"> Geçersiz Kullanıcı Adı ve/veya Şifre. Lütfen bilgilerinizi kontrol ediniz</p>';

}else{

echo '<p class="'.$errorfieldpassword.'">'.$messagepassword.'</p>';
}
?>
</li>

<li>

<input type="checkbox" checked="checked" value="1" name="keepMeSignInOption">


<span class="rememberme"> Beni hatırla</span>  <label for="forgot" style="margin-left:130px;"><a href="">Şifremi unuttum</a></label>

<div class="sign-security">
Güvenliğiniz için, alışveriş sonrası çıkış yapmayı unutmayınız.
</div>
</li>
<li>

<div>


<?php echo form_submit(array('name'=> 'submit', 'class'=>'rc-button rc-button-submit'), 'GİRİŞ YAP');?>


</div>
</li>


</ul>

<!--</fieldset>-->


</div>
<div id="login_form_left">

<div class="signin_right_content">

<div class="sign-question">
Üye değil misiniz?
</div>
<p>
<a href="r" class="rc-button rc-button-green">Ücretsiz Kayıt Ol</a>

</div>


</div>
</div>






