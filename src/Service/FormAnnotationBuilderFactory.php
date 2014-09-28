<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Mvc\Service;

use Zend\Form\Annotation\AnnotationBuilder;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Factory;

class FormAnnotationBuilderFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //setup a form factory which can use custom form elements
        $formElementManager = $serviceLocator->get('FormElementManager');
        $formFactory = new Factory($formElementManager);

        //setup input filter factory to use custom validators + filters
        $inputFilterFactory = $formFactory->getInputFilterFactory();

        $inputFilterFactory->getDefaultValidatorChain()
            ->setPluginManager($serviceLocator->get('ValidatorManager'));

        $inputFilterFactory->getDefaultFilterChain()
            ->setPluginManager($serviceLocator->get('FilterManager'));

        //create service and set custom form factory
        $annotationBuilder = new AnnotationBuilder();
        $annotationBuilder->setFormFactory($formFactory);
        return $annotationBuilder;
    }
}
