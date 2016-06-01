<?php

namespace TSS\AutomailerBundle\DefaultEntity;

use Doctrine\ORM\Mapping as ORM;
use TSS\AutomailerBundle\Model\Automailer as BaseAutomailer;

/**
 * @ORM\Table(name="automailer")
 * @ORM\Entity()
 */
class Automailer extends BaseAutomailer
{
}
