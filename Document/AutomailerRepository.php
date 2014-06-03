<?php

namespace TSS\AutomailerBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * AutomailerRepository
 */
class AutomailerRepository extends DocumentRepository
{
    public function findNext($limit)
    {
        $qb = $this->createQueryBuilder();

        $qb->field('isSent')->equals(false);
        $qb->field('isFailed')->equals(false);
        $qb->field('isSending')->equals(false);

        $qb->limit($limit);

        $qb->sort('createdAt', 1);

        /**
         * Unless we convert to array, sending will fail without a reset() call in the AutomailerSpool
         */
        return iterator_to_array($qb->getQuery()->execute());
    }
    
    public function recoverSending($timeout = 900)
    {
        $timeoutDate = new \DateTime();
        $timeoutDate->modify('-'.$timeout.' seconds');

        $qb = $this->createQueryBuilder()
            ->update()
            ->multiple(true);

        $qb->field('isSending')->equals(true);
        $qb->field('startedSendingAt')->lte($timeoutDate);

        $qb->field('isSending')->set(false);


        return $qb->getQuery()->execute();
    }
}
