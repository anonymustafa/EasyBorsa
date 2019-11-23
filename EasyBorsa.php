<?php

class EasyBorsa
{

    private $ch;
    private $content;
    private $URI;
    private $siteNum;


    function __construct($site = 'paribu')
    {



        if ($site == 'paribu') {

            $this->URI = 'https://www.paribu.com/ticker';
            $this->siteNum = 1;
        } elseif ($site == 'btcturk') {

            $this->URI = 'https://www.btcturk.com/api/ticker';
            $this->siteNum = 2;
        } elseif ($site == 'kraken') {

            $this->URI = 'https://api.kraken.com/0/public/OHLC?pair=';
            $this->siteNum = 3;
        } elseif ($site == 'bitstamp') {

            $this->URI = 'https://www.bitstamp.net/api/v2/ticker/';
            $this->siteNum = 4;
        } elseif ($site == 'binance') {

            $this->URI = 'https://api.binance.com/api/v3/ticker/price';
            $this->siteNum = 5;
        } elseif ($site == 'doviz') {

            $this->URI = 'https://www.doviz.gen.tr/doviz_json.asp';
            $this->siteNum = 6;
        } else
            return;
    }

    function curl()
    {


        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->URI);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $content = trim(curl_exec($this->ch));
        curl_close($this->ch);

        $this->content = $content;
    }


    function price($coin = 'ETH', $moneyType = 'TL')
    {



        if ($this->siteNum == 1) {



            $this->curl();
            $content = json_decode($this->content, true);

            if ($coin == 'ETH' && $moneyType == 'TL')
                return $content['ETH_TL']['last'];




            else if ($coin == 'ETH' && $moneyType == 'USD') {

                $ethTl = $content['ETH_TL']['last'];
                $doviz = new BorsaBot('doviz');

                return $ethTl / ($doviz->get('dolar'));
            }

            if ($coin == 'BTC' && $moneyType == 'TL')
                return $content['BTC_TL']['last'];




            else if ($coin == 'BTC' && $moneyType == 'USD') {

                $ethTl = $content['BTC_TL']['last'];
                $doviz = new BorsaBot('doviz');

                return $ethTl / ($doviz->get('dolar'));
            }

            if ($coin == 'XRP' && $moneyType == 'TL')
                return $content['XRP_TL']['last'];




            else if ($coin == 'XRP' && $moneyType == 'USD') {

                $ethTl = $content['XRP_TL']['last'];
                $doviz = new BorsaBot('doviz');

                return $ethTl / ($doviz->get('dolar'));
            }


            if ($coin == 'USDT' && $moneyType == 'TL')
                return $content['USDT_TL']['last'];




            else if ($coin == 'USDT' && $moneyType == 'USD') {

                $ethTl = $content['USDT_TL']['last'];
                $doviz = new BorsaBot('doviz');

                return $ethTl / ($doviz->get('dolar'));
            } else if ($coin == 'LTC' && $moneyType == 'TL')
                return $content['LTC_TL']['last'];

            else if ($coin == 'LTC' && $moneyType = 'USD') {
                $ltcTl = $content['LTC_TL']['last'];
                $doviz = new BorsaBot('doviz');
                return $ltcTl / ($doviz->get('dolar'));
            }
        } elseif ($this->siteNum == 2) {


            $this->curl();
            $content = json_decode($this->content, true);

            if ($coin == 'ETH' && $moneyType == 'TL')
                return $content[1]['last'];


            else if ($coin == 'ETH' && $moneyType == 'USD') {
                $ethTl = $content[1]['last'];
                $doviz = new BorsaBot('doviz');
                return $ethTl / ($doviz->get('dolar'));
            } else if ($coin == 'LTC' && $moneyType == 'TL')
                return $content[3]['last'];

            else if ($coin == 'LTC' && $moneyType = 'USD') {
                $ltcTl = $content[3]['last'];
                $doviz = new BorsaBot('doviz');
                return $ltcTl / ($doviz->get('dolar'));
            } else if ($coin == 'BTC' && $moneyType == 'TL')
                return $content[0]['last'];

            else if ($coin == 'BTC' && $moneyType = 'USD') {
                $ltcTl = $content[0]['last'];
                $doviz = new BorsaBot('doviz');
                return $ltcTl / ($doviz->get('dolar'));
            } else if ($coin == 'XRP' && $moneyType == 'TL')
                return $content[2]['last'];

            else if ($coin == 'XRP' && $moneyType = 'USD') {
                $ltcTl = $content[2]['last'];
                $doviz = new BorsaBot('doviz');
                return $ltcTl / ($doviz->get('dolar'));
            } else if ($coin == 'USDT' && $moneyType == 'TL')
                return $content[4]['last'];

            else if ($coin == 'USDT' && $moneyType = 'USD') {
                $ltcTl = $content[4]['last'];
                $doviz = new BorsaBot('doviz');
                return $ltcTl / ($doviz->get('dolar'));
            }
        } elseif ($this->siteNum == 3) {
            if ($coin != 'BTC')
                $this->URI .= $coin . 'USD';

            $this->curl();
            $content = json_decode($this->content, true);



            if ($coin == 'ETH' && $moneyType == 'TL') {
                $ethUsd = $content['result']['XETHZUSD'][0][1];
                $doviz = new BorsaBot('doviz');

                return $ethUsd * ($doviz->get('dolar'));
            } else if ($coin == 'ETH' && $moneyType == 'USD')
                return $content['result']['XETHZUSD'][0][1];







            else if ($coin == 'LTC' && $moneyType == 'TL') {
                $ltcUsd = $content['result']['XLTCZUSD'][0][1];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'LTC' && $moneyType == 'USD')
                return $content['result']['XLTCZUSD'][0][1];


            else if ($coin == 'XRP' && $moneyType == 'TL') {
                $ltcUsd = $content['result']['XXRPZUSD'][0][1];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'XRP' && $moneyType == 'USD')
                return $content['result']['XXRPZUSD'][0][1];


            else if ($coin == 'USDT' && $moneyType == 'TL') {
                $ltcUsd = $content['result']['USDTZUSD'][0][1];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'USDT' && $moneyType == 'USD')
                return $content['result']['USDTZUSD'][0][1];




            else if ($coin == 'BTC' && $moneyType == 'TL') {
                $this->URI .= 'XBTUSD';

                $this->curl();
                $content = json_decode($this->content, true);
                $ltcUsd = $content['result']['XXBTZUSD'][0][1];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'BTC' && $moneyType == 'USD') {

                $this->URI .= 'XBTUSD';


                $this->curl();
                $content = json_decode($this->content, true);
                return $content['result']['XXBTZUSD'][0][1];
            }
        } elseif ($this->siteNum == 4) {

            $this->URI .= strtolower($coin) . 'usd';

            $this->curl();
            $content = json_decode($this->content, true);

            if ($coin == 'ETH' && $moneyType == 'TL') {
                $ethUsd = $content['last'];
                $doviz = new BorsaBot('doviz');

                return $ethUsd * ($doviz->get('dolar'));
            } else if ($coin == 'ETH' && $moneyType == 'USD')
                return $content['last'];




            else if ($coin == 'BTC' && $moneyType == 'TL') {
                $ltcUsd = $content['last'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'BTC' && $moneyType == 'USD')
                return $content['last'];


            else if ($coin == 'XRP' && $moneyType == 'TL') {
                $ltcUsd = $content['last'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'XRP' && $moneyType == 'USD')
                return $content['last'];







            else if ($coin == 'LTC' && $moneyType == 'TL') {
                $ltcUsd = $content['last'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'LTC' && $moneyType == 'USD')
                return $content['last'];
        } elseif ($this->siteNum == 5) {



            $this->curl();
            $content = json_decode($this->content, true);

            if ($coin == 'ETH' && $moneyType == 'TL') {
                $ethUsd = $content[317]['price'];
                $doviz = new BorsaBot('doviz');

                return $ethUsd * ($doviz->get('dolar'));
            } else if ($coin == 'ETH' && $moneyType == 'USD')
                return $content[317]['price'];


            else if ($coin == 'BTC' && $moneyType == 'TL') {
                $ltcUsd = $content[11]['price'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'BTC' && $moneyType == 'USD') {
                return $content[11]['price'];
            } else if ($coin == 'XRP' && $moneyType == 'TL') {
                $ltcUsd = $content[300]['price'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'XRP' && $moneyType == 'USD') {
                return $content[300]['price'];
            } else if ($coin == 'LTC' && $moneyType == 'TL') {
                $ltcUsd = $content[190]['price'];
                $doviz = new BorsaBot('doviz');

                return $ltcUsd * ($doviz->get('dolar'));
            } else if ($coin == 'LTC' && $moneyType == 'USD') {
                return $content[190]['price'];
            }
        } else {
            return array('symbol' => 'ERROR', 'price' => 'ERROR');
        }
    }

    function get($type = 'dolar')
    {
        $this->curl();

        $content = json_decode($this->content, true);

        return $content[$type];
    }
}
