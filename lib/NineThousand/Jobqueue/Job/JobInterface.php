<?php

namespace NineThousand\Jobqueue\Job;

/**
 * JobInterface defines the required functions for Job models in Jobqueue.
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

interface JobInterface
{
    public function run();
    public function rewindAttempts($value);
    public function incrementAttempts($value);
    public function preRun();
    public function postRun();
    public function spawn();
    
    public function getId();
    public function getName();
    public function setName($name);
    public function getRetry();
    public function setRetry($retry);
    public function getCooldown();
    public function setCooldown($cooldown);
    public function getMaxRetries();
    public function setMaxRetries($maxRetries);
    public function getAttempts();
    public function setAttempts($attempts);
    public function getExecutable();
    public function setExecutable($executable);
    public function getParams();
    public function setParams(array $params);
    public function getArgs();
    public function setArgs(array $args);
    public function getType();
    public function setType($type);
    public function getTags();
    public function setTags(array $tags);
    public function getHistory();
    public function addHistory(array $result);
    public function getStatus();
    public function setStatus($status);
    public function getCreateDate();
    public function setCreateDate(\DateTime $date);
    public function getLastrunDate();
    public function setLastRunDate(\DateTime $date);
    public function getActive();
    public function setActive($active);
    public function getSchedule();
    public function setSchedule($schedule);
    public function getParent();
    public function setParent($parent);
    
}
