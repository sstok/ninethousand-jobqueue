<?php

namespace NineThousand\Jobqueue\Queue;

/**
 * RetryQueue is the object model for the queue of jobs flagged for retry
 *
 * PHP version 5
 *
 * @category  NineThousand
 * @package   Jobqueue
 * @author    Jesse Greathouse <jesse.greathouse@gmail.com>
 * @copyright 2011 NineThousand (https://github.com/organizations/NineThousand)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD Licence
 * @link      https://github.com/NineThousand/ninethousand-jobqueue
 */

use NineThousand\Jobqueue\Queue;
use NineThousand\Jobqueue\Job\JobInterface;
use NineThousand\Jobqueue\Queue\QueueInterface;
use NineThousand\Jobqueue\Adapter\Queue\QueueAdapterInterface;
 
class RetryQueue extends Queue implements QueueInterface
{
    
    /**
     * @var null|string retains the sort order
     */
    protected $sortby = null;
    
    /**
     * @var null|string retains the filter option
     */
    protected $filterby = null;


    /**
     * Constructs the object.
     *
     * @param NineThousand\Jobqueue\Adapter\Queue\QueueAdapterInterface $adapter
     */
    public function __construct(QueueAdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
        parent::__construct();
    }
    
    /**
     * Creates a static instance of ActiveQueue.
     *
     * @param $adapter
     * @return NineThousand\Jobqueue\Queue\ActiveQueue
     */
    public static function factory($adapter)
    {
        return new self($adapter);
    }
    
    /**
     * Fetches all jobs in this queue.
     *
     * @return array
     */
    public function getAll() 
    {
        return $this->adapter->getRetries();
    }
    
    /**
     * Converts a job from a foreign queue to qualify for this queue.
     * 
     * @param NineThousand\Jobqueue\Job\JobInterface $job
     * @param int $num The number of times to retry a job defaults to 1
     * @param int $cooldown The number of seconds between retry attempts defaults to NULL
     */
    public function adoptJob(JobInterface $job, $num = 1, $cooldown = NULL)
    {
        $cooldown = (NULL !== $cooldown) ? $job->getCooldown() : $cooldown;
        $job->setActive(0)
            ->setMaxRetries(($job->getMaxRetries() + $num))
            ->setCooldown($cooldown)
            ->setRetry(1)
            ->setStatus('retry');
    }
    
}
