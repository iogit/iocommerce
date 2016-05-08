var o_fields = {
'p_fullname' : {'l':'Adýnýz ve Soyadýnýz','r':'true','mn':3,'mx':255},
'p_email' : {'l':'Email','f':'email','t':'p_email','m':'p_email2','mn':'5','mx':'60','r':'true'},
'p_email2' : {'l':'Email Tekrar','f':'email','t':'p_email2','mn':'5','mx':'60','r':'true'},
's_name' : {'l':'Teslimat Ýsim','r':'true','mn':1,'mx':60},
's_address' : {'l':'Teslimat Adresi','r':'true','mn':5,'mx':200},
's_phone' : {'l':'Teslimat Telefon No.','f':'integer','r':'true','mn':7,'mx':20},
's_cell' : {'l':'Cep Telefonu','f':'integer','mn':7,'mx':20},
'b_name' : {'l':'Adý Soyadý & Ticari Ünvaný','mn':1,'mx':80},
'b_address' : {'l':'Fatura Adresi','r':'true','mn':5,'mx':200},
'b_phone' : {'l':'Fatura Telefon','f':'integer','r':'true','mn':7,'mx':20},
'b_city' : {'l':'Fatura Þehir','r':'true'},
's_city' : {'l':'Teslimat Þehir','r':'true'},
'b_cell' : {'l':'Cep Telefonu','r':'true','mn':7,'mx':20},
'b_district' : {'l':'Ýlçe','mn':1,'mx':30},
's_district' : {'l':'Ýlçe','mn':1,'mx':30}
};
o_config = {
'to_disable' : ['Submit'],
'alert' : 1
};
function controlForm(){
var faturaturu = $A(document.getElementsByName("b_type"));
faturaturu.each(function (s){
if(s.checked==true){
fatura = s.value;
}
})
if(fatura== '0'){
o_fields['b_tcId'] = {'l':'T.C Kimlik No','f':'integer','mn':11,'mx':11}; var v = new validator('orderForm', o_fields, o_config);
if(!v.exec()) return false;
}
if(fatura =='1'){
o_fields['b_tcId'] = {'l':'T.C Kimlik No','f':'integer','mn':11,'mx':11};
o_fields['b_taxId'] = {'l':'Vergi No','f':'integer','r':'true'};
o_fields['b_taxPlace']= {'l':'Vergi Dairesi','mn':1,'mx':50,'r':'true'};
var v = new validator('orderForm', o_fields, o_config);
if(!v.exec()) return false;
}
}
function GiftWrap(status){
if(status==1)
$('gift_div').show()
else
$('gift_div').hide()
}
function calcShipping(){
var sCityVal = 0;
if(jQuery("#s_country").val()==1){
sCityVal = parseInt(jQuery("#s_city").val());
}
getShippingSummary(jQuery("#s_company").val(), sCityVal,'target=shippingSummary,preload=preloader');
getPaymentAtDeliveryInfo(jQuery("#s_company").val(),'target=payAtDeliveryInfo,preload=preloader');
getMinShipping(jQuery("#s_company").val(),'target=minShipping,preload=preloader');
}
function getShippingCity(){
document.getElementById('s_citywarn').innerHTML="*";
document.getElementById('b_citywarn').innerHTML="*";
getShippingSummary(jQuery("#s_company").val(), $('s_city').value,'target=shippingSummary,preload=preloader');
}
