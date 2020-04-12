

# Setup
- Install virtualbox 6.x (or other virtualizer like parallels/vmware) https://www.virtualbox.org/wiki/Downloads
- Install vagrant https://www.vagrantup.com/downloads.html 
- Install PHP (this is just to be able to run composer) in your machine
- run ` composer install --ignore-platform-reqs` this will install dependencies, most importantly, it will get homestead installed
- add to your /etc/hosts (in your machine, not in the vagrantbox)
     - `192.168.10.10    minisite.homestead.test`
- create your Homestead.yaml file (replace the code path and remove brackets, those are just for the example here)

```
ip: 192.168.10.10
memory: 2048
cpus: 2
provider: virtualbox
authorize: ~/.ssh/id_rsa.pub
keys:
    - ~/.ssh/id_rsa
folders:
    -
        map: {path of the code in your host machine}
        to: /home/vagrant/code
sites:
    -
        map: homestead.test
        to: /home/vagrant/code/public
databases:
    - homestead
    - minisite
features:
    -
        mariadb: false
    -
        ohmyzsh: false
    -
        webdriver: false
name: minisite
hostname: minisite
```

- run `vagrant up` in the root directory
- run `vagrant ssh` and you should be in the virtual machine. Check that the dir ~/code has what you would expect (this code!)
- run `cp .env.example .env`
- run `php artisan migrate --database=migrate`
- run `php artisan db:seed`
- you should be able to access `minisite.homestead.test` in your machine's browser

# Adding new block components
- Add a new seeder for the new block. Example with WhatsappGroupBlock: `php artisan make:seeder WhatsappGroupBlock` 
- Add it to `database\seeds\DatabaseSeeder.php`
- To create the block details and fields, follow the example in the database\seeds\WhatsappGroupBlock.php file
- run the seeder. Example: `php artisan db:seed --class="WhatsappGroupBlock"`
- Add a component for the block. Example `php artisan make:component WhatsAppGroup`
- Go to the component's class. You can find it in app\View\Components. Example: app\View\Components\WhatsAppGroup.php
- Add the $block field to the class constructor and class properties. Example:
``````
     public $block;
     /**
          * Create a new component instance.
          *
          * @return void
          */
     public function __construct($block = null)
     {
          $this->block = $block;
     }
``````
- Go to resources\views\site\public.blade.php to add the block into the website layout. 
     - Example of using the component (notice the x and the name of the block)
     ``````
          <x-whatsapp-group :block='$block'></x-whatsapp-group>
     ``````
- At this point you should be able to add this block in the minisite block administration panel.
- You will need to edit the component view  in resources\views\components\whats-app-group.blade.php according to your needs. Check out other components to see examples of how to do this.

# Quick how-tos...

- I get an error that a class cannot be found, but I am sure the correct path and namespace 
    - Run  `composer dump-autoload;` to update path maps 
- I want to start over with my database
    - composer dump-autoload; php artisan db:wipe; php artisan migrate; php artisan db:seed; 



#geocode notes
- User to write down neighborhood
- Pick up first result from OSM
- Show it to them, let them put a pin somewhere (or take the center/default if they don't pick one)
- Confirm we got the right neighrbohood
- Save Neighborhood, City, blablabla, but not necessarily lat/lon at this point
- 

https://github.com/thephpleague/geotools
https://github.com/geocoder-php/Geocoder#special-geocoders-and-providers




# Deploy
php artisan down;
git pull origin master;
~/composer.phar install;
php artisan migrate;
sudo chown -R www-data:www-data storage/;
npm run production;
php artisan config:cache;
php artisan view:cache;
~/composer.phar dumpautoload;
php artisan up;


# Route naming
shortModuleName.action[.submit|.store]
ie: 
landing.search.submit for MahallahLanding.search.submit