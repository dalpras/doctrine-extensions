DoctrineExtensions
=================

Add mysql ANY_VALUE function to doctrine entity manager.  
ANY_VALUE is a function introduced in MySQL 5.7 for beeing compatible with SQL99.  
In MariaDb this function is absent and you can ignore it.  
This library find if it's running on MariaDb or MySQL and use it or not.  

To add the mysql ANY_VALUE functionality to doctrine EntityManager,
just call the function:

	$emConfig = $this->getEntityManager()->getConfiguration();  
	$emConfig->addCustomStringFunction('ANY_VALUE', $className);


