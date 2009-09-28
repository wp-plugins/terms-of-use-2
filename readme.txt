=== Terms of Use ===
Contributors: sswells
Donate link: http://blog.strategy11.com/donate
Tags: Terms, admin, Use, agreement, Privacy, Policy, WPMU, Conditions, plugin, wordpress, plugin, template
Requires at least: 2.0
Tested up to: 2.8.4
Stable tag: 1.6

Forces all users (except admins) to agree to your Terms and Conditions on first login and anytime you choose to make them accept new terms.

== Description ==

Instead of adding Terms and Conditions to the signup page, this plugin presents all users except admins with your terms and conditions the first time they login. The Admin menu is hidden until they accept your terms. Existing users and those added in the admin will also need to agree to the Terms and Conditions on their next log in. After the terms are accepted, users are presented with a fully customizable welcome message to help them get started using WordPress.

= Features =
* Fully customizable Terms and Conditions, Privacy Policy and welcome message.
* No changes need to be made to the Sign up process.
* Existing users can agree to terms.
* Users can view the terms at any time.
* The date the user agreed is displayed on the profile page with a link to the terms.
* Option to clear all agreement dates when the terms are changed so users will need to reaccept terms.
* Option to show agreement date on profile.

If you would like to move the users' Terms of Use link, simply change 'index.php' on line 14 of 'tou-config.php'.

Feedback and requests are welcome.

Adapted from Levi Putna's Terms of Use plugin.

== Installation ==

WordPress:
1. Upload `terms-of-use` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the 'Settings' menu and select 'Terms of Use' to customize settings.
4. Users can view the terms under the 'Dashboard' menu.

WPMU:
Same as above except go to the 'Site Admin' menu and select 'Terms of Use' to customize settings. 


== Screenshots ==

1. The settings page.
2. The agreement page. Privacy Policy has been left blank in the example.
3. The welcome page seen after term acceptance.

== Changelog ==
= 1.7 =
*Fixed bug that overwrote custom options on plugin update.

= 1.6 =
*Added 'Settings' link on the plugins page
*Added option to require initials on agreement page
*Moved 'Welcome' heading from code to database

= 1.5 =
*Fixed plugin subnav links
 
= 1.4 = 
*Fixed WPMU bugs with link urls. 
*Moved Terms of use to dashboard menu for users to view and accept.

= 1.3 = 
*Fixed folder name in config file. 