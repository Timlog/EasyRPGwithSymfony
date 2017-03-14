<?php

// src/OT/CoreBundle/DataFixtures/ORM/LoadCategory.php


namespace OT\CoreBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OT\CoreBundle\Entity\Category;


class LoadCategory implements FixtureInterface

{
  public function load(ObjectManager $manager)
  {
    $names = array(
      'Futuriste',
      'Fantasy',
      'Contemporain',
      'Années 30',
    );


    foreach ($names as $name) {

      $category = new Category();
      $category->setName($name);
      $manager->persist($category);

    }

    $manager->flush();

  }

}