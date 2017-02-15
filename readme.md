June 18, 2016:
The following changes have been incorporated in this version, RAPID PHP 21.

1. A new htaccess pattern has been introduced for routing. No need to use .php extension at the end of file name when calling it in a link or form. Just add a trailing slash instead of .php. E.g. use faqs-add/ instead of faqs-add.php.

2. Checkboxes have been replaced with new click to select module.

3. ADMIN_URL and ADMIN_SUBMIT_URL have be separated to handle form submission on https.

4. Card view has been introduced in addition to table view.

5. PDF download has been added in addition to CSV download.

6. Upload mechanism has been changed to store files in /Y/M/D folder format, similar to WordPress.

7. Extra files and folders have been removed from blank-project.

8. Multiple login session of same user restriction can be controlled from settings from the multi_login option.

9. Module can either been shown in sidebar or on a separate page from settings.

10. Searchable dropdown field has been added when generating pages.

11. mysqli_ functions have been incorporated and mysql_ functions have been dropped.

12. Testimonials page-set has been added in default page-sets.

13. 'Order By' and 'Search By' options have been separated when generating pages, so you can order by on a different field and search by a different field.

14. New version of JQuery has been used.

15. GoDaddy hosting issue resolved. On GoDaddy server, set value on PHP_EXTENSION constant in config to '.php'. define('PHP_EXTENSION','.php');