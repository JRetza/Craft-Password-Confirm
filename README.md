# Craft-Password-Confirm
A little helper for you to confirm passwords match on front end forms


Install by putting `passwordconfirm` folder in your `craft/plugins` folder and then going to `admin/settings/plugins` when logged in and pressing install.

This plugin *does not* use it's own controller to save the user, so it doesn't override or bypass any of Crafts own methods, so it's all good :)

### How it works
You just need to add a `passwordConfirm` field to your *front end* user registration form, like so:

```html
<input type="password" name="passwordConfirm">
{% if account is defined %}
  {{ account.getErrors('passwordConfirm') }}
{% endif %}
```

Then when the user submits, passwordconfirm listens for the event and checks whether the two strings match and if not will add errors to the user model, stop the save process and return you to your form.

