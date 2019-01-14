<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky\Controller\Contact\Form;

use BlueSky\Entity\Contact as ContactEntity;
use BlueSky\Entity\ProcessEmails as ProcessEmailsEntity;
use SidraBlue\Lote\Controller\Form\Standard as FormBase;
use SidraBlue\Util\Input\Filter;

/**
 * Form class for Edit.
 *
 * This class is used to handle forms in the contact
 *  */
class Edit extends FormBase
{
    /**
     * @var array $formFields - Recorded fields for form
     */
    protected $formFields = [
        'lastname',
        'email',
        'phone',
        'contact_preference'
    ];

    /**
     * Function used to save form.
     *
     * @access protected
     * @param array $values
     * @param array $additionalData
     * @return int|void
     */
    protected function save($values, $additionalData = null)
    {
        $ce = new ContactEntity($this->getState());
        $ce->setData($values);
        $id = $ce->save();
        $this->sendContactProcessor($values, $id);
        return $id;
    }

    /**
     * Setup the form filter for validating an edit.
     *
     * @access protected
     * @param Filter $filter
     * @return void
     */
    protected function setupEditForm(Filter $filter)
    {
        $filter->setRule(
            'lastname',
            'Please enter full name',
            function ($value) {
                return !empty($value);
            }
        );
        $filter->setRule(
            'email',
            'You need to include either a phone number or email address',
            function ($value, $fields) {
                $result = true;
                if (empty($fields->phone) && empty($value)) {
                    $result = false;
                }
                return $result;
            }
        );
        $filter->setRule(
            'contact_preference',
            'Please select a preference',
            function ($value, $fields) {
                $result = true;
                if (!empty($fields->phone) && !empty($fields->email)) {
                    if (empty($value)) {
                        $result = false;
                    }
                }
                return $result;
            }
        );
    }

    private function sendContactProcessor($values, $id)
    {
        $emailArr['email_to_name'] = "Admin";
        $emailArr['email_to_address'] = $this->getState()->getSettings()->getSettingOrConfig("bluesky.admin.email", 'amel@blueskylabs.com.au');
        $emailArr['email_to_user_id'] = '';
        $emailArr['name'] = $values['lastname'];
        $emailArr['email'] = $values['email'];
        $emailArr['phone'] = $values['phone'];
        $emailArr['about'] = $values['about'];
        $emailArr['comments'] = $values['comments'];
        $emailArr['preference'] = $values['contact_preference'];
        if ($values['is_mailing'] == 1) {
            $mailing = "Yes";
        } else {
            $mailing = 'No';
        }
        $emailArr['mailinglist'] = $mailing;
        $emailArr['email_subject'] = "Contact";
        $emailType = "contact";
        $emailData = [
            'email_type' => $emailType,
            'object_id' => $id,
            'object_ref' => "sb_bluesky_contact",
            'data' => json_encode($emailArr)
        ];
        $pe = new ProcessEmailsEntity($this->getState());
        $pe->setData($emailData);
        $pe->save();
    }
}
