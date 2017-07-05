<?php

namespace Synolia\Bundle\OroneoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Synolia\Bundle\OroneoBundle\Manager\ImportManager;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('synolia_oroneo');

        SettingsBuilder::append(
            $rootNode,
            [
                'default_owner'                    => ['type' => 'string', 'value' => 1],
                'default_organization'             => ['type' => 'string', 'value' => 1],
                'delimiter'                        => ['value' => ','],
                'enclosure'                        => ['value' => '"'],
                'localization_mapping'             => ['type' => 'array', 'value' => []],
                'category_mapping'                 => ['type' => 'array', 'value' => []],
                'master_category'                  => ['type' => 'array', 'value' => ['masterCategory' => 1]],
                'attribute_mapping'                => ['type' => 'array', 'value' => []],
                'option_mapping'                   => ['type' => 'array', 'value' => []],
                'family_mapping'                   => ['type' => 'array', 'value' => []],
                'attribute_group_mapping'          => ['type' => 'array', 'value' => []],
                'product_channel'                  => ['value' => 'ecommerce'],
                'product_image_main'               => ['value' => ''],
                'product_image_listing'            => ['value' => ''],
                'product_image_additional'         => ['value' => ''],
                'product_attachment'               => ['value' => ''],
                'product_mapping'                  => ['type' => 'array', 'value' => []],
                'distant_host'                     => ['value' => ''],
                'distant_connection_type'          => ['value' => 'FTP'],
                'distant_username'                 => ['value' => ''],
                'distant_password'                 => ['value' => ''],
                'distant_port'                     => ['value' => 21],
                'distant_filepath_category'        => ['value' => ''],
                'distant_filepath_attribute'       => ['value' => ''],
                'distant_filepath_option'          => ['value' => ''],
                'distant_filepath_family'          => ['value' => ''],
                'distant_filepath_attribute_group' => ['value' => ''],
                'distant_filepath_product'         => ['value' => ''],
                'distant_filepath_product-file'    => ['value' => ''],
                'jobs' => [
                    'type'  => 'array',
                    'value' => [
                        'category'  => [
                            'import_file' => 'app/import_export/category.csv',
                            'processor'   => ImportManager::CATEGORY_PROCESSOR,
                        ],
                        'attribute' => [
                            'import_file' => 'app/import_export/attribute.csv',
                            'batch_job'   => ImportManager::ATTRIBUTE_JOB,
                            'processor'   => ImportManager::ATTRIBUTE_PROCESSOR,
                        ],
                        'option'    => [
                            'import_file' => 'app/import_export/option.csv',
                            'processor'   => ImportManager::OPTION_PROCESSOR,
                        ],
                        'family'  => [
                            'import_file' => 'app/import_export/family.csv',
                            'processor'   => ImportManager::FAMILY_PROCESSOR,
                        ],
                        'attribute_group'  => [
                            'import_file' => 'app/import_export/attribute_group.csv',
                            'batch_job'   => ImportManager::ATTRIBUTE_GROUP_JOB,
                            'processor'   => ImportManager::ATTRIBUTE_GROUP_PROCESSOR,
                        ],
                        'product'   => [
                            'import_file' => 'app/import_export/product.csv',
                            'processor'   => ImportManager::PRODUCT_PROCESSOR,
                        ],
                        'product-file'   => [
                            'import_file'  => 'app/import_export/imports.zip',
                            'batch_job'    => ImportManager::PRODUCT_FILE_JOB,
                            'processor'    => ImportManager::PRODUCT_FILE_PROCESSOR,
                            'input_format' => 'zip',
                        ],
                    ],
                ],
            ]
        );

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
