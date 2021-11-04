
# Ninja Forms - Salesforce

This is a very dodgy custom hook that lets you take subsmissions on a [Ninja Form](https://ninjaforms.com/) in your wordpress website and create them as a Salesforce contact on a dummy account.

This is used for a newsletter signup form, because I didn't feel the need to spend $30.00/year on a plugin for this. All these plugins add up, man.

## Installation
* You *must* have Ninja Forms installed - so do this now. I'll wait.

* Install this plugin
```sh
cd /var/www/html/wp-content/plugins/
git clone https://github.com/nicko170/ninjaforms-salesforce
```

* Activate the plugin in Wordpress Admin Interface
* Under the Ninja Forms -> Salesforce Config menu, configure your connection settings
    * *Salesforce Domain*: This is your Salesforce Lightning Domain, for example, https://internet.my.salesforce.com/
    * *Salesforce Username*: Your Salesforce login email. I recommend using a service account
    * *Salesforce Password*: Your Salesforce login password
    * *Salesforce Security Token*: Your [Salesforce User Security Token](https://help.salesforce.com/s/articleView?id=sf.user_security_token.htm&type=5) that bypasses 2FA for APIs
    * *Salesforce Client ID*: Create a [Connected App](https://help.salesforce.com/s/articleView?id=sf.connected_app_create.htm&language=en_US&r=https%3A%2F%2Fwww.google.com%2F&type=5), it'll give you a Consumer Key. Put that here.
    * *Salesforce Client Secret*: Enter the Consumer Secret from the Connected App
    * *Salesforce Company Name*: This will be the name of the company that all form submissions get sent to.

![Where to find the menu](/imgs/img3.png?raw=true "Where to find the menu")

## The form
This is the *really* dodgy part :-)

**Create a Ninja Form, which _must_ have at minimum 3 fields.

* These 3 fields MUST have a label with the following text, they'll be picked up and posted to the contact in Salesforce
    * First Name
    * Last Name
    * Email

![What the form should look like](/imgs/img2.png?raw=true "What the form should look like")


Under the Emails & Actions settings, add a WP Hook action with the following Hook Tag: ninja_forms_salesforce_action

![Adding WP Hook](/imgs/img1.png?raw=true "Adding WP Hook")

Test your form, and check your Salesforce.


## License

[GNU General Public License v3.0](LICENSE)

## Found a bug?
Feel free to open a Pull Request :-)
