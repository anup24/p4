# Practice work - Project 4
+ By: *Anup Shetye*
+ Production URL: <http://p4.dwa15.site>

## Outside resources
+ Inspired by [Pastebin] (https://pastebin.com/)
+ CSS and background image: [Bootstrap CDN](https://www.bootstrapcdn.com) & [CSS ZEN Garden](http://csszengarden.com)
+ Icons: [Font Awesome](https://fontawesome.com)
+ Social login: [Sitepoint](https://www.sitepoint.com/easily-add-social-logins-to-your-app-with-socialite/) (attempted, not yet working)
+ TLS Certificate from [How To Secure Apache with Let's Encrypt](https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-14-04)


## Database
*Registered users data is stored in 'users' table and the texts added by them are in 'texts' table whereas associated tags are stored in the 'tags' table with many-to-many relationship*

Primary tables:
  + `users`
  + `texts`
  + `tags`
  
Pivot table(s):
  + `tag_text`

## Demo user
+ Email: dwa15@hes.com
+ Password: dwa15@hes.com

## CRUD
*Registered users can create, view, edit, and delete texts:*

__Create__
  + Link accessible to registered users - <https://p4.dwa15.site/texts/create>
  + Login and Register options are available on the HomePage (Menu) of the application - <https://p4.dwa15.site/>
  + Add details like header, contents of the your text and associated the tags if any.
  + Click *Add Wiki Text*
  + After validation, system will route to the home page of the application or remain on same page with validation errors.
  
__Read__
  + Link accessible to all users - <https://p4.dwa15.site/texts>
  + View existing texts added by other users.
  + Link accessible to registered users - <https://p4.dwa15.site/texts/tags>
  + View all tags and associated texts added by all users of the application.
  
__Update__
  + You can update the text that was added by you. i.e only registered users can access this area and edit only their own text.
  + Edit header, contexts and change associate tags if required.
  + Click *Save Changes*
  + After validation, system will keep you on same page to allow more edits if required.
  
__Delete__
  + You can delete the text that was added by you. i.e. only registered users can access this area and delete only their own text.
  + Confirm deletion on delete page.
  + Follow the confirmation message to confirm or cancel delete action.

## Code style divergences
n/a