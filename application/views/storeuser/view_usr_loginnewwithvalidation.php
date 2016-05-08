 <link rel="stylesheet" type="text/css" href="io_styles/myexformcss/form.css" />
    
        <script src="lib/jquery/jquery-1.3.2.js" type="text/javascript">
        <link rel="stylesheet" type="text/css" href="io_styles/myexformcss/form.css" />
        <script src="io_scripts/formcss/lib/jquery/jquery-1.3.2.js" type="text/javascript">
        </script>
        <script src="io_scripts/formjs/jquery.validate.js" type="text/javascript">
        </script>
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
		
<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#username").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Bu alan Bos birakilamaz"
                }); 
				
				jQuery("#username").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Kullanici adi en az 5 karakter olmalidir"
                });
                jQuery("#ValidNumber").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid number"
                });
                jQuery("#ValidInteger").validate({
                    expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
                    message: "Please enter a valid integer"
                });
                jQuery("#ValidDate").validate({
                    expression: "if (!isValidDate(parseInt(VAL.split('-')[2]), parseInt(VAL.split('-')[0]), parseInt(VAL.split('-')[1]))) return false; else return true;",
                    message: "Please enter a valid Date"
                });
                jQuery("#ValidEmail").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid Email ID"
                });
                jQuery("#password").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Bu alan Bos Birakilammaz"
                });
				jQuery("#password").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Sifreniz en az 6 karakterden olusmalidir"
                });
                jQuery("#ValidConfirmPassword").validate({
                    expression: "if ((VAL == jQuery('#ValidPassword').val()) && VAL) return true; else return false;",
                    message: "Confirm password field doesn't match the password field"
                });
                jQuery("#ValidSelection").validate({
                    expression: "if (VAL != '0') return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#ValidMultiSelection").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#ValidRadio").validate({
                    expression: "if (isChecked(SelfID)) return true; else return false;",
                    message: "Please select a radio button"
                });
                jQuery("#ValidCheckbox").validate({
                    expression: "if (isChecked(SelfID)) return true; else return false;",
                    message: "Please check atleast one checkbox"
                });
				jQuery('.AdvancedForm').validated(function(){
					alert("Use this call to make AJAX submissions.");
				});
            });
        </script>
    </head>
    <body>
      
	  
        <div id="tabs" class="Tabs">

<?php echo form_open(base_url().'l');  ?>
<fieldset><legend>Üye girişi</legend>
<ul>

<li>
<label for="username">Kullanıcı adın veya e-posta adresin</label>
<div>
<?php echo form_input(array('id'=> 'username', 'name'=>'username',  'value'=>set_value('username'),'size'=>"20",'tabindex'=>'1'));?>
</div>
<p class="<?php echo $errorfieldusername;?>"><?php echo $messageusername;?></p>
</li>
                   <li>
<label for="password">Şifren</label>
<div>
<?php echo form_password(array('id'=> "password",'type'=>"password", 'name'=>'password', 'value'=>set_value('password'), 'size'=>"20", 'tabindex'=>'2'));?>

</div>
<p class="<?php echo $errorfieldpassword;?>"><?php echo $messagepassword;?></p>
</li>
                 <!--   <tr>
                        <td>
                            Enter a valid Mobile Number 
                            <small>
                                (Eg: 9854398543)
                            </small>
                        </td>
                        <td>
                            <input type="text" name="Mobile" id="Mobile" />
                        </td>
                    </tr>-->
                  
<?php echo form_submit(array('name'=> 'submit', 'class'=>'orange'), 'Giriş yap');?>
                
            <div class="ValidXHTML">
                <a href="http://validator.w3.org/check?uri=referer" target="_blank"><img src="images/valid-xhtml.gif" alt="Valid XHTML 1.0 Transitional" border="0" /></a>
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
                var pageTracker = _gat._getTracker("UA-10628239-1");
                pageTracker._trackPageview();
            } 
            catch (err) {
            }
            /* ]]> */
        </script>
    </body>
</html>
