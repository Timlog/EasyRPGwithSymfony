<?php

namespace OT\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OTUserBundle extends Bundle
{
	
  public function getParent()

  {
    return 'FOSUserBundle';
  }

}
