<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="t_storage")
 */
class Storage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
   /**
     * @ORM\Column(name="title",type="string", length=200)
     */
    protected $title;
   /**
     * @ORM\Column(name="type",type="string", length=200)
     */
    protected $type;
   /**
     * @ORM\Column(name="district",type="string", length=200)
     */
    protected $district;
   /**
     * @ORM\Column(name="city",type="string", length=200)
     */
    protected $city;
   /**
     * @ORM\Column(name="area",type="integer")
     */
    protected $area;
   /**
     * @ORM\Column(name="area_desc",type="string", length=200)
     */
    protected $areaDesc;
   /**
     * @ORM\Column(name="storage_desc",type="text",nullable=true)
     */
    protected $storageDesc;
    /**
     * @ORM\Column(name="map_url",type="string", length=200,nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "图片最大只能为5M.",
     *     mimeTypesMessage = "只能上传图片."
     * )
     */
    protected $mapUrl;
    /**
     * @ORM\Column(name="img_url",type="string", length=200,nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "图片最大只能为5M.",
     *     mimeTypesMessage = "只能上传图片."
     * )
     */
    protected $imgUrl;
    /**
     * @ORM\OneToMany(targetEntity="Visit", mappedBy="storage")
     */
    protected $visits;
   /**
     * @ORM\Column(name="pos_x",type="integer")
     */
    protected $posX = 0;
   /**
     * @ORM\Column(name="pos_y",type="integer")
     */
    protected $posY = 0;
    /**
     * @ORM\Column(name="create_time",  type="datetime")
     */
    private $createTime;
    /**
     * @ORM\Column(name="create_ip", type="string", length=60)
     */
    private $createIp;
   /**
     * @ORM\Column(name="order_id",type="integer")
     */
    protected $orderId;



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
     * Set title
     *
     * @param string $title
     * @return Storage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Storage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Storage
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Storage
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set area
     *
     * @param integer $area
     * @return Storage
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return integer 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set areaDesc
     *
     * @param string $areaDesc
     * @return Storage
     */
    public function setAreaDesc($areaDesc)
    {
        $this->areaDesc = $areaDesc;

        return $this;
    }

    /**
     * Get areaDesc
     *
     * @return string 
     */
    public function getAreaDesc()
    {
        return $this->areaDesc;
    }

    /**
     * Set storageDesc
     *
     * @param string $storageDesc
     * @return Storage
     */
    public function setStorageDesc($storageDesc)
    {
        $this->storageDesc = $storageDesc;

        return $this;
    }

    /**
     * Get storageDesc
     *
     * @return string 
     */
    public function getStorageDesc()
    {
        return $this->storageDesc;
    }

    /**
     * Set mapUrl
     *
     * @param string $mapUrl
     * @return Storage
     */
    public function setMapUrl($mapUrl)
    {
        $this->mapUrl = $mapUrl;

        return $this;
    }

    /**
     * Get mapUrl
     *
     * @return string 
     */
    public function getMapUrl()
    {
        return $this->mapUrl;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Storage
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
     * @return Storage
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
     * Set imgUrl
     *
     * @param string $imgUrl
     * @return Storage
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string 
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->visits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add visits
     *
     * @param \AppBundle\Entity\Visit $visits
     * @return Storage
     */
    public function addVisit(\AppBundle\Entity\Visit $visits)
    {
        $this->visits[] = $visits;

        return $this;
    }

    /**
     * Remove visits
     *
     * @param \AppBundle\Entity\Visit $visits
     */
    public function removeVisit(\AppBundle\Entity\Visit $visits)
    {
        $this->visits->removeElement($visits);
    }

    /**
     * Get visits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set posX
     *
     * @param integer $posX
     * @return Storage
     */
    public function setPosX($posX)
    {
        $this->posX = $posX;

        return $this;
    }

    /**
     * Get posX
     *
     * @return integer 
     */
    public function getPosX()
    {
        return $this->posX;
    }

    /**
     * Set posY
     *
     * @param integer $posY
     * @return Storage
     */
    public function setPosY($posY)
    {
        $this->posY = $posY;

        return $this;
    }

    /**
     * Get posY
     *
     * @return integer 
     */
    public function getPosY()
    {
        return $this->posY;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return Storage
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
