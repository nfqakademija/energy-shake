<?php
/**
 * Created by PhpStorm.
 * User: tmotuzis
 * Date: 17.11.2
 * Time: 19.19
 */

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class PostShowEvent extends Event
{
    private $price;
}
