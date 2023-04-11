<?php

	namespace App\Traits;

    trait NumberToWord
    {
        public function numtowords($num, $prefix, $surfix, $prefix_position, $surfix_position)
        {
            //    dd($prefix_position);
            $decones = [
                        '01' => 'One',
                        '02' => 'Two',
                        '03' => 'Three',
                        '04' => 'Four',
                        '05' => 'Five',
                        '06' => 'Six',
                        '07' => 'Seven',
                        '08' => 'Eight',
                        '09' => 'Nine',
                        10 => 'Ten',
                        11 => 'Eleven',
                        12 => 'Twelve',
                        13 => 'Thirteen',
                        14 => 'Fourteen',
                        15 => 'Fifteen',
                        16 => 'Sixteen',
                        17 => 'Seventeen',
                        18 => 'Eighteen',
                        19 => 'Nineteen',
                        ];
            // $ones = [
            //             0 => ' ',
            //             1 => 'One',
            //             2 => 'Two',
            //             3 => 'Three',
            //             4 => 'Four',
            //             5 => 'Five',
            //             6 => 'Six',
            //             7 => 'Seven',
            //             8 => 'Eight',
            //             9 => 'Nine',
            //             10 => 'Ten',
            //             11 => 'Eleven',
            //             12 => 'Twelve',
            //             13 => 'Thirteen',
            //             14 => 'Fourteen',
            //             15 => 'Fifteen',
            //             16 => 'Sixteen',
            //             17 => 'Seventeen',
            //             18 => 'Eighteen',
            //             19 => 'Nineteen',
            //             ];
            // $tens = [
            //             0 => '',
            //             2 => 'Twenty',
            //             3 => 'Thirty',
            //             4 => 'Forty',
            //             5 => 'Fifty',
            //             6 => 'Sixty',
            //             7 => 'Seventy',
            //             8 => 'Eighty',
            //             9 => 'Ninety',
            //             ];
            // $hundreds = [
            //             'Hundred',
            //             'Thousand',
            //             'Million',
            //             'Billion',
            //             'Trillion',
            //             'Quadrillion',
            //             ]; //limit t quadrillion

$ones = array(
    0 =>"Zero",
    1 => "One",
    2 => "Two",
    3 => "Three",
    4 => "Four",
    5 => "Five",
    6 => "Six",
    7 => "Seven",
    8 => "Eight",
    9 => "Nine",
    10 => "Ten",
    11 => "Eleven",
    12 => "Twelve",
    13 => "Thirteen",
    14 => "Fourteen",
    15 => "Fifteen",
    16 => "Sixteen",
    17 => "Seventeen",
    18 => "Eighteen",
    19 => "Nineteen",
    "014" => "Fourteen"
    );
    $tens = array(
    0 => "Zero",
    1 => "Ten",
    2 => "Twenty",
    3 => "Thirty",
    4 => "Forty",
    5 => "Fifty",
    6 => "Sixty",
    7 => "Seventy",
    8 => "Eighty",
    9 => "Ninety"
    );
    $hundreds = array(
    "Hundred",
    "Thousand",
    "Million",
    "Billion",
    "Trillion",
    "Quadrillion"
    ); /*limit t quadrillion */
            $num = number_format($num, 2, '.', ',');
            $num_arr = explode('.', $num);
            $wholenum = $num_arr[0];
            $decnum = $num_arr[1];
            $whole_arr = array_reverse(explode(',', $wholenum));
            krsort($whole_arr,1);
            $rettxt = '';
            foreach ($whole_arr as $key => $i) {
                while (substr($i, 0, 1) == '0') {
                    $i = substr($i, 1, 5);
                }
                if ($i < 20) {
                    // $rettxt .= $ones[$i];
                    $rettxt .= !empty($ones[$i]) ? ''.$ones[$i].'' : '';
                } elseif ($i < 100) {
                    // if (substr($i, 0, 1) != '0') {
                    //     $rettxt .= $tens[substr($i, 0, 1)];
                    // }
                    // if (substr($i, 1, 1) != '0') {
                    //     $rettxt .= ' '.$ones[substr($i, 1, 1)];
                    // }
                    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)];
                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)];
                } else {
                    if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                    if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)];
                    if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)];
                    // $rettxt .= $ones[substr($i, 0, 1)].' '.$hundreds[0]; //fix here
                    // if (substr($i, 1, 1) != 1) {
                    //     $rettxt .= ' '.$tens[substr($i, 1, 1)];
                    //     $rettxt .= ' '.$ones[substr($i, 2, 1)];
                    // } else {
                    //     $rettxt .= ' '.$ones[substr($i, 0, 1) + 9];
                    // }
                    // $rettxt .= $ones[substr($i, 0, 1)].' '.$hundreds[0];
                    // $rettxt .= ' '.$tens[substr($i, 1, 1)];
                    // $rettxt .= ' '.$ones[substr($i, 2, 1)];
                }
                if ($key > 0) {
                    $rettxt .= ' '.$hundreds[$key].' ';
                }
            }
            if ($prefix_position == 'Prefix') {
                $rettxt = $prefix.' '.$rettxt;
            } else {
                $rettxt = $rettxt.' '.$prefix;
            }

            if ($decnum > 0) {
                $rettxt .= ' and ';
                if ($decnum < 20) {
                    // $rettxt .= $ones[$decnum];
                    $rettxt .= $decones[$decnum];
                } elseif ($decnum < 100) {
                    // $rettxt .= $tens[substr($decnum,0,1)];
                    // $rettxt .= " ".$ones[substr($decnum,1,1)];
                    $rettxt .= $tens[substr($decnum, 0, 1)];
                    $rettxt .= ' '.$ones[substr($decnum, 1, 1)];
                }
                if ($surfix_position == 'Prefix') {
                    $rettxt = $surfix.' '.$rettxt;
                } else {
                    $rettxt = $rettxt.' '.$surfix;
                }
            }

            return $rettxt;
        }
    }
