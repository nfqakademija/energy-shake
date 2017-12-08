<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.2
 * Time: 19.02
 */
namespace AppBundle\Twig;

class CurrencyExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'currencyFilter')),
        );
    }

    public function currencyFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price . ' Eur';

        return $price;
    }
}
