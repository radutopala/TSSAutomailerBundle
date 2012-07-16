<?php

namespace TSS\AutomailerBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AutomailerRepository
 */
class AutomailerRepository extends EntityRepository
{
    public function findNext($limit)
    {
        $query = $this->getEntityManager()->createQuery("SELECT am FROM TSSAutomailerBundle:Automailer am WHERE am.isSent = :is_sent AND am.isFailed = :is_failed AND am.isSending = :is_sending ORDER BY am.createdAt ASC")
				->setParameter('is_sent', 0)
				->setParameter('is_failed', 0)
				->setParameter('is_sending', 0)
				->setMaxResults($limit);
		return $query->getResult();
    }
    
    public function findSending()
    {
        $query = $this->getEntityManager()->createQuery("SELECT am FROM TSSAutomailerBundle:Automailer am WHERE am.isSending = :is_sending")
				->setParameter('is_sending', 1);
		return $query->getResult();
    }
}