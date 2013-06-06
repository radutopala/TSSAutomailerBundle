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
				->setParameter('is_sent', false)
				->setParameter('is_failed', false)
				->setParameter('is_sending', false)
				->setMaxResults($limit);
		return $query->getResult();
    }
    
    public function recoverSending($timeout = 900)
    {
        $timeoutDate = new \DateTime();
        $timeoutDate->modify('-'.$timeout.' seconds');

        $query = $this->getEntityManager()->createQuery("UPDATE TSSAutomailerBundle:Automailer am SET am.isSending = false WHERE am.isSending = true AND am.startedSendingAt <= :timeout_date")
				->setParameter('timeout_date', $timeoutDate);

		return $query->getResult();
    }
}