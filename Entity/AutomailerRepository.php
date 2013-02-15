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
    
    public function recoverSending($timeout = 900)
    {
        $timeoutDate = new \DateTime();
        $timeoutDate->modify('-'.$timeout.' seconds');

        $query = $this->getEntityManager()->getConnection()->query('UPDATE automailer SET is_sending = 0 WHERE is_sending = 1 AND started_sending_at <= "'.$timeoutDate->format('Y-m-d H:i:s').'"');

		return $query->execute();
    }
}