<?php
namespace Craft;

class PasswordConfirmPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Password confirm');
    }

    function getVersion()
    {
        return '1.0.1';
    }

    function getDeveloper()
    {
        return 'Alec Ritson';
    }

    function getDeveloperUrl()
    {
        return 'https://itsalec.co.uk';
    }

    public function getDescription()
    {
        return 'Checks whether two passwords match on a front end form';
    }

    function getDocumentationUrl()
    {
        return 'https://github.com/alecritson/Craft-Password-Confirm';
    }
    
    public function getReleaseFeedUrl()
    {
      return 'https://raw.githubusercontent.com/alecritson/plugin-updates/master/passwordconfirm.json';
    }


    public function init()
    {

        craft()->on('users.onBeforeSaveUser', function(Event $event) {
        
            // Only do anything if it is a front end submission
            if(craft()->request->isSiteRequest())
            {
                $password = craft()->request->getPost('password');
                $passwordConfirm = craft()->request->getPost('passwordConfirm');
                if($passwordConfirm && strcmp($password, $passwordConfirm) !== 0)
                {
                    $event->params['user']->addErrors(array('passwordConfirm' => Craft::t('Passwords do not match')));
                    $event->performAction = false;
                }
            }

        });
    }
}
