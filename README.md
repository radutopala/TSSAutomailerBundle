TSSAutomailerBundle
===================

Swiftmailer Spool for Doctrine packaged into a Symfony2 Bundle

Installation instructions:

- Easiest way to install is via composer, add those lines to `./composer.json`:

```
"require": {
    ...
    "tss/automailer-bundle": "dev-master"
}
```

and then run `composer.phar install`

- Then enable the bundle in `./app/AppKernel.php`:

```
public function registerBundles()
{
    $bundles = [
        ...
        new TSS\AutomailerBundle\TSSAutomailerBundle(),
    ];
}
```

- Change Swiftmailer spool type in `./app/config.yml`:

```
swiftmailer:
  ...
  spool:     { type: automailer }
```

- Update your db with Bundle's entity:

```
app/console doctrine:schema:update --force
```

Set a cron to execute the queue:

```
app/console automailer:spool:send
```

You can also test the spool by adding a new email with:

```
app/console automailer:test --email=info@trisoft.ro
```

Automailer has also a Beanstalk integration feature, which uses pheanstalk to send a job with `automailer:spool:send` to a queue/tube. This feature is activated automatically once a new email is sent through mailer, if pheanstalk is installed and if you add this inside `./app/config.yml`:

```
tss_automailer:
    beanstalk: true
```

You can also customize the entity manager:

```
tss_automailer:
    manager: doctrine_mongodb.odm.document_manager
    class: TSS\AutomailerBundle\DefaultDocument\Automailer
```

You can easily customize the class used for the entity or document by simply configuring the class in `config.yml` and disabling the relevant functionality like this:

```
tss_automailer:
    class: AppBundle\Entity\Automailer # or AppBundle\Document\Automailer, your specific path to your entity or document
    disable_default_document: true # disables the default document so that you can use your own
    disable_default_entity: true # disables the default entity so that you can use your own
```

In order to customize the entity or document that you wish to use with your own functionality, you can do so by extending `TSS\Automailer\Model\Automailer` and adding the relevant `@ODM\Document()` or `@ORM\Entity()` annotation to your class.

Enjoy :)
