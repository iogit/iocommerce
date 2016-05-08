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
<!--<fieldset><legend>Üye giriþi</legend>-->
<div class="signin-signin">ÜYE GÝRÝÞÝ</div>
<ul>

<li>
<label for="username">Kullanýcý Adý veya E-posta Adresi</label>
<div>
<?php echo form_input(array('id'=> 'username', 'name'=>'username',  'value'=>set_value('username'), 'class'=>$fieldcheckname,'size'=>"20",'tabindex'=>'1'));?>
</div>
<p class="<?php echo $errorfieldusername;?>"><?php echo $messageusername;?></p>
</li>

<li>
<label for="password">Þifre</label>
<div>
<?php echo form_password(array('id'=> "password",'type'=>"password", 'name'=>'password', 'value'=>set_value('password'), 'class'=>$fieldcheckpass, 'size'=>"20", 'tabindex'=>'2'));?>

</div>
<?php 

//if($this->session->flashdata('login_error'))
if($loginerror!="")
{
echo '<p class="'.$errorfieldpassword.'"> Geçersiz Kullanýcý Adý ve/veya Þifre. Lütfen bilgilerinizi kontrol ediniz</p>';

}else{

echo '<p class="'.$errorfieldpassword.'">'.$messagepassword.'</p>';
}
?>
</li>

<li>

<input type="checkbox" checked="checked" value="1" name="keepMeSignInOption">


<span class="rememberme"> Beni hatýrla</span>  <label for="forgot" style="margin-left:130px;"><a href="">Þifremi unuttum</a></label>

<div class="sign-security">
Güvenliðiniz için, alýþveriþ sonrasý çýkýþ yapmayý unutmayýnýz.
</div>
</li>
<li>

<div>


<?php echo form_submit(array('name'=> 'submit', 'class'=>'rc-button rc-button-submit'), 'GÝRÝÞ YAP');?>


</div>
</li>


</ul>

<!--</fieldset>-->


</div>
<div id="login_form_left">

<div class="signin_right_content">

<div class="sign-question">
Üye deðil misiniz?
</div>
<p>
<a href="" class="rc-button rc-button-green">Ücretsiz Kayýt Ol</a>

</div>
<div id="login_form_left">
<div class="Tabs">
            <a href="../">Simple Demo</a>
            <a href="#" class="Active">Advanced Demo</a>
        </div>
        <div class="TabBody">
            <h1>jQuery Live Form Validation Advanced Demo</h1>
            <form action="" method="post" class="AdvancedForm">
                <table cellpadding="3" cellspacing="2">
                    <tr>
                        <td>
                            Enter a Required Field
                        </td>
                        <td>
                            <input type="text" name="ValidField" id="ValidField" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Enter a Number
                        </td>
                        <td>
                            <input type="text" name="ValidNumber" id="ValidNumber" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Enter an Integer
                        </td>
                        <td>
                            <input type="text" name="ValidInteger" id="ValidInteger" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Enter a Date (MM-DD-YYYY)
                        </td>
                        <td>
                            <input type="text" name="ValidDate" id="ValidDate" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Enter Email ID
                        </td>
                        <td>
                            <input type="text" name="ValidEmail" id="ValidEmail" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input type="password" name="ValidPassword" id="ValidPassword" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Confirm Password
                        </td>
                        <td>
                            <input type="password" name="ValidConfirmPassword" id="ValidConfirmPassword" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Make a selection
                        </td>
                        <td>
                            <select name="ValidSelection" id="ValidSelection">
                                <option value="0">Make a Selection</option>
                                <option value="Option 1">Option 1</option>
                                <option value="Option 2">Option 2</option>
                                <option value="Option 3">Option 3</option>
                                <option value="Option 4">Option 4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Make a multi-selection
                        </td>
                        <td>
                            <select name="ValidMultiSelection" id="ValidMultiSelection" multiple="multiple">
                                <option value="Option 1">Option 1</option>
                                <option value="Option 2">Option 2</option>
                                <option value="Option 3">Option 3</option>
                                <option value="Option 4">Option 4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Select a Radio Button
                        </td>
                        <td>
                            <span id="ValidRadio" class="InputGroup">
                                <label for="ValidRadio_1">
                                    <input type="radio" name="ValidRadio" id="ValidRadio_1" value="1" />Radio Button 1
                                </label>
                                <br/>
                                <label for="ValidRadio_2">
                                    <input type="radio" name="ValidRadio" id="ValidRadio_2" value="2" />Radio Button 2
                                </label>
                                <br/>
                                <label for="ValidRadio_3">
                                    <input type="radio" name="ValidRadio" id="ValidRadio_3" value="3" />Radio Button 3
                                </label>
                                <br/>
                                <label for="ValidRadio_4">
                                    <input type="radio" name="ValidRadio" id="ValidRadio_4" value="4" />Radio Button 4
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Select a Checkbox Button
                        </td>
                        <td>
                            <span id="ValidCheckbox" class="InputGroup">
                                <label for="ValidCheckbox_1">
                                    <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_1" value="1" />Checkbox 1
                                </label>
                                <br/>
                                <label for="ValidCheckbox_2">
                                    <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_2" value="2" />Checkbox 2
                                </label>
                                <br/>
                                <label for="ValidCheckbox_3">
                                    <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_3" value="3" />Checkbox 3
                                </label>
                                <br/>
                                <label for="ValidCheckbox_4">
                                    <input type="checkbox" name="ValidCheckbox" id="ValidCheckbox_4" value="4" />Checkbox 4
                                </label>
                                <br/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" value="Submit" id="FormSubmit" style="background: #EFEFEF;"/>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="ValidXHTML">
                <a href="http://validator.w3.org/check?uri=referer" target="_blank"><img src="../images/valid-xhtml.gif" alt="Valid XHTML 1.0 Transitional" border="0" /></a>
            </div>
        </div>
        <script type="text/javascript">
            /* <![CDATA[ */
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
            /* ]]> */
        </script>
        <script type="text/javascript">
            /* <![CDATA[ */
            try {
                var pageTracker = _gat._getTracker("UA-47185423-1");
                pageTracker._trackPageview();
            } 
            catch (err) {
            }
            /* ]]> */
        </script>


</div>

</div>
</div>






