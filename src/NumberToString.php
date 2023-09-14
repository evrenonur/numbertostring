<?php

namespace Evrenonur;

class NumberToString
{
    public function numberToString($number, $currencyCode = ['TL', 'EUR', 'USD', 'GBP'])
    {
        if (!is_numeric($number)) {
            return "Number must be numeric";
        }

        if ($currencyCode != 'TL' && $currencyCode != 'EUR' && $currencyCode != 'USD' && $currencyCode != 'GBP') {
            return "Currency code must be TL, EUR, USD or GBP";
        }

        $currencyNames = array(
            'TL' => array(
                'name' => 'Türk Lirası',
                'subunit' => 'Kuruş'
            ),
            'EUR' => array(
                'name' => 'Euro',
                'subunit' => 'Cent'
            ),
            'USD' => array(
                'name' => 'Dolar',
                'subunit' => 'Cent'
            ),
            'GBP' => array(
                'name' => 'Sterlin',
                'subunit' => 'Pence'
            )
        );

        $numberText = number_format($number, 2, '.', '');

        $digitCount = strlen($numberText);
        if ($digitCount > 15) {
            return "Number is too big";
        }
        $wholePart = floor($number); // Get the whole part
        $decimalPart = round(($number - $wholePart) * 100); // Get the decimals and round

        $text = "";

        if ($wholePart != 0) {
            $text .= $this->numberToStringInternal($wholePart) . " " . $currencyNames[$currencyCode]['name'] . " ";
        }

        if ($decimalPart != 0) {
            $text .= $this->numberToStringInternal($decimalPart) . ($decimalPart > 0 ? " " . $currencyNames[$currencyCode]['subunit'] : " Sıfır " . $currencyNames[$currencyCode]['subunit']);
        } else {
            $text .= "Sıfır " . $currencyNames[$currencyCode]['subunit'];
        }

        if (empty($text)) {
            $text = "Sıfır " . $currencyNames[$currencyCode]['name'];
        }

        return $text;
    }

    public function numberToStringInternal($number)
    {
        $ones = array("", "Bir", "İki", "Üç", "Dört", "Beş", "Altı", "Yedi", "Sekiz", "Dokuz");
        $tens = array("", "On", "Yirmi", "Otuz", "Kırk", "Elli", "Altmış", "Yetmiş", "Seksen", "Doksan");

        if ($number == 0) {
            return "Sıfır";
        } else

            if ($number < 10) {
                return $ones[$number];
            } elseif ($number < 20) {
                $value = "On " . $this->numberToStringInternal($number - 10);
                if ($number == 10) {
                    $value = "On";
                }
                return $value;
            } elseif ($number < 100) {
                $tensDigit = floor($number / 10);
                $onesDigit = $number % 10;

                $text = $tens[$tensDigit];
                if ($onesDigit > 0) {
                    $text .= " " . $ones[$onesDigit];
                }

                return $text;
            } elseif ($number == 100) {
                return "Yüz";
            } elseif ($number < 1000) {
                $hundreds = floor($number / 100);
                $remainder = $number % 100;
                $text = "";

                if ($hundreds == 1) {
                    $text = "Yüz";
                } elseif ($hundreds > 1) {
                    $text = $ones[$hundreds] . " Yüz";
                }

                if ($remainder > 0) {
                    $text .= " " . $this->numberToStringInternal($remainder);
                }

                return $text;
            } elseif ($number == 1000) {
                return "Bin";
            } elseif ($number < 1000000) {
                $thousands = floor($number / 1000);
                $remainder = $number % 1000;
                $text = "";

                if ($thousands == 1) {
                    $text = "Bin";
                } elseif ($thousands > 1) {
                    $text = $this->numberToStringInternal($thousands) . " Bin";
                }

                if ($remainder > 0) {
                    $text .= " " . $this->numberToStringInternal($remainder);
                }

                return $text;
            } elseif ($number < 1000000000) {
                $millions = floor($number / 1000000);
                $remainder = $number % 1000000;
                $text = $this->numberToStringInternal($millions) . " Milyon";

                if ($remainder > 0) {
                    $text .= " " . $this->numberToStringInternal($remainder);
                }

                return $text;
            } elseif ($number < 1000000000000) {
                $billions = floor($number / 1000000000);
                $remainder = $number % 1000000000;
                $text = $this->numberToStringInternal($billions) . " Milyar";

                if ($remainder > 0) {
                    $text .= " " . $this->numberToStringInternal($remainder);
                }

                return $text;
            } else {
                return "Number is too big";
            }
    }

}
