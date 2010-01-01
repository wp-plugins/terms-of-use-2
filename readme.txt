=== Terms of Use ===
Contributors: sswells
Donate link: http://blog.strategy11.com/donate
Tags: Terms, admin, Use, agreement, Privacy, Policy, WPMU, Conditions, plugin, wordpress, plugin, template
Requires at least: 2.0
Tested up to: 2.9
Stable tag: 1.11.0

Forces all users (except admins) to agree to your Terms and Conditions on first login and anytime you choose to make them accept new terms.

== Description ==

Instead of adding Terms and Conditions to the signup page, this plugin presents all users except admins with your terms and conditions the first time they login. The Admin menu is hidden until they accept your terms if the option to require agreement on 'All Admin pages' is selected. Existing users and those added in the admin will also need to agree to the Terms and Conditions on their next log in. After the terms are accepted, users are presented with a fully customizable welcome message to help them get started using WordPress.

= Features =
* Fully customizable Terms and Conditions, Privacy Policy and welcome message.
* No changes need to be made to the Sign up process.
* Existing users can agree to terms.
* Users can view the terms at any time.
* The date the user agreed is displayed on the profile page with a link to the terms.
* Option to require user initials on agreement.
* Option to require terms agreement on comment form in WordPress version 2.9 and above.
* Option to clear all agreement dates when the terms are changed so users will need to reaccept terms.
* Option to show agreement date on profile.
* Shortcode [terms-of-use] for use in pages or posts for WordPress version 2.8 and above.
* Select a front-end page to protect. If user is not logged in, a cookie will be set when terms are accepted.


Feedback and requests are welcome.

Adapted from Levi Putna's Terms of Use plugin.

== Installation ==
1. Upload `terms-of-use` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu
3. Go to the 'Settings' menu and select 'Terms of Use' to customize settings.
4. Users can view the terms under the 'Dashboard' menu.
5. Use shortcode [terms-of-use] in pages or posts to avoid duplication of content. (Requires WordPress version 2.8)
6. WPMU: Same as above except go to the 'Site Admin' menu and select 'Terms of Use' to customize settings. 

== Screenshots ==
1. The settings page.
2. The agreement page. Privacy Policy has been left blank in the example.
3. The welcome page seen after term acceptance.

== Changelog ==
= 1.11.0 =
* Fixed front-end redirect to work with default permalinks
* Removed unnecessary javascript from admin
* Simplified front-end terms requirements with a page drop-down in the admin settings, and auto content if the page is blank.
* Added option to require terms on comment form

= 1.10.5 =
* Updated instructions for admin menu selected
* Added profile to the options of where to place the Terms of Use admin menu

= 1.10.4 =
* Fixed registration page error... again

= 1.10.3 =
* Fixed bug preventing terms agreement checkbox to show on WP registration page

= 1.10.2 =
* Removed code causing signup issue in WPMU

= 1.10.1 =
* Added Profile page as an option on admin pages to protect

= 1.10 =
* Fixed admin redirect bug

= 1.9 =
* Fixed redirect after terms accepted on WPMU front-end

= 1.8 =
* Bug fix for 'header information already sent' bug some users reported

= 1.7 =
* Fixed bug that overwrote custom options on plugin update.
* Added shortcode for use of terms in pages or posts.
* Fixed bug that showed Privacy Policy and Terms boxes when empty.
* Added option to allow users to accept terms during signup. Known to not save correctly in WPMU.
* Changed date format for profile page to the format selected on Settings > General
* Fixed javascript bug that prevented collapse of windows on new/edit posts page
* Added option to select which admin page to protect
* Added option to select which front-end page to protect
* Added option to select where users see the Terms of Use in the admin menu

= 1.6 =
* Added 'Settings' link on the plugins page
* Added option to require initials on agreement page
* Moved 'Welcome' heading from code to database

= 1.5 =
* Fixed plugin subnav links
 
= 1.4 = 
* Fixed WPMU bugs with link urls. 
* Moved Terms of use to dashboard menu for users to view and accept.

= 1.3 = 
* Fixed folder name in config file.