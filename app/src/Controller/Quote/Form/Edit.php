<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky\Controller\Quote\Form;

use BlueSky\Entity\ProcessEmails as ProcessEmailsEntity;
use BlueSky\Entity\Quote as QuoteEntity;
use BlueSky\Framework\Controller\Form\Standard as FormBase;
use BlueSky\Framework\Entity\File as FileEntity;
use BlueSky\Framework\Model\File as FileModel;
use SidraBlue\Util\Input\Filter;

/**
 * Form class for Edit.
 *
 * This class is used to handle forms in the quote
 *  */
class Edit extends FormBase
{
    /**
     * @var array $formFields - Recorded fields for form
     */
    protected $formFields = [
        'firstname',
        'lastname',
        'email'
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
        $qe = new QuoteEntity($this->getState());
        $qe->setData($values);
        $id = $qe->save();
        $this->sendQuoteProcessor($values, $id);
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
            'Please enter last name',
            function ($value) {
                return !empty($value);
            }
        );
        $filter->setRule(
            'firstname',
            'Please enter first name',
            function ($value) {
                return !empty($value);
            }
        );
        $filter->setRule(
            'email',
            'Please enter email',
            function ($value) {
                return !empty($value);
            }
        );
        $filter->setRule(
            'email',
            'Please enter a valid email',
            function ($value) {
                return filter_var($value, FILTER_VALIDATE_EMAIL);
            }
        );
    }

    private function sendQuoteProcessor($values, $id)
    {
        $emailArr['email_to_name'] = "Admin";
        $emailArr['email_to_address'] = $this->getState()->getSettings()->getSettingOrConfig("bluesky.admin.email", 'amel@blueskylabs.com.au');
        $emailArr['email_to_user_id'] = '';
        $emailArr['name'] = $values['firstname'] . ' ' . $values['middlename'] . ' ' . $values['lastname'];
        $emailArr['email'] = $values['email'];
        $emailArr['phone'] = $values['phone'];
        $emailArr['project_summary'] = $values['project_summary'];
        if ($values['file_id'] > 0) {
            $fe = new FileEntity($this->getState());
            $fe->load($values['file_id']);
            $emailArr['file'] = $fe->getData();
        }
        $emailArr['email_subject'] = "Quote";
        $emailType = "quote";
        $emailData = [
            'email_type' => $emailType,
            'object_id' => $id,
            'object_ref' => "sb_bluesky_quote",
            'data' => json_encode($emailArr)
        ];
        $pe = new ProcessEmailsEntity($this->getState());
        $pe->setData($emailData);
        $pe->save();
    }

    protected function fileSave()
    {
        $file = $_FILES['file'];
        if (!empty($file)) {
            $result = $this->saveUploaderFile(0, $_FILES['file']);
            $this->getState()->getView()->file_id = $result->id;
        }
        $this->getState()->getView()->success = true;
    }

    /**
     * Save uploader file.
     *
     * @access protected
     * @param int $id
     * @param string $file
     * @return int|void
     */
    protected function saveUploaderFile($id, $file)
    {
        $fm = new FileModel($this->getState());
        $result = $fm->saveUpdate($file['tmp_name'], $file['name'], 'sb_bluesky_quote', $id);
        return $result;
    }
}
