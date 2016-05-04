<?php

namespace TSS\AutomailerBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TSSAutomailerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        if (class_exists('Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass')) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    [__DIR__.'/Resources/config/doctrine/orm' => __NAMESPACE__.'\\Model'],
                    [],
                    false
                )
            );
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                    [__NAMESPACE__.'\\DefaultEntity'],
                    [__DIR__.DIRECTORY_SEPARATOR.'DefaultEntity'],
                    [],
                    'tss_automailer.disable_default_entity'
                )
            );
        }
        if (class_exists('Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass')) {
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                    [__DIR__.'/Resources/config/doctrine/odm' => __NAMESPACE__.'\\Model'],
                    [],
                    false
                )
            );
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createAnnotationMappingDriver(
                    [__NAMESPACE__.'\\DefaultDocument'],
                    [__DIR__.DIRECTORY_SEPARATOR.'DefaultDocument'],
                    [],
                    'tss_automailer.disable_default_document'
                )
            );
        }
    }
}
