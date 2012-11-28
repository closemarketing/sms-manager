=== International SMS Subscription Manager ===
Contributors: kloon
Donate link: http://www.igeek.co.za/
Tags: plugin, sms, subscription, widget, mobile, text
Requires at least: 2.0.2
Tested up to: 3.0.1
Stable tag: 1.1.3.3

Enable readers to subscribe to sms updates through a widget or registered users through their profiles, and allow blog owners to send sms text messages through dashboard with the [Clickatell SMS Gateway](http://www.anrdoezrs.net/click-4159320-10790930 "Bulk SMS Provider").

== Description ==

International SMS Subscription Manager is a WordPress plugin by [iGeek](http://www.igeek.co.za/ "iGeek") inspired by [WebAddiCT(s);](http://www.webaddict.co.za/ "WebAddiCT(s);") that allows you to place a widget on your blog where through readers can subscribe/unsubscribe their mobile numbers to receive SMS Text message updates to their mobile phones.

If your blog makes use of user registrations, registered users can subscribe their mobile numbers to receive SMS message updates through their profile page.

Blog owners have the functionality to send out SMS Text messages to subscribed numbers through the WordPress dashboard and also manage their subscribed numbers and widget options from there. Contacts can be imported and exported in CSV format and owners have the choice to send SMS messages to just widget subscribers or registered users or both.

You can now also send out SMS alert to your subscribers when you post a new blog post.

Newly added automatic country code detection based on IP address, if that failed users can select their country from a dropdown list.

Features include:

*   SMS subscribe/unsubscribe through a widget.
*   Registered users subscribe/unsubscribe through profile
*   Ajax enabled widget (No page reloading)
*   Custom widget header and footer.
*   Send SMS Text Messages through WordPress dashboard.
*   Automatically send SMS alerts when new blog post has been made
*   IP tracking on who subscribed a mobile number.
*   Manage subscribed mobile numbers through WordPress dashboard.
*   Import/Export contact in CSV format
*   Auto country code detect based on IP or select from dropdown
*	Enter number without country code or leading zero

We accept no responsibility for SMS messages send wrongfully, use at your own risk.

== Installation ==

= Installation =

1. Upload `clickatell-sms-subscription-manager` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

= Basic Setup =

1. Sign up with [Bulk SMS Provider](http://www.anrdoezrs.net/click-4159320-10790930 "Bulk SMS Provider")
1. Create a new connection of type HTTP with Bulk SMS Provider
1. Enter your connection details under the SMS Manager -> Options menu in your WordPress dashboard.

= Add widget to sidebar =

1. Go to Apearance -> Widgets in your WordPress dashboard
1. Drag the SMS Subscribe widget to your desired widget area

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. Subscribe to SMS Text message updates through a sidebar widget.
2. Send SMS Text messages to subscribers through WordPress dashboard.

== Changelog ==
= 1.1.3.3 =
* Updated auto country code lookup based on IP.
* Better IP lookup if behind proxy

= 1.1.3.2 =
* Fixed bug where some users got a cannot redeclare error.

= 1.1.3.1 =
* User can now subscribe without having to wait for site to finnish loading.
* Removed all short open tags
* Fixed bug where sms sending stopped when one number was invalid.

= 1.1.3 =
* Changed max length of cellphone numbers to 15 digits including country code as according to International Numbering plan rules.
* Fixed bug where clicking on change country link would jump to top of page.

= 1.1.2 =
* Fixed file_get_contents bug, now solely uses curl

= 1.1.1 =
* Added country dropdown list with automatic country code lookup based on IP

= 1.1 =
* Added user profile mobile number option so that registered users can subscribe through their profile instead of the widget.
* Have choice to either send messages to just reader subsribers or registered subscribers or both.
* Added abillity to send SMS messages on new post publish.
* Added abillity to import and export subscribers from a CSV file.

= 1.0 =
* Initial release