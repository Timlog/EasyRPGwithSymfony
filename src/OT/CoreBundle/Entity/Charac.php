<?php

namespace OT\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Charac
 *
 * @ORM\Table(name="charac")
 * @ORM\Entity(repositoryClass="OT\CoreBundle\Repository\CharacRepository")
 */
class Charac
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
   * @ORM\ManyToOne(targetEntity="OT\UserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=false)
   */

    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="OT\CoreBundle\Entity\Category", cascade={"persist"})
     */
    private $categories;


    public function __construct()
    {
        $this->date       = new \Datetime();
        $this->categories = new ArrayCollection();
    }

    public function setUser(\OT\UserBundle\Entity\User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
    return $this->user;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }
  
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }
  
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Charac
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Charac
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Charac
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}

