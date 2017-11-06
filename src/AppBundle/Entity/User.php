<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="user")
     */
    private $bids;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $freelancehuntId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $freelancehuntSecret;

    /**
     * Add bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return User
     */
    public function addBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bids[] = $bid;

        return $this;
    }

    /**
     * Remove bid
     *
     * @param \AppBundle\Entity\Bid $bid
     */
    public function removeBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bids->removeElement($bid);
    }

    /**
     * Get bids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * Set freelancehuntId
     *
     * @param string $freelancehuntId
     *
     * @return User
     */
    public function setFreelancehuntId($freelancehuntId)
    {
        $this->freelancehuntId = $freelancehuntId;

        return $this;
    }

    /**
     * Get freelancehuntId
     *
     * @return string
     */
    public function getFreelancehuntId()
    {
        return $this->freelancehuntId;
    }

    /**
     * Set freelancehuntSecret
     *
     * @param string $freelancehuntSecret
     *
     * @return User
     */
    public function setFreelancehuntSecret($freelancehuntSecret)
    {
        $this->freelancehuntSecret = $freelancehuntSecret;

        return $this;
    }

    /**
     * Get freelancehuntSecret
     *
     * @return string
     */
    public function getFreelancehuntSecret()
    {
        return $this->freelancehuntSecret;
    }
}
