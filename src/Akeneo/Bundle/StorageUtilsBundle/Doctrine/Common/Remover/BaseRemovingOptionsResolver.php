<?php

namespace Akeneo\Bundle\StorageUtilsBundle\Doctrine\Common\Remover;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Resolve removing options for single or bulk remove
 *
 * @author    Julien Janvier <jjanvier@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BaseRemovingOptionsResolver
{
    /**
     * Resolve options for a single remove
     *
     * @param array $options
     *
     * @return array
     */
    public function resolveRemoveOptions(array $options)
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setOptional(['flush_only_object']);
        $resolver->setAllowedTypes(['flush_only_object' => 'bool']);
        $resolver->setDefaults(['flush_only_object' => false]);
        $options = $resolver->resolve($options);

        return $options;
    }

    /**
     * Resolve options for a bulk remove
     *
     * @param array $options
     *
     * @return array
     */
    public function resolveRemoveAllOptions(array $options)
    {
        $resolver = $this->createOptionsResolver();
        $options = $resolver->resolve($options);

        return $options;
    }

    /**
     * @return OptionsResolverInterface
     */
    protected function createOptionsResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setOptional(['flush']);
        $resolver->setAllowedTypes(['flush' => 'bool']);
        $resolver->setDefaults(['flush' => true]);

        return $resolver;
    }
}
