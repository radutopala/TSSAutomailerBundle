<?php

namespace TSS\AutomailerBundle\DefaultDocument;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use TSS\AutomailerBundle\Model\Automailer as BaseAutomailer;

/**
 * @ODM\Document(collection="automailer")
 */
class Automailer extends BaseAutomailer
{
}
