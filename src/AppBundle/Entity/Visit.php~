<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="t_visit")
 */
class Visit
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   /**
     * @ORM\Column(name="username",type="string", length=200)
     */
    protected $username;
   /**
     * @ORM\Column(name="mobile",type="string", length=200)
     */
    protected $mobile;
   /**
     * @ORM\Column(name="company",type="string", length=200)
     */
    protected $company;
   
    /**
     * @ORM\ManyToOne(targetEntity="Storage", inversedBy="storages")
     * @ORM\JoinColumn(name="storage_id", referencedColumnName="id")
     */
    protected $storage;
    /**
     * @ORM\Column(name="create_time",  type="datetime")
     */
    private $createTime;
    /**
     * @ORM\Column(name="create_ip", type="string", length=60)
     */
    private $createIp;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Visit
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Visit
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Visit
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Visit
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set createIp
     *
     * @param string $createIp
     * @return Visit
     */
    public function setCreateIp($createIp)
    {
        $this->createIp = $createIp;

        return $this;
    }

    /**
     * Get createIp
     *
     * @return string 
     */
    public function getCreateIp()
    {
        return $this->createIp;
    }

    /**
     * Set storage
     *
     * @param \AppBundle\Entity\Storage $storage
     * @return Visit
     */
    public function setStorage(\AppBundle\Entity\Storage $storage = null)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Get storage
     *
     * @return \AppBundle\Entity\Storage 
     */
    public function getStorage()
    {
        return $this->storage;
    }
}
