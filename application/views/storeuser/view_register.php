
 
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
	  
	
			$(function(){
			
			
				// Grab each form element
				$("label[title]").each(function(){
					$(this).append("<div class=\"infopop\">");	
					titletext = $(this).attr("title");
					$(this).removeAttr("title");
					$(".infopop",this).css({opacity:0}).html(titletext);
					$("input",this).focus(function(){
						// Mouseover
						
						if(this.id=="name" || this.id=="lastName" || this.id=="captcha")
						{
						
						}
		
						else{
						doFocus(this);
						}
					}).blur(function(){
					
					    
						// MouseOut
					
							if(this.id=="captcha"){
						
						
						 if($('#captcha').val()=="<?php echo $captchaval;?>"){
				         isGood(this);
						
                        						
						return true;
						 
						 }else{
						 
						 
						errtouse="captchaerr"; 
						reportErr(this,errmsg[errtouse]);
						
						
						return false; 
						
						  }
						}else{
						doBlur(this);
						}
					});
					
					$("select",this).focus(function(){
						// Mouseover
						
						if(this.id=="months" || this.id=="years" || this.id=="days")
						{
						
						}
						else{
						
						doFocus(this);
						}
					
					}).blur(function(){
					var masktouse = null;
				var mustmatch = null;
						// MouseOut
						var pStartDays = $('#days').val();
						var pStartMonths = $('#months').val();
						var pStartYears = $('#years').val();
                        if(pStartDays==0 || pStartMonths==0 || pStartYears==0){
						errtouse="datefielderr"; 
						
						
						reportErr(this,errmsg[errtouse]);
						
						
						return false; 
						}else{
					
						isGood(this);
						
						return true;
						}
					   
						//doBlur(this);
						
					});
				});
			});

			function doFocus(obj) {
				$(obj).addClass("active").parents("label").addClass("active").find(".infopop").animate({opacity:0.9,left:260},268);
			}
			
			function doBlur(obj) {
				if (validate(obj)) {
				    
					isGood(obj);
				}
			}
			
			function reportErr(obj, message) {
			
				$(obj).addClass("error").parents("label").removeClass("isgood").addClass("required").addClass("error").find(".infopop").html(message).addClass("errorpop").animate({opacity:0.9,left:260},268);
			}
			
			function isGood(obj) {
			    
				$(obj).removeClass("error").removeClass("active").parents("label").addClass("isgood").removeClass("error").removeClass("active").find(".infopop").removeClass("errorpop").animate({opacity:0,left:268},500);
			} 	

			function validate(obj) {
				// Extend jQuery object to include Regular expression masks assigned to properties
				mask = jQuery.extend({namemask: /^[a-z\+ü+Ü+ğ+Ğ+ı+İ+ö+Ö+ç+Ç+ş+Ş.\s-]{2,}$/i,lastnamemask: /^[a-z\+ü+Ü+ğ+Ğ+ı+İ+ö+Ö+ç+Ç+ş+Ş.\s-]{2,}$/i,phonemask: /^[0-9\(\)\+\.\s-]{8,}$/i,passwordmask: /^\w{5,}$/, emailmask:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/,usernamemask:/^[a-z0-9\.\s-]{5,}$/i});
				// Extend jQuery object to include error messages assigned to properties
				errmsg = jQuery.extend({nameerr:"Ad bilgisi en az 2 harften oluşmalıdır.",lastnameerr:"Soyad bilgisi en az 2 harften oluşmalıdır.",phoneerr: "Include dialling code",passworderr:"Minimum 6 karakterden oluşmalı,<br/> harf ve rakam içermelidir.",emailerr:"Geçerli bir e-posta adresi giriniz.",matcherr: "Şifreniz tekrarı ile uyuşmuyor.",datefielderr:"Geçerli bir doğum tarihi giriniz.",usernameerr:"Kullanıcı adı girmediniz.",captchaerr:"Güvenlik kodunu yanlış girdiniz."});
			    
				// Set up variables to hold details of which mask to use and whether the field should match another field
				var masktouse = null;
				var mustmatch = null;
				// Determine the type of mask we're going to validate against
				switch(obj.name) {
					case "name": 		masktouse="namemask"; 		errtouse="nameerr"; 	break;
					case "lastName": 		masktouse="lastnamemask"; 		errtouse="lastnameerr"; 	break;
					case "phone": 		masktouse="phonemask"; 			errtouse="phoneerr"; 		break;
					case "username": 	masktouse="usernamemask"; 		errtouse="usernameerr"; 	break;
					case "email": 		masktouse="emailmask"; 			errtouse="emailerr"; 		break;
					case "date": 		masktouse="datefieldmask"; 			errtouse="datefielderr"; 		break;
					case "password": 	masktouse="passwordmask"; 		errtouse="passworderr"; 	mustmatch="password_conf"; 	break;
					case "password_conf": masktouse="passwordmask"; 		errtouse="passworderr"; 	mustmatch="password"; 		break;
					case "captcha": 		errtouse="captchaerr";  break;
				}
				// Check that the element is a required field before validating against it.
				if($(obj).parents("label").hasClass("required") && masktouse) {
					// Set up a quick way of accessing the object we're validating
					pointer = $(obj);
					// Test the value of the field against the Regular Expression
					if (mask[masktouse].test(pointer.val())) {
						// The field validated successfully!
						
						// Check to see if the field needs to match another field in the form
						if (mustmatch) {
							// It does need to match, so grab the object it needs to match
							matchobj = $("#"+mustmatch);
							if (matchobj.val()!='' && matchobj.val()!=pointer.val()) {
								// The fields don't match, so report an error on both of them
								reportErr(obj,errmsg["matcherr"]);	
								reportErr(matchobj,errmsg["matcherr"]);
							}
							else {
								// Either the fields match, or the other field hasn't been completed yet
								// If the other field has been completed, call the isGood function to clear any error message showing
								if (matchobj.val()!='') { isGood(matchobj);}
								
								return true;
							}
						}
						else {
							// No match is required, so return true - validation passed!
							
							return true;
						} 
					}
					else { 
						// The field failed to validate against the Regular Expression
						reportErr(obj,errmsg[errtouse]);
						
						return false; 
					}
				} 
				else {	
					// This isn't a required field, so we won't validate it against anything			
				
					return true;
				}
			}
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


<img src="<?php echo base_url("io_images/design_images/logo.png");?>" alt="Logo" width="50" height="auto" style="margin-left:70px; margin-top:-15px;"/><div id="logo_major">ORAKLI ECZANESI</div>

</div>

<!--<span class="fancy_text_regular">Üyelik formunu eksiksizce doldurarak üyelik hizmetlerinden hemen yararlanmaya başlayabilirsiniz.</span>-->
<div id="register_form">



<?php
echo form_open(base_url(). 'r');
$username=array(

'name'=> 'username',
'id'=> 'username',
'value'=> set_value('username'),
'class'=>'text'
);
$name=array(

'name'=> 'name',
'id'=> 'name',
'value'=> set_value('name'),
'class'=>'text'
);

$lastName=array(

'name'=> 'lastName',
'id'=> 'lastName',
'value'=> set_value('lastName'),
'class'=>'text'
);
$email=array(

'name'=> 'email',
'id'=> 'email',
'value'=> set_value('email'),
'class'=>'text'
);
$password=array(

'name'=> 'password',
'id'=> 'password',
'value'=> '',
'class'=>'text'
);


$password_conf=array(

'name'=> 'password_conf',
'id'=> 'password_conf',
'value'=> '',
'class'=>'text'
);
$optionsdays = array(
'0'=>'Gün',
'1'=>'1',
'2'=>'2',
'3'=>'3',
'4'=>'4',
'5'=>'5',
'6'=>'6',
'7'=>'7',
'8'=>'8',
'9'=>'9',
'10'=>'10',
'11'=>'11',
'12'=>'12',
'13'=>'13',
'14'=>'14',
'15'=>'15',
'16'=>'16',
'17'=>'17',
'18'=>'18',
'19'=>'19',
'20'=>'20',
'21'=>'21',
'22'=>'22',
'23'=>'23',
'24'=>'24',
'25'=>'25',
'26'=>'26',
'27'=>'27',
'28'=>'28',
'29'=>'29',
'30'=>'30',
'31'=>'31',	  );

$optionsmonths= array(
'0'=>'Ay',
'ocak'=>'Ocak',
'subat'=>'Şubat',
'mart'=>'Mart',
'nisan'=>'Nisan',
'mayis'=>'Mayıs',
'haziran'=>'Haziran',
'temmuz'=>'Temmuz',
'agustos'=>'Ağustos',
'eylul'=>'Eylül',
'ekim'=>'Ekim',
'kasim'=>'Kasım',
'aralik'=>'Aralık',
  );
  
  
$optionsyears= array(
'0'=>'Yıl',
'1996'=>'1996',
'1995'=>'1995',
'1994'=>'1994',
'1993'=>'1993',
'1992'=>'1992',
'1991'=>'1991',
'1990'=>'1990',
'1989'=>'1989',
'1988'=>'1988',
'1987'=>'1987',
'1986'=>'1986',
'1985'=>'1985',
'1984'=>'1984',
'1983'=>'1983',
'1982'=>'1982',
'1981'=>'1981',
'1980'=>'1980',
'1979'=>'1979',
'1978'=>'1978',
'1977'=>'1977',
'1976'=>'1976',
'1975'=>'1975',
'1974'=>'1974',
'1973'=>'1973',
'1972'=>'1972',
'1971'=>'1971',
'1970'=>'1970',
'1969'=>'1969',
'1968'=>'1968',
'1967'=>'1967',
'1966'=>'1966',
'1965'=>'1965',
'1964'=>'1964',
'1963'=>'1963',
'1962'=>'1962',
'1961'=>'1961',
'1960'=>'1960',
'1959'=>'1959',
'1958'=>'1958',
'1957'=>'1957',
'1956'=>'1956',
'1955'=>'1955',
'1954'=>'1954',
'1953'=>'1953',
'1952'=>'1952',
'1951'=>'1951',
'1950'=>'1950',
'1949'=>'1949',
'1948'=>'1948',
'1947'=>'1947',
'1946'=>'1946',
'1945'=>'1945',
'1944'=>'1944',
'1943'=>'1943',
'1942'=>'1942',
'1941'=>'1941',
'1940'=>'1940',
'1939'=>'1939',
'1938'=>'1938',
'1937'=>'1937',
'1936'=>'1936',
'1935'=>'1935',
'1934'=>'1934',
'1933'=>'1933',
'1932'=>'1932',
'1931'=>'1931',
'1930'=>'1930',
'1929'=>'1929',
'1928'=>'1928',
'1927'=>'1927',
'1926'=>'1926',
'1925'=>'1925',
'1924'=>'1924',
'1923'=>'1923',
'1922'=>'1922',
'1921'=>'1921',
'1920'=>'1920',
'1919'=>'1919',
'1918'=>'1918',
'1917'=>'1917',
'1916'=>'1916',
'1915'=>'1915',
'1914'=>'1914',
'1913'=>'1913',
'1912'=>'1912',
'1911'=>'1911',
'1910'=>'1910',


  );

$captcha=array(

'name'=> 'captcha',
'id'=> 'captcha',
'value'=> '',
'class'=>'text'
);


?>
<div id="login-form">
<div id="login_form_left_long">


		
		    <label class="label_name_reg">Ad<span class="asterix_red">*</span></label>
			<label class="required" for="name" title="1"><?php echo form_input($name);?></label>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('name'); ?></div>
		
			
			<label class="label_name_reg">Soyad<span class="asterix_red">*</span></label>
			<label class="required" for="lastName" title="1"><?php echo form_input($lastName);?></label>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('lastName'); ?></div>
			
			
			<label class="label_name_reg">E-posta<span class="asterix_red">*</span></label>
			<div style="hegiht:300px;"><label class="required" for="email" title="<div class='email-popup'>Üyelik aktivasyonunuz e-posta adresinize <br/>gönderilecektir,e-posta adresinizin <br/>aktif olduğundan emin olunuz.</div>"><?php echo form_input($email);?></label></div>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('email'); ?></div>
		
		    <label class="label_name_reg">Kullanıcı Adı<span class="asterix_red">*</span></label>
		    <label class="required" for="username" title="<div class='username-popup'> Türkçe karakter ve boşluk kullanmayınız !</div>"><?php echo form_input($username);?></label>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('username'); ?></div>
			
			<label class="label_name_reg">Şifre<span class="asterix_red">*</span></label>
			<label class="required" for="password" title="<div class='password-popup'> Şifrenizi giriniz.</div>"><?php echo form_password($password);?></label>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('password'); ?></div>
			
			  <label class="label_name_reg">Şifre(Tekrar)<span class="asterix_red">*</span></label>
			<label class="required" for="verpassword" title="<div class='password-popup'> Şifrenizi doğrulayınız.</div>"><?php echo form_password($password_conf);?></label>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('password_conf'); ?></div>
			<!--
			<label class="required" for="date" title="1">
   
			<table class="dropdown-date">

<tr>
<td style="width:200px;"><span class="form-label">Doğum tarihi	</td>

<td style="width:20px;">
		<?php $days= array('1', '0');
      $iddays = 'id="days"';
echo form_dropdown('days', $optionsdays, '0',$iddays);?>  </td>
	
		
	<td style="width:20px;">	<?php $months= array('1', '0');
$idmonths = 'id="months"';
echo form_dropdown('months', $optionsmonths, '0',$idmonths);?>	</td>
		
		
		
			<td><?php $years= array('1', '0');
$idyears = 'id="years"';
echo form_dropdown('years', $optionsyears, '0',$idyears);?>	</td>
	</tr>
		</table></label>
		
		
	
<label for="place">
   
			<table class="dropdown-place">

<tr>
<td style="width:170px;"><span class="form-label">Ülke/Şehir</span>	</td>

<td style="width:100px;">
	<?php echo form_dropdown('country',$optionsyears,'0','id="country"');?>
	<script language="javascript">
 
populateCountries("country", "state");

 </script> </td>
	
<td>
 <?php echo form_dropdown('state',$optionsyears, '0','id="state"');?>
 <script language="javascript">
 
populateCountries("country", "state");

 </script>
 </td>
 </tr>
 </table>
 </label>
 
 <label for="place">
 <table class="radio-gender">
<tr>
<td style="width:200px;"><span class="form-label">Cinsiyet</span>	</td>
<td style="width:50px;"><span class="form-label">Erkek</span></td>
<td><input class="ioradio" type="radio" name="myradio" value="1" <?php echo set_radio('myradio', '1'); ?>/> </td>
<td style="width:30px;"></td>
<td style="width:50px;"><span class="form-label">Kadın</span></td>
<td><input class="ioradio" type="radio" name="myradio" value="2" <?php echo set_radio('myradio', '2'); ?> /> </td>

 </tr>
 </table>
 </label>-->
 		 <label class="label_name_reg">Güvenlik kodu<span class="asterix_red">*</span></label>
        	
		
		<div id="securtiy_captcha">
	<label class="required" for="captcha" title="1">
		
		<table><tr><td>
		<?php echo $image; ?>
		
		
	</td><td>
		
		<?php echo form_input($captcha);?>
     </td></tr></table>
		</label>
	
		</div>
			<div class="<?php echo $error_server_val; ?>"><?php echo form_error('captcha'); ?></div>
		<?php /*echo validation_errors();*/?>
		<?php /*echo form_error('email');*/ ?>
		
		
		<div class="note_asterix" style="color:#666; padding:10px; width:200px;  font-size:11px;"><strong>Not:</strong> Kırmızı işaretli <!--<img src="<?php echo base_url("io_images/design_images/jqueryvalform/asterix.gif");?>" alt="Zorunlu işaret" width="10" height="9" style="margin-left:70px; margin-top:-15px;"/>--><span class="asterix_red">*</span> alanlar zorunludur.
		</div>
         
 <label class="uyelik-sozlesme">
 
<strong>Üyelik kaydımı oluşturarak:</strong></br>

<span style="color:#3079ED;">Üyelik Sözleşmesi Koşulları</span>'nı ve <span style="color:#3079ED;">Gizlilik Politikası</span>'nı kabul ediyorum.

 </label>

 
		
			
			
			<label for="formsubmit" class="nocontent">
             
			<?php echo form_submit(array('name'=>'register', 'class'=>'rc-button rc-button-submit', 'style'=>'width:200px;'),'Kayıt Ol');?>
            
			</label>
			
		
				
		<p></p>
</div>
<div id="login_form_right_long">
<div class="signin_right_content">

<div class="sign-question">
Zaten üyeyim
</div>
<p>
<a href="ul" class="rc-button rc-button-green">Giriş yap</a>

</div>





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



<?php
echo form_close();

 ?>



</div>
</div>

