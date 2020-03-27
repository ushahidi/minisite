
# Setup
- Install virtualbox 6.x (or other virtualizer like parallels/vmware) https://www.virtualbox.org/wiki/Downloads
- Install vagrant https://www.vagrantup.com/downloads.html 
- Install PHP (this is just to be able to run composer) in your machine
- run ` composer install --ignore-platform-reqs` this will install dependencies, most importantly, it will get homestead installed
- add to your /etc/hosts (in your machine, not in the vagrantbox)
     - `192.168.10.10    minisite.homestead.test`
- run `vagrant up` in the root directory
- run `vagrant ssh` and you should be in the virtual machine. Check that the dir ~/code has what you would expect (this code!)
- run `cp .env.example .env`
- run `php artisan migrate`
- run `php artisan db:seed`

- you should be able to access `minisite.homestead.test` in your machine's browser

# Adding new block components
- Add a new seeder for the new block. Example with WhatsappGroupBlock: `php artisan make:seeder WhatsappGroupBlock` 
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
