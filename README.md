TSSAutomailerBundle
===================

Swiftmailer Spool for Doctrine packaged into a Symfony2 Bundle

Installation instructions:

- Easiest way to install is via composer, add those lines to composer.lock:
    
    
      ```
      "packages": [
        ...
        {
            "package": "tss/automailer-bundle",
            "version": "dev-master"
        }
      ]
```

 
  and then run ```composer.phar install```

- Change spool type in ```/app/config.yml``` :

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
    
Enjoy :)