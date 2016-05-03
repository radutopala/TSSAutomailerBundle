<?php

namespace TSS\AutomailerBundle\Model;

use Doctrine\ORM\EntityRepository;

class ORMRepository extends EntityRepository
{
    public function findNext($limit)
    {
        $query = $this
            ->getEntityManager()
            ->createQuery('
                SELECT am
                FROM TSSAutomailerBundle:Automailer am
                WHERE am.isSent = :is_sent
                AND am.isFailed = :is_failed
                AND am.isSending = :is_sending
                ORDER BY am.createdAt ASC
            ')
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

        $query = $this
            ->getEntityManager()
            ->createQuery('
                UPDATE TSSAutomailerBundle:Automailer am
                SET am.isSending = false
                WHERE am.isSending = true
                AND am.startedSendingAt <= :timeout_date
            ')
            ->setParameter('timeout_date', $timeoutDate)
        ;

        return $query->execute();
    }
}
