<?php
include "EasyBorsa.php";

$borsaBot= new EasyBorsa('paribu'); /*  paribu , btcturk , kraken , bitstamp , binance , default = paribu */
print_r( $borsaBot->price('BTC','TL'));  /* ('LTC','TL') , ('LTC','USD') , ('ETH','TL') , ('ETH','USD') , ('BTC','TL') ,  ('BTC','USD') , ('XRP','TL') , ('XRP','USD') , ('USDT','TL') , ('USDT','USD') NOT: (USDT=TETHER bitstamp,binanse dışındaki tüm borsalarda çalışır...) default = ('ETH','TL') */

echo "<hr/>";

$doviz= new EasyBorsa('doviz'); 
echo $doviz->get('dolar'); /* dolar , euro , dolareuro , eurodolar */





?>







