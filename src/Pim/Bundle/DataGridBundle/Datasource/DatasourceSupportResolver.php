<?php

namespace Pim\Bundle\DataGridBundle\Datasource;

use Akeneo\Bundle\StorageUtilsBundle\DependencyInjection\AkeneoStorageUtilsExtension;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * Determine the datasource suport to use depending on the datasource and the storage driver.
 *
 * @author    Julien Janvier <julien.janvier@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DatasourceSupportResolver
{
    /** @staticvar string */
    const DATASOURCE_SUPPORT_ORM = 'orm';

    /** @staticvar string */
    const DATASOURCE_SUPPORT_MONGODB = 'mongodb';

    /** @var string */
    protected $storageDriver;

    /** @var array */
    protected $smartDatasources = [];

    /**
     * @param string $storageDriver
     */
    public function __construct($storageDriver)
    {
        $this->storageDriver = $storageDriver;
    }

    /**
     * @param string $datasourceType
     *
     * @return string
     *
     * @throws InvalidConfigurationException
     */
    public function getSupport($datasourceType)
    {
        if (AkeneoStorageUtilsExtension::DOCTRINE_ORM === $this->storageDriver) {
            return self::DATASOURCE_SUPPORT_ORM;
        }

        if (in_array($datasourceType, $this->smartDatasources)) {
            return self::DATASOURCE_SUPPORT_MONGODB;
        }

        return self::DATASOURCE_SUPPORT_ORM;
    }

    /**
     * Define a datasource as smart which it will be eligible to the MongoDB support.
     *
     * @param mixed $datasource
     */
    public function addSmartDatasource($datasource)
    {
        $this->smartDatasources[] = $datasource;
    }
}
