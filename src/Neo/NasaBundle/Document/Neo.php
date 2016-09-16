<?php

namespace Neo\NasaBundle\Document;



/**
 * Neo\NasaBundle\Document\Neo
 */
class Neo
{
    /**
     * @var $id
     */
    protected $id;

    /**
     * @var date $date
     */
    protected $date;

    /**
     * @var integer $reference
     */
    protected $reference;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var integer $speed
     */
    protected $speed;

    /**
     * @var boolean $isHazardous
     */
    protected $isHazardous;


    /**
     * Set id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return date $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get reference
     *
     * @return integer $reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     * @return $this
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * Get speed
     *
     * @return integer $speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set isHazardous
     *
     * @param boolean $isHazardous
     * @return $this
     */
    public function setIsHazardous($isHazardous)
    {
        $this->isHazardous = $isHazardous;
        return $this;
    }

    /**
     * Get isHazardous
     *
     * @return boolean $isHazardous
     */
    public function getIsHazardous()
    {
        return $this->isHazardous;
    }
}
