/** User Balance */
$(document).ready(function(){
    $("#getbalance").load("/dashboard/update/balances");
   setInterval(function() {
       $("#getbalance").load("/dashboard/update/balances");
   }, 30000);
});


/** Crypto Data */
$(document).ready(function(){
    $("#getcryptos").load("/dashboard/update/cryptos");
   setInterval(function() {
       $("#getcryptos").load("/dashboard/update/cryptos");
   }, 30000);
});



/** Crypto balance single */
$(document).ready(function(){
    $("#getcryptobalance").load("/dashboard/update/cryptos/balance");
   setInterval(function() {
       $("#getcryptobalance").load("/dashboard/update/cryptos/balance");
   }, 1000);
});


/** Crypto balance single */
$(document).ready(function(){
    $("#getbalanceall").load("/dashboard/update/cryptos/balance/all");
   setInterval(function() {
       $("#getbalanceall").load("/dashboard/update/cryptos/balance/all");
   }, 50000);
});


/** Crypto Mining Assets */
$(document).ready(function(){
    $("#cryptoassetsupdate").load("/dashboard/crypto/mining/assets/update");
   setInterval(function() {
       $("#cryptoassetsupdate").load("/dashboard/crypto/mining/assets/update");
   }, 1000);
});

/** Crypto Mining Assets Short Infos */
$(document).ready(function(){
    $("#cryptoassetsupdateshortinfos").load("/dashboard/crypto/mining/assets/update/shortinfo");
   setInterval(function() {
       $("#cryptoassetsupdateshortinfos").load("/dashboard/crypto/mining/assets/update/shortinfo");
   }, 1000);
});



/** Cryptos */
$(document).ready(function(){
    $("#cryptosall").load("/dashboard/update/cryptos/all");
   setInterval(function() {
       $("#cryptosall").load("/dashboard/update/cryptos/all");
   }, 30000);
});




/** Cryptos Front */
$(document).ready(function(){
    $("#cryptosallfront").load("/update/cryptos/all");
   setInterval(function() {
       $("#cryptosallfront").load("/update/cryptos/all");
   }, 30000);
});


/** Cryptos Front */
$(document).ready(function(){
    $("#admincryptosupdate").load("/admin/update/cryptos/balance/all");
   setInterval(function() {
       $("#admincryptosupdate").load("/admin/update/cryptos/balance/all");
   }, 30000);
});



