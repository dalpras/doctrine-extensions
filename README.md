DoctrineExtensions
=================

Add mysql ANY_VALUE function to doctrine entity manager

To add the mysql ANY_VALUE functionality to doctrine EntityManager,
just call the function:

$emConfig = $this->getEntityManager()->getConfiguration();
$emConfig->addCustomStringFunction('ANY_VALUE', $className);
