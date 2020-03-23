
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
- you should be able to access `minisite.homestead.test` in your machine's browser
