TSSAutomailerBundle
===================

Swiftmailer Spool for Doctrine packaged into a Symfony2 Bundle

Installation instructions:

- Easiest way to install is via composer, add those lines to ```./composer.json```:
    
    
      ```
      "require": {
        ...
        "tss/automailer-bundle": "dev-master"
      }
```

 
  and then run ```composer.phar install```

- Then enable the bundle in ```./app/AppKernel.php```:
    
    ```
    public function registerBundles()
    {
        $bundles = array(
                ...
                new TSS\AutomailerBundle\TSSAutomailerBundle(),
            );
    }
```

- If your project uses Entity Manager mappings, you need to include TSSAutomailerBundle as well, in ```./app/config.yml```:

    ```
    orm:
        ...
        entity_managers:
            default:
                connection: default
                mappings:
                    ...
                    TSSAutomailerBundle: ~

- Change Swiftmailer spool type in ```./app/config.yml```:

    ```
    swiftmailer:
      ...
      spool:     { type: automailer }
      
- Update your db with Bundle's entity:

    ```app/console doctrine:schema:update --force```
    
Set a cron to execute the queue:

    app/console swiftmailer:spool:send
    
You can also test the spool by adding a new email with:

    app/console automailer:test --email=info@trisoft.ro
    
Automailer has also a Beanstalk integration feature, which uses pheanstalk to send a job with ```swiftmailer:spool:send``` to a queue/tube. This feature is activated automatically once a new email is sent through mailer, if pheanstalk is installed and if you add this inside ```./app/config.yml```:
```
tss_automailer:
  beanstalk: true
```
    
Enjoy :)
